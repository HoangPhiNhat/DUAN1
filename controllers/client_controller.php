<?php
require_once('controllers/base_controller.php');
require_once("models/admin/facilities/facility.php");
class ClientController extends BaseController
{
    function __construct()
    {
        $this->parentFolder = 'client';
        $this->subFolder = 'pages';
    }

    public function home()
    {
        $this->folder = 'home';
        $this->render('index');
    }
    public function aboutUs()
    {
        $this->folder = 'aboutUs';
        $this->render('about');
    }
    public function bookNow()
    {
        
        $this->folder = 'bookingRoom';
        $this->render('book');
    }
    public function register()
    {
        $this->folder = 'register';
        $this->render('register');
    }
    public function signIn()
    {
        $this->folder = 'signIn';
        $this->render('sign-in');
    }
    public function error()
    {
        $data = array('is404' => true);
        $this->folder = 'error_404';
        $this->render('404', $data);
    }
    
}
