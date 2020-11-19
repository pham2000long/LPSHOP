<?php
require_once 'models/Model.php';
class Product extends Model {

  public function getProductInHomePage($params = []) {
    $str_filter = '';
    if (isset($params['category'])) {
      $str_category = $params['category'];
      $str_filter .= " AND categories.id IN $str_category";
    }
    if (isset($params['price'])) {
      $str_price = $params['price'];
      $str_filter .= " AND $str_price";
    }
    if (isset($params['title'])) {
        $str_title = $params['title'];
        $str_filter .= " AND products.title LIKE '%$str_title%'";
    }
    //do cả 2 bảng products và categories đều có trường name, nên cần phải thay đổi lại tên cột cho 1 trong 2 bảng
    $sql_select = "SELECT products.*, categories.name 
          AS category_name FROM products
          INNER JOIN categories ON products.category_id = categories.id
          WHERE products.status = 1 $str_filter";

    $obj_select = $this->connection->prepare($sql_select);
    $obj_select->execute();

    $products = $obj_select->fetchAll(PDO::FETCH_ASSOC);
    return $products;
  }

    public function getProductInWomenPage() {

        //do cả 2 bảng products và categories đều có trường name, nên cần phải thay đổi lại tên cột cho 1 trong 2 bảng
        $sql_select = "SELECT products.*, categories.name 
          AS category_name FROM products
          INNER JOIN categories ON products.category_id = categories.id
          WHERE products.status = 1 AND categories.id = 10";

        $obj_select = $this->connection->prepare($sql_select);
        $obj_select->execute();

        $products = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }
    public function getProductInMenPage() {

        //do cả 2 bảng products và categories đều có trường name, nên cần phải thay đổi lại tên cột cho 1 trong 2 bảng
        $sql_select = "SELECT products.*, categories.name 
          AS category_name FROM products
          INNER JOIN categories ON products.category_id = categories.id
          WHERE products.status = 1 AND categories.id = 9";

        $obj_select = $this->connection->prepare($sql_select);
        $obj_select->execute();

        $products = $obj_select->fetchAll(PDO::FETCH_ASSOC);
        return $products;
    }

  /**
   * Lấy thông tin sản phẩm theo id
   * @param $id
   * @return mixed
   */
  public function getById($id)
  {
    $obj_select = $this->connection
      ->prepare("SELECT products.*, categories.name AS category_name FROM products 
          INNER JOIN categories ON products.category_id = categories.id WHERE products.id = $id");

    $obj_select->execute();
    $product =  $obj_select->fetch(PDO::FETCH_ASSOC);
    return $product;
  }
  public function getAllFilter($params = []){
      // + Tạo truy vấn
//      echo "<pre>";
//      print_r($params);
//      echo "</pre>";
      $query_category_id = '';
      $query_price = '';
      // Luôn phải kiểm tra tồn tại mảng theo key
      if(isset($params['query_category_id'])){
          $query_category_id = $params['query_category_id'];
      }
      if(isset($params['query_price'])){
          $query_price = $params['query_price'];
      }
      $sql_select_all = "SELECT products.*, categories.name AS category_name
      FROM products INNER JOIN categories
      ON products.category_id = categories.id
      WHERE products.status = 1 $query_category_id $query_price
      ";
      //+ tạo đối tượng
      $obj_select_all = $this->connection->prepare($sql_select_all);
      // Thực thi câu truy vấn
      $obj_select_all->execute();
      //+ lấy ra mảng các products
      $products = $obj_select_all->fetchAll(PDO::FETCH_ASSOC);
      return $products;
  }

}

