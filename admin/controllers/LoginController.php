<?php
require_once 'models/User.php';
require_once 'models/PasswordReset.php';
require_once  'helpers/Helper.php';

class LoginController
{
    //chứa nội dung view
    public $content;
    //chứa nội dung lỗi validate
    public $error;

    /**
     * @param $file string Đường dẫn tới file
     * @param array $variables array Danh sách các biến truyền vào file
     * @return false|string
     */
    public function render($file, $variables = []) {
        //Nhập các giá trị của mảng vào các biến có tên tương ứng chính là key của phần tử đó.
        //khi muốn sử dụng biến từ bên ngoài vào trong hàm
        extract($variables);
        //bắt đầu nhớ mọi nội dung kể từ khi khai báo, kiểu như lưu vào bộ nhớ tạm
        ob_start();
        //thông thường nếu ko có ob_start thì sẽ hiển thị 1 dòng echo lên màn hình
        //tuy nhiên do dùng ob_Start nên nội dung của nó đã đc lưu lại, chứ ko hiển thị ra màn hình nữa
        require_once $file;
        //lấy dữ liệu từ bộ nhớ tạm đã lưu khi gọi hàm ob_Start để xử lý, lấy xong rồi xóa luôn dữ liệu đó
        $render_view = ob_get_clean();

        return $render_view;
    }

    public function login() {
        //nếu user đã đăngn hập r thì ko cho truy cập lại trang login, mà chuenr hướng tới backend
        if (isset($_SESSION['user'])) {
            header('Location: index.php?controller=category&action=index');
            exit();
        }
        if (isset($_POST['submit'])) {
//            die;
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
                    header("Location: index.php?controller=category");
                    exit();
                }
            }
        }
        $this->content = $this->render('views/users/login.php');

        require_once 'views/layouts/main_login.php';
    }

    /**
     * Đăng ký tài khoản mới, mặc định tất cả các user đều có quyền admin
     */
    public function register() {

        if (isset($_POST['submit'])) {
            $user_model = new User();
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password_confirm = $_POST['password_confirm'];
            $user = $user_model->getUserByUsername($username);
            //check validate
            if (empty($username) || empty($password) || empty($password_confirm)) {
                $this->error = 'Không được để trống các trường';
            } else if ($password != $password_confirm) {
                $this->error = 'Password nhập lại chưa đúng';
            } else if (!empty($user)) {
                $this->error = 'Username này đã tồn tại';
            }
            //xử lý lưu dữ liệu khi không có lỗi
            if (empty($this->error)) {

                $user_model->username = $username;
                //chú ý password khi lưu vào bảng users sẽ được mã hóa md5 trước khi lưu
                //do đang sử dụng cơ chế mã hóa này cho quy trình login
                $user_model->password = md5($password);
                $user_model->status = 1;
                $is_insert = $user_model->insertRegister();
                if ($is_insert) {
                    $_SESSION['success'] = 'Đăng ký thành công';
                } else {
                    $_SESSION['error'] = 'Đăng ký thất bại';
                }
                header('Location: index.php?controller=login&action=login');
                exit();
            }
        }

        $this->content = $this->render('views/users/register.php');
        require_once 'views/layouts/main_login.php';
    }

    /**
     *  Quên mật khẩu
     */
    public function forGotpw() {
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
                    $password = 'froucfwmoarpouiq';
                    $link = "http://php0520e-nhom1.itpsoft.com.vn/admin/index.php?controller=login&action=resetPassword&token=$token";
                    $body = $this->render('views/users/mail_template_pw.php',[
                        'link' => $link
                    ]);
                    Helper::sendMail($email,$subject,$body,$username,$password);
                } else {
                    $_SESSION['error'] = 'Hệ thống có lỗi, vui lòng chờ';
                }
                header('Location: index.php?controller=login&action=login');
                exit();
            }
        }
        $this->content = $this->render('views/users/forgotpw.php');
        require_once 'views/layouts/main_login.php';
    }
    public function resetPassword() {
//        echo "<pre>";
//        print_r($_GET);
//        print_r($_POST);
//        echo "<pre>";
        if (!isset($_GET['token'])){
            header("Location: index.php?controller=login&action=login");
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
                    $_SESSION['success'] = 'Đổi mật khẩu thành công';
                }else {
                    $_SESSION['error'] = 'Đổi mật khẩu thất bại';
                }   
                header("Location: index.php?controller=login&action=login");
                exit();
            }
        }
        $this->content = $this->render('views/users/restpw.php');
        require_once 'views/layouts/main_login.php';
    }
}