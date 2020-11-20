<?php
require_once 'controllers/Controller.php';
require_once 'models/News.php';
require_once 'models/Category.php';

class NewController extends Controller
{
    public function index() {

        $new_model = new News();
        $news = $new_model->getAll();

        $category_model = new Category();
        $categories = $category_model->getAll();

        $this->content = $this->render('views/news/news.php', [
            'news' => $news,
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
        $new_model = new News();
        $new = $new_model->getById($id);


        $this->content = $this->render('views/news/news-details.php', [
            'new' => $new
        ]);
        require_once 'views/layouts/main.php';
    }
}