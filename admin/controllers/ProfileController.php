<?php
require_once  'controllers/Controller.php';
require_once 'models/User.php';
require_once  'helpers/Helper.php';

class ProfileController extends Controller
{
    public function index() {

        $this->content = $this->render('views/profile/index.php', [
        ]);

        require_once 'views/layouts/main.php';
    }
}