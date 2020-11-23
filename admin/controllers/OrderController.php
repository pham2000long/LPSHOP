<?php
require_once 'controllers/Controller.php';
require_once 'models/Order.php';
require_once 'models/Product.php';
require_once 'models/Pagination.php';

class OrderController extends Controller
{
    public function __construct()
    {
        if (isset($_SESSION['user']['roles'])) {
            // Ngược lại nếu đã đăng nhập
            $permission = $_SESSION['user']['roles'];
            // Kiểm tra quyền của người đó có phải là admin hay không
            if ($permission == 0 || $permission == 2) {
                // Nếu không phải admin thì xuất thông báo
                echo $permission;
                echo "Bạn không đủ quyền truy cập vào trang này<br>";
                echo "<a href='http://php0520e-nhom1.itpsoft.com.vn/admin/index.php?controller=category&action=index'> Click để quay lại</a>";
                exit();
            }
        }
    }
    public function index()
    {
        $order_model = new Order();

        //lấy tổng số bản ghi đang có trong bảng orders
        $count_total = $order_model->countTotal();
        //        xử lý phân trang
        $query_additional = '';
        if (isset($_GET['fullname'])) {
            $query_additional .= '&fullname=' . $_GET['fullname'];
        }
        $arr_params = [
            'total' => $count_total,
            'limit' => 5,
            'query_string' => 'page',
            'controller' => 'order',
            'action' => 'index',
            'full_mode' => false,
            'query_additional' => $query_additional,
            'page' => isset($_GET['page']) ? $_GET['page'] : 1
        ];
        $orders = $order_model->getAllPagination($arr_params);
        $pagination = new Pagination($arr_params);

        $pages = $pagination->getPagination();

        //lấy danh sách category đang có trên hệ thống để phục vụ cho search

        $this->content = $this->render('views/orders/index.php', [
            'orders' => $orders,
            'pages' => $pages,
        ]);
        require_once 'views/layouts/main.php';
    }

    public function detail()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?controller=order');
            exit();
        }

        $id = $_GET['id'];
        $order_model = new Order();
        $order = $order_model->getById($id);

        $this->content = $this->render('views/orders/detail.php', [
            'order' => $order
        ]);
        require_once 'views/layouts/main.php';
    }
    public function update()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?controller=orders');
            exit();
        }
        $id = $_GET['id'];
        $orders_model = new Order();
        $orders = $orders_model->getById($id);
        //xử lý submit form
        if (isset($_POST['submit'])) {

            $status = $_POST['status'];

            $orders_model->status = $status;
            $orders_model->updated_at = date('Y-m-d H:i:s');

            $is_update = $orders_model->update($id);

            if ($is_update) {
                $_SESSION['success'] = 'Update trạng thái thành công';
            } else {
                $_SESSION['error'] = 'Update trạng thái thất bại';
            }
            header('Location: index.php?controller=order');
            exit();
        }
        $this->content = $this->render('views/orders/update.php', [
            'orders' => $orders
        ]);
        require_once 'views/layouts/main.php';
    }

    public function delete()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?controller=order');
            exit();
        }

        $id = $_GET['id'];
        $order_model = new Order();
        $is_delete = $order_model->delete($id);
        if ($is_delete) {
            $_SESSION['success'] = 'Xóa dữ liệu thành công';
        } else {
            $_SESSION['error'] = 'Xóa dữ liệu thất bại';
        }
        header('Location: index.php?controller=order');
        exit();
    }
}