<?php
require_once 'controllers/Controller.php';
require_once 'models/Order.php';
require_once 'models/Product.php';
require_once 'models/Pagination.php';

class OrderController extends Controller
{
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
}