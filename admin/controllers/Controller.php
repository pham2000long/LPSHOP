<?php
/**
 * Created by PhpStorm.
 * User: nvmanh
 * Date: 3/13/2020
 * Time: 11:02 PM
 */

class Controller
{
    public function __construct()
    {
        if (!isset($_SESSION['user'])) {
            $_SESSION['error'] = 'Bạn cần đăng nhập';
            header('Location: index.php?controller=login&action=login');
            exit();
        }
        else if (isset($_SESSION['user']['roles'])) {
            // Ngược lại nếu đã đăng nhập
            $permission = $_SESSION['user']['roles'];
            // Kiểm tra quyền của người đó có phải là admin hay không
            if ($permission == 0) {
                // Nếu không phải admin thì xuất thông báo
                echo "Bạn không đủ quyền truy cập vào trang này<br>";
                echo "<a href='http://php0520e-nhom1.itpsoft.com.vn'> Click để quay lại</a>";
                unset($_SESSION['user']);
                unset($_SESSION['success']);
                exit();
            }
        }
    }

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
}