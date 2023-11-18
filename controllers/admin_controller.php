<?php
require_once('controllers/base_controller.php');

class AdminController extends BaseController
{
    function __construct()
    {
        $this->parentFolder = 'admin';
        $this->subFolder = 'pages';
    }

    public function dashboard()
    {
        $this->folder = 'dashboard';
        $this->render('dashboard');
    }
    public function facilityList()
    {
        $this->folder = 'facilities';
        $this->render('facility_list');
    }
    public function addFacility()
    {
        $this->folder = 'facilities';
        $this->render('add_facility');
    }
    public function updateFacility()
    {
        $this->folder = 'facilities';
        $this->render('update_facility');
    }
}
