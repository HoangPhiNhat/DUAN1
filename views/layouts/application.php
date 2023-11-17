<?php
include "views/client/common/header.php";

?>
<?= @$content ?>
<?php
if (!isset($is404) || !$is404) {
    include "views/client/common/footer.php";
}
?>