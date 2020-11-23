<?php
require_once 'controllers/Controller.php';
require_once 'models/User.php';
require_once 'models/PasswordReset.php';

class UserController extends Controller {


    public function update() {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            header("Location: index.php");
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
                $user_model->id = $id;
                $is_update = $user_model->update();
                if ($is_update) {
                    $_SESSION['success'] = 'Update success';
                } else {
                    $_SESSION['error'] = 'Update fail';
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

    public function login() {
        //nếu user đã đăng nhập r thì ko cho truy cập lại trang login, mà chuenr hướng tới backend
        if (isset($_SESSION['user'])) {
            header('Location: index.php');
            exit();
        }
        if (isset($_POST['submit'])) {

            $username = $_POST['username'];
            //do password đang lưu trong CSDL sử dụng cơ chế mã hóa md5 nên cần phải thêm
//            hàm md5 cho password
            $password = md5($_POST['password']);
            //validate
            if (empty($username) || empty($password)) {
                $this->error = 'Username hoặc password không được để trống';
            }
            $user_model = new User();
            if (empty($this->error)) {
                $user = $user_model->getUserByUsernameAndPassword($username, $password);
                if (empty($user)) {
                    $this->error = 'Sai username hoặc password';
                } else {
                    $_SESSION['success'] = 'Đăng nhập thành công';
                    //tạo session user để xác định user nào đang login
                    $_SESSION['user'] = $user;
                    header("Location: index.php");
                    exit();
                }
            }
        }
        $this->content = $this->render('views/users/login.php');

        require_once 'views/layouts/main.php';
    }

    /**
     * Đăng ký tài khoản mới, mặc định tất cả các user đều là user
     */
    public function register() {
        if (isset($_POST['submit'])) {
            $user_model = new User();
            $fisrt_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $address = $_POST['address'];

            $password_confirm = $_POST['password_confirm'];
            $user = $user_model->getUserByUsername($username);
            //check validate
            if (empty($fisrt_name) || empty($last_name) || empty($username) || empty($email) ||  empty($password) || empty($password_confirm)) {
                $this->error = 'Không được để trống các trường';
            } else if ($password != $password_confirm) {
                $this->error = 'Password nhập lại chưa đúng';
            } else if (!empty($user)) {
                $this->error = 'Username này đã tồn tại';
            }
            //xử lý lưu dữ liệu khi không có lỗi
            if (empty($this->error)) {
                $user_model->first_name = $fisrt_name;
                $user_model->last_name = $last_name;
                $user_model->username = $username;
                $user_model->email = $email;
                $user_model->first_name = $first_name;
                $user_model->last_name = $last_name;
                $user_model->address = $address;
                //chú ý password khi lưu vào bảng users sẽ được mã hóa md5 trước khi lưu
                //do đang sử dụng cơ chế mã hóa này cho quy trình login
                $user_model->password = md5($password);
                $user_model->status = 1;
                $user_model->roles = 0;
                $is_insert = $user_model->insertRegister();
                if ($is_insert) {
                    $_SESSION['success'] = 'Đăng ký thành công';
                } else {
                    $_SESSION['error'] = 'Đăng ký thất bại';
                }
                header('Location: index.php?controller=user&action=login');
                exit();
            }
        }

        $this->content = $this->render('views/users/register.php');
        require_once 'views/layouts/main.php';
    }

    /**
     *  Quên mật khẩu
     */
    public function forGotPW() {
//        echo "<pre>";
//        print_r($_POST);
//        echo "<pre>";
        if (isset($_POST['submit'])){
            $email = $_POST['email'];
            if (empty($email) || !filter_var($email,FILTER_VALIDATE_EMAIL)){
                $this->error = "Email không được để trống, sai định dạng";
            }
            $user_model = new User();
            $user_model->email = $email;
            $user = $user_model->findUser();

            if (empty($this->error) && isset($user['id'])) {
//                echo "<pre>";
//                print_r($user);
//                echo "<pre>";
                $token = Helper::getToken();
                $password_reset = new PasswordReset();
                $password_reset->member_id = $user['id'];
                $password_reset->token = md5($token);
                $is_insert = $password_reset->insert();
                if ($is_insert) {
                    $_SESSION['success'] = 'Vui lòng kiểm tra email của bạn';
                    $subject = "Từ LPSHOP.com - Quên mật khẩu";
                    $username = 'bangnk2000@gmail.com';
                    $password = 'onckpuofqcriqote';
                    $link = "http://php0520e-nhom1.itpsoft.com.vn/index.php?controller=user&action=resetPassword&token=$token";
                    $body = $this->render('views/users/mail_template_pw.php',[
                        'link' => $link
                    ]);
                    Helper::sendMail($email,$subject,$body,$username,$password);
                } else {
                    $_SESSION['error'] = 'Hệ thống có lỗi, vui lòng chờ';
                }
                header('Location: index.php?controller=user&action=login');
                exit();
            }
        }
        $this->content = $this->render('views/users/forgotpw.php');
        require_once 'views/layouts/main.php';
    }
    public function resetPassword() {

        if (!isset($_GET['token'])){
            header("Location: login.html");
            exit();
        }
        if (isset($_POST['submit'])) {
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];
            if ($password != $password_confirm) {
                $this->error = 'Password nhập lại chưa đúng';
            }
            if (empty($this->error)) {
                $token = $_GET['token'];
                $password_reset_model = new PasswordReset();
                $password_reset_model->token = md5($token);
                $user = $password_reset_model->getID();
                $id = $user['member_id'];

                $password_reset_model->updateValid();

                $user_model = new User();
                $user_model->password = md5($password);
                $is_change = $user_model->changePassword($id);
                if ($is_change){
                    $_SESSION['success'] = 'Password change success';
                }else {
                    $_SESSION['error'] = 'Password change failed';
                }
                header("Location: login.html");
                exit();
            }
        }
        $this->content = $this->render('views/users/restpw.php');
        require_once 'views/layouts/main.php';
    }
}