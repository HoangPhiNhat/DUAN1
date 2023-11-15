<?php

include "views/admin/authenticate.php"; ?>
<?php
class FacilityControllers
{
    public function facilityList()
    {
        $admin_page = "views/admin/pages/facilities/facility_list.php";
        include 'views/admin/common/common-page.php';
    }
    public function facility()
    {
        $admin_page = "views/admin/pages/facilities_management/facility_list.php";
        include 'views/admin/common/common-page.php';
    }

    public function manageUsers()
    {
        $content = "<h2>Manage Users</h2>";
        $content .= "<p>This is the content for managing users.</p>";
        include 'views/common/common_admin/common-page.php';
    }
}
