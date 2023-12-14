<?php 
session_destroy();
echo '<script>window.location.href = "index.php?controller=client&action=home";</script>';

exit();
?>