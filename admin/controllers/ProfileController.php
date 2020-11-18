<?php
require_once  'controllers/Controller.php';
require_once 'models/User.php';
require_once  'helpers/Helper.php';

class ProfileController extends Controller
{
    public function index() {

//        echo "<pre>";
//        print_r($_SESSION);
//        echo "<pre>";
        $id = $_SESSION['user']['id'];
        $user_model = new User();
        $user = $user_model->getById($id);

        if (isset($_POST['submit'])) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $jobs = $_POST['jobs'];

            //xử lý validate
            if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->error = 'Email không đúng định dạng';
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
                $user_model->facebook = '';
                $user_model->status = '1';
                $id = $_SESSION['user']['id'];
                $user_model->id = $id;
                $is_update = $user_model->update();
                if ($is_update) {
                    $_SESSION['success'] = 'Update profile thành công';
                    $users = $user_model->getById($id);
                    $_SESSION['user'] = $users;
                } else {
                    $_SESSION['error'] = 'Update profile thất bại';
                }
            }
            header('Location: index.php?controller=profile&action=index');
            exit();
        }

        $this->content = $this->render('views/profile/index.php', [
                'user' => $user
        ]);

        require_once 'views/layouts/main.php';
    }

    public function changePassword() {

        if (isset($_POST['submit'])) {
            $id = $_SESSION['user']['id'];
            $password = $_POST['password'];
            $new_password = $_POST['new_password'];
            $password_confirm = $_POST['password_confirm'];

            if (empty($password)) {
                $this->error = 'Mật khẩu không được để trống';
            } elseif (empty($new_password)) {
                $this->error = 'Mật khẩu mới không được để trống';
            } elseif (empty($password_confirm)) {
                $this->error = 'Xác nhận mật khẩu mới không được để trống';
            } elseif ($new_password != $password_confirm) {
                $this->error = 'Xác nhận mật khẩu chưa khớp';
            }
            if (empty($this->error)) {
                $user_model = new User();
                $user_model->password = md5($new_password);
                $is_change = $user_model->changePassword($id);
                if ($is_change) {
                    $_SESSION['success'] = 'Đổi password  thành công';
                    $users = $user_model->getById($id);
                    $_SESSION['user'] = $users;
                } else {
                    $_SESSION['error'] = 'Đổi password thất bại';

                }
            }
            header('Location: index.php?controller=profile&action=index');
            exit();
        }
        $this->content = $this->render('views/profile/changepassword.php', [

        ]);

        require_once 'views/layouts/main.php';
    }
    public function logout() {
//        session_destroy();
        $_SESSION = [];
//        session_destroy();
        unset($_SESSION['user']);
        $_SESSION['success'] = 'Logout thành công';
        header('Location: index.php?controller=login&action=login');
        exit();
    }
}