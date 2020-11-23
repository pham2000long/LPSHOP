<?php
require_once 'controllers/Controller.php';
require_once 'models/User.php';
require_once 'models/Pagination.php';
class UserController extends Controller {
    public function __construct()
    {
        if (isset($_SESSION['user']['roles'])) {
            // Ngược lại nếu đã đăng nhập
            $permission = $_SESSION['user']['roles'];
            // Kiểm tra quyền của người đó có phải là admin hay không
            if ($permission != 1) {
                // Nếu không phải admin thì xuất thông báo
                echo "Bạn không đủ quyền truy cập vào trang này<br>";
                echo "<a href='http://php0520e-nhom1.itpsoft.com.vn/admin/index.php?controller=category&action=index'> Click để quay lại</a>";
                exit();
            }
        }
    }

    public function index() {
        $user_model = new User();
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $total = $user_model->getTotal();
        $query_additional = '';
        if (isset($_GET['username'])) {
            $query_additional .= '&username=' . $_GET['username'];
        }
        $params = [
            'total' => $total,
            'limit' => 5,
            'query_string' => 'page',
            'controller' => 'user',
            'action' => 'index',
            'full_mode' => false,
            'query_additional' => $query_additional,
            'page' => isset($_GET['page']) ? $_GET['page'] : 1
        ];
        $pagination = new Pagination($params);
        $pages = $pagination->getPagination();
        $users = $user_model->getAllPagination($params);

        $this->content = $this->render('views/users/index.php', [
            'users' => $users,
            'pages' => $pages
        ]);

        require_once 'views/layouts/main.php';
    }

    public function create() {
        $user_model = new User();
        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $jobs = $_POST['jobs'];
            $facebook = $_POST['facebook'];
            $status = $_POST['status'];
            $roles = $_POST['roles'];
            //xử lý validate
            if (empty($username)) {
                $this->error = 'Username không được để trống';
            } else if (empty($password)) {
                $this->error = 'Password không được để trống';
            } else if (empty($password_confirm)) {
                $this->error = 'Password confirm không được để trống';
            } else if ($password != $password_confirm) {
                $this->error = 'Password confirm chưa đúng';
            } else if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->error = 'Email không đúng định dạng';
            } else if (!empty($facebook) && !filter_var($facebook, FILTER_VALIDATE_URL)) {
                $this->error = 'Link facebook không đúng định dạng url';
            } else if ($_FILES['avatar']['error'] == 0) {
                $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                $extension = strtolower($extension);
                $allow_extensions = ['png', 'jpg', 'jpeg', 'gif'];
                $file_size_mb = $_FILES['avatar']['size'] / 1024 / 1024;
                $file_size_mb = round($file_size_mb, 2);
                if (!in_array($extension, $allow_extensions)) {
                    $this->error = 'Phải upload avatar dạng ảnh';
                } else if ($file_size_mb > 2) {
                    $this->error = 'File upload không được lớn hơn 2Mb';
                }
            } else if (!empty($username)) {
                //kiếm tra xem username đã tồn tại trong DB hay chưa, nếu tồn tại sẽ báo lỗi
                $count_user = $user_model->getUserByUsername($username);
                if ($count_user) {
                    $this->error = 'Username này đã tồn tại trong CSDL';
                }
            }

            //xủ lý lưu dữ liệu khi biến error rỗng
            if (empty($this->error)) {
                $filename = '';
                //xử lý upload ảnh nếu có
                if ($_FILES['avatar']['error'] == 0) {
                    $dir_uploads = __DIR__ . '/../assets/uploads';
                    if (!file_exists($dir_uploads)) {
                        mkdir($dir_uploads);
                    }

                    $filename = time() . '-user-' . $_FILES['avatar']['name'];
                    move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_uploads . '/' . $filename);
                }
                $user_model->username = $username;
                //lưu password dưới dạng mã hóa, hiện tại sử dụng cơ chế md5
                $user_model->password = md5($password);
                $user_model->first_name = $first_name;
                $user_model->last_name = $last_name;
                $user_model->phone = $phone;
                $user_model->address = $address;
                $user_model->email = $email;
                $user_model->avatar = $filename;
                $user_model->jobs = $jobs;
                $user_model->facebook = $facebook;
                $user_model->status = $status;
                $user_model->roles = $roles;
                $is_insert = $user_model->insert();
                if ($is_insert) {
                    $_SESSION['success'] = 'Insert dữ liệu thành công';
                } else {
                    $_SESSION['error'] = 'Insert dữ liệu thất bại';
                }
                header('Location: index.php?controller=user');
                exit();
            }
        }

        $this->content = $this->render('views/users/create.php');

        require_once 'views/layouts/main.php';
    }

    public function update() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header("Location: index.php?controller=user");
            exit();
        }

        $id = $_GET['id'];
        $user_model = new User();
        $user = $user_model->getById($id);

        if (isset($_POST['submit'])) {

            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $jobs = $_POST['jobs'];
            $facebook = $_POST['facebook'];
            $status = $_POST['status'];
            $roles = $_POST['roles'];
            //xử lý validate
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->error = 'Email không đúng định dạng';
            } else if (!empty($facebook) && !filter_var($facebook, FILTER_VALIDATE_URL)) {
                $this->error = 'Link facebook không đúng định dạng url';
            } else if ($_FILES['avatar']['error'] == 0) {
                $extension = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
                $extension = strtolower($extension);
                $allow_extensions = ['png', 'jpg', 'jpeg', 'gif'];
                $file_size_mb = $_FILES['avatar']['size'] / 1024 / 1024;
                $file_size_mb = round($file_size_mb, 2);
                if (!in_array($extension, $allow_extensions)) {
                    $this->error = 'Phải upload avatar dạng ảnh';
                } else if ($file_size_mb > 2) {
                    $this->error = 'File upload không được lớn hơn 2Mb';
                }
            }

            //xủ lý lưu dữ liệu khi biến error rỗng
            if (empty($this->error)) {
                $filename = $user['avatar'];
                //xử lý upload ảnh nếu có
                if ($_FILES['avatar']['error'] == 0) {
                    $dir_uploads = __DIR__ . '/../assets/uploads';
                    //xóa file ảnh đã update trc đó
                    @unlink($dir_uploads . '/' . $filename);
                    if (!file_exists($dir_uploads)) {
                        mkdir($dir_uploads);
                    }

                    $filename = time() . '-user-' . $_FILES['avatar']['name'];
                    move_uploaded_file($_FILES['avatar']['tmp_name'], $dir_uploads . '/' . $filename);
                }
                //lưu password dưới dạng mã hóa, hiện tại sử dụng cơ chế md5
                $user_model->first_name = $first_name;
                $user_model->last_name = $last_name;
                $user_model->phone = $phone;
                $user_model->address = $address;
                $user_model->email = $email;
                $user_model->avatar = $filename;
                $user_model->jobs = $jobs;
                $user_model->facebook = $facebook;
                $user_model->status = $status;
                $user_model->roles = $roles;
                $user_model->id = $id;

                $is_update = $user_model->update();
                if ($is_update) {
                    $_SESSION['success'] = 'Update dữ liệu thành công';
                } else {
                    $_SESSION['error'] = 'Update dữ liệu thất bại';
                }
                header('Location: index.php?controller=user');
                exit();
            } elseif (isset($_POST['change'])) {

            }
        }

        $this->content = $this->render('views/users/update.php', [
            'user' => $user
        ]);

        require_once 'views/layouts/main.php';
    }

    public function delete() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?controller=user');
            exit();
        }

        $id = $_GET['id'];
        $user_model = new User();
        $is_delete = $user_model->delete($id);
        if ($is_delete) {
            $_SESSION['success'] = 'Xóa dữ liệu thành công';
        } else {
            $_SESSION['error'] = 'Xóa dữ liệu thất bại';
        }
        header('Location: index.php?controller=user');
        exit();
    }

    public function detail() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header("Location: index.php?controller=user");
            exit();
        }
        $id = $_GET['id'];
        $user_model = new User();
        $user = $user_model->getById($id);

        $this->content = $this->render('views/users/detail.php', [
            'user' => $user
        ]);

        require_once 'views/layouts/main.php';
    }


}