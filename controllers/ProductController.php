<?php
require_once 'controllers/Controller.php';
require_once 'models/Product.php';
require_once 'models/Category.php';
require_once 'models/Pagination.php';
class ProductController extends Controller {
  public function showAll() {
    $params = [];
    //nếu user có hành động filter
    if (isset($_POST['filter'])) {

      if (isset($_POST['category'])) {
        $category = implode(',', $_POST['category']);
        //chuyển thành chuỗi sau để sử dụng câu lệnh in_array
        $str_category_id = "($category)";
        $params['category'] = $str_category_id;
      }
      if (isset($_POST['price'])) {
        $str_price = '';
        foreach ($_POST['price'] AS $price) {
          if ($price == 1) {
            $str_price .= " OR products.price < 50";
          }
          if ($price == 2) {
            $str_price .= " OR (products.price >= 50 AND products.price < 55)";
          }
          if ($price == 3) {
            $str_price .= " OR (products.price >= 55 AND products.price < 60)";
          }
          if ($price == 4) {
            $str_price .= " OR products.price >= 60";
          }
        }
        //cắt bỏ từ khóa OR ở vị trí ban đầu
        $str_price = substr($str_price, 3);
        $str_price = "($str_price)";
        $params['price'] = $str_price;
      }
      if (isset($_POST['title'])){
            $name = $_POST['title'];
            $params['title'] = $name;
        }
    }


    $product_model = new Product();
    $products = $product_model->getProductInHomePage($params);

    //get categories để filter
    $category_model = new Category();
    $categories = $category_model->getAll();

    $this->content = $this->render('views/products/show_all.php', [
      'products' => $products,
      'categories' => $categories

    ]);

    require_once 'views/layouts/main.php';
  }


    public function detail()
    {
        if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
            $_SESSION['error'] = 'ID không hợp lệ';
            header('Location: index.php?');
            exit();
        }

        $id = $_GET['id'];
        $product_model = new Product();
        $product = $product_model->getById($id);

        $this->content = $this->render('views/products/detail.php', [
            'product' => $product
        ]);
        require_once 'views/layouts/main.php';
    }
  public function filter(){
      // Xử lý submit form
//      echo "<pre>";
//      print_r($_POST);
//      echo "</pre>";
      // Màng chứa các tham số liên quan đến filter
      $params = [];
      if(isset($_POST['filter'])){
          //Khai báo 2 chuỗi chứa thông tin truy vấn cho category_id và price
          $query_category_id = '';
          $query_price = '';
          // Xử lý tạo câu truy vấn cho category_id, nếu user có tích chọn danh mục thì mới xử lí

          if(isset($_POST['categories'])){
              // tạo câu truy vấn có dạn sau: OR category_id = 1 OR category_id = 2
              // Thay thế cho việc dùng OR ta sử dụng từ IN
              $categories = $_POST['categories'];
              $category_id_str = implode(',',$categories);
//              var_dump($category_id_str);
              $query_category_id = " AND products.category_id IN ($category_id_str)";
          }

      }
      // Xử lý tạo câu truy vấn cho khoảng giá
      // Nếu mà user tích thì mới xử lý
      if(isset($_POST['prices'])){
          $prices = $_POST['prices'];
          foreach ($prices AS $price){
              switch ($price){
                  case 0:
                      $query_price .= " OR (products.price BETWEEN 0 AND 1000000) ";
                      break;
                  case 1:
                      $query_price .= " OR (products.price BETWEEN 1000000 AND 2000000)";
                      break;
                  case 2:
                      $query_price .= " OR (products.price BETWEEN 2000000 AND 3000000)";
                      break;
                  default:
                      $query_price .= " OR (products.price > 3000000)";
              }
          }
          // Cắt bỏ chuỗi OR ở đầu, dùng hàm substr
          $query_price = substr($query_price,3);
          // Gán lại chuỗi $query_price
          $query_price = " AND ($query_price)";

      }
      // Ra khỏi vòng lặp debug biến
//      var_dump($query_price);
      $params['query_category_id'] = $query_category_id;
      $params['query_price'] = $query_price;
      //Lấy ra danh sách toàn bộ sản phẩm trên đang có trên hệ thống
      $product_model = new Product();
      $products = $product_model->getAllFilter($params);


      // Lây ra toàn bộ danh mục đang có để hiển thị cho phần lọc danh mục
      $category_model = new Category();
      $categories = $category_model->getAll();
//      echo "<pre>";
//      print_r($categories);
//      echo "</pre>";
      // GỌi view và layout để hiển thị
      $this->content = $this->render('views/products/filter.php', ['products' =>$products,
          'categories' => $categories ]);
      require_once 'views/layouts/main.php';
  }
}