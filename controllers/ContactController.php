<?php
require_once 'controllers/Controller.php';

class ContactController extends Controller
{
    public function index() {

        $this->content = $this->render('views/contacts/index.php', [
        ]);
        require_once 'views/layouts/main.php';
    }
}