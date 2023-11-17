<?php
$_GET['controller'] === "client" ? include "views/client/common/header.php" : include "views/admin/common/common-page-header.php";
?>
<?= @$content ?>
<?php
if (!isset($is404) || !$is404) {
    if ($_GET['controller'] === "client") {
        include "views/client/common/footer.php";
    } else {
        include "views/admin/common/common-page-footer.php";
    }
}

?>