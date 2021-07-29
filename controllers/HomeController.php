<?php
require_once 'controllers/Controller.php';
require_once 'models/Product.php';
require_once 'models/Category.php';

class HomeController extends Controller {
  public function index() {
    $product_model = new Product();
    $products = $product_model->getProductInHomePage();
    $categories_model = new Category();
    $categories = $categories_model->getAll();

    $this->content = $this->render('views/homes/index.php', [
      'products' => $products,
      'categories' => $categories
    ]);
    require_once 'views/layouts/main.php';
  }
    public function women() {
        $product_model = new Product();
        $products = $product_model->getProductInWomenPage();

        $this->content = $this->render('views/homes/women.php', [
            'products' => $products,
        ]);
        require_once 'views/layouts/main.php';
    }

    public function men() {
        $product_model = new Product();
        $products = $product_model->getProductInMenPage();

        $this->content = $this->render('views/homes/men.php', [
            'products' => $products,
        ]);
        require_once 'views/layouts/main.php';
    }

    public function category() {
        $categories_model = new Category();
        $categories = $categories_model->getAll();

        $this->content = $this->render('views/layout/header.php', [
          'categories' => $categories,
        ]);

        require_once 'views/layouts/main.php';
    }
}