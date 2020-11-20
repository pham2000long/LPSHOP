<?php
require_once 'models/Model.php';

class News extends Model
{
    public $id;
    public $category_id;
    public $title;
    public $avatar;
    public $summary;
    public $content;
    public $seo_title;
    public $seo_description;
    public $seo_keywords;
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
        if (isset($_GET['title']) && !empty($_GET['title'])) {
            $this->str_search .= " AND news.title LIKE '%{$_GET['title']}%'";
        }
        if (isset($_GET['category_id']) && !empty($_GET['category_id'])) {
            $this->str_search .= " AND news.category_id = {$_GET['category_id']}";
        }
    }

    /**
     * Lấy thông tin của sản phẩm đang có trên hệ thống
     * @return array
     */
    public function getAll()
    {
        $obj_select = $this->connection
            ->prepare("SELECT news.*, categories.name AS category_name FROM news 
                        INNER JOIN categories ON categories.id = news.category_id
                        WHERE TRUE 
                        ORDER BY news.created_at DESC
                        ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $news = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $news;
    }

    /**
     * Lấy thông tin của sản phẩm đang có trên hệ thống
     * @param array Mảng các tham số phân trang
     * @return array
     */
    public function getAllPagination($arr_params)
    {
        $limit = $arr_params['limit'];
        $page = $arr_params['page'];
        $start = ($page - 1) * $limit;
        $obj_select = $this->connection
            ->prepare("SELECT news.*, categories.name AS category_name FROM news 
                        INNER JOIN categories ON categories.id = news.category_id
                        WHERE TRUE $this->str_search
                        ORDER BY news.updated_at DESC, news.created_at DESC
                        LIMIT $start, $limit
                        ");

        $arr_select = [];
        $obj_select->execute($arr_select);
        $news = $obj_select->fetchAll(PDO::FETCH_ASSOC);

        return $news;
    }


    /**
     * Lấy thông tin sản phẩm theo id
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        $obj_select = $this->connection
            ->prepare("SELECT news.*, categories.name AS category_name FROM news 
          INNER JOIN categories ON news.category_id = categories.id WHERE news.id = $id");

        $obj_select->execute();
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }



}