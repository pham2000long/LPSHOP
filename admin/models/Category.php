<?php
//models/Category
require_once 'models/Model.php';
class Category extends Model {
  //khai báo các thuộc tính cho model trùng với các trường
//    của bảng categories
  public $id;
  public $name;
  public $type;
  public $avatar;
  public $description;
  public $status;
  public $created_at;
  public $updated_at;

    /*
      * Chuỗi search, sinh tự động dựa vào tham số GET trên Url
      */
    public $str_search = '';

    public function __construct()
    {
        parent::__construct();
        if (isset($_GET['name']) && !empty($_GET['name'])) {
            $this->str_search .= " AND name LIKE '%{$_GET['name']}%'";
        }
    }

    /**
     * LẤy thông tin danh mục trên hệ thống
     * @param $params array Mảng các tham số search
     * @return array
     */
    public function getAll()
    {
        $obj_select = $this->connection
            ->prepare("SELECT *  FROM categories 
                        WHERE TRUE $this->str_search
                        ORDER BY categories.created_at DESC
                        ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $categories = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $categories;
    }

    public function getAllPagination($arr_params)
    {
        $limit = $arr_params['limit'];
        $page = $arr_params['page'];
        $start = ($page - 1) * $limit;
        $obj_select = $this->connection
            ->prepare("SELECT *FROM categories 
                        WHERE TRUE $this->str_search
                        ORDER BY categories.updated_at DESC, categories.created_at DESC
                        LIMIT $start, $limit
                        ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $categories = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $categories;
    }

    //insert dữ liệu vào bảng categories
  public function insert() {
    $sql_insert =
      "INSERT INTO categories(`name`, `type`, `avatar`, `description`, `status`)
VALUES (:name, :type, :avatar, :description, :status)";
    //cbi đối tượng truy vấn
    $obj_insert = $this->connection
      ->prepare($sql_insert);
    //gán giá trị thật cho các placeholder
    $arr_insert = [
      ':name' => $this->name,
      ':type'=> $this->type,
      ':avatar' => $this->avatar,
      ':description' => $this->description,
      ':status' => $this->status
    ];
    return $obj_insert->execute($arr_insert);
  }

  public function getById($id) {
    $sql_select_one = "SELECT * FROM categories WHERE id = $id";
    $obj_select_one = $this->connection
      ->prepare($sql_select_one);
    $obj_select_one->execute();
    $category = $obj_select_one->fetch(PDO::FETCH_ASSOC);
    return $category;
  }

  /**
   * Lấy category theo id truyền vào
   * @param $id
   * @return array
   */
  public function getCategoryById($id)
  {
    $obj_select = $this->connection
      ->prepare("SELECT * FROM categories WHERE id = $id");
    $obj_select->execute();
    $category = $obj_select->fetch(PDO::FETCH_ASSOC);

    return $category;
  }

  /**
   * Update bản ghi theo id truyền vào
   * @param $id
   * @return bool
   */
  public function update($id)
  {
    $obj_update = $this->connection->prepare("UPDATE categories SET `name` = :name, `type` = :type, `avatar` = :avatar, `description` = :description, `status` = :status, `updated_at` = :updated_at 
         WHERE id = $id");
    $arr_update = [
      ':name' => $this->name,
      ':type'=> $this->type,
      ':avatar' => $this->avatar,
      ':description' => $this->description,
      ':status' => $this->status,
      ':updated_at' => $this->updated_at,
    ];

    return $obj_update->execute($arr_update);
  }

  /**
   * Xóa bản ghi theo id truyền vào
   * @param $id
   * @return bool
   */
  public function delete($id)
  {
    $obj_delete = $this->connection
      ->prepare("DELETE FROM categories WHERE id = $id");
    $is_delete = $obj_delete->execute();
    //để đảm bảo toàn vẹn dữ liệu, sau khi xóa category thì cần xóa cả các product nào đang thuộc về category này
    $obj_delete_product = $this->connection
      ->prepare("DELETE FROM categories WHERE category_id = $id");
    $obj_delete_product->execute();

    return $is_delete;
  }

  /**
   * Lấy tổng số bản ghi trong bảng categories
   * @return mixed
   */
  public function countTotal()
  {
    $obj_select = $this->connection->prepare("SELECT COUNT(id) FROM categories");
    $obj_select->execute();

    return $obj_select->fetchColumn();
  }
}