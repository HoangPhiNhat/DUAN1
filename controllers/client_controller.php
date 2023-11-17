<?php
require_once('controllers/base_controller.php');

class ClientController extends BaseController
{
    function __construct()
    {
        $this->folder = 'client';
    }

    public function home()
    {
        $this->render('home');
    }
    public function about()
    {
        $this->render('about');
    }
    public function bookNow()
    {
        $this->render('book');
    }
    public function register()
    {
        $this->render('register');
    }
    public function signIn()
    {
        $this->render('sign-in');
    }
    public function error()
    {
        $data = array('is404' => true);
        $this->render('404', $data);
    }
    public function someOtherPage()
    {
        $data = array(); // Dữ liệu cho trang khác trang 404
        $this->render('someOtherPage', $data);
    }
}
