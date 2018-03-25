<?php
$rootpath = "../";
require_once '../incfiles/core.php';
$headmod = '';

$referer = isset($_SERVER['HTTP_REFERER']) ? htmlspecialchars($_SERVER['HTTP_REFERER']) : $home;

if (isset($_POST['submit'])) {
    setcookie('cuid', '');
    setcookie('cups', '');
    session_destroy();
    header('Location: ../index.php');
} else {
    require('../incfiles/head.php');
    echo'<div class="bg-warning">' .
        '<form action="logout.php" method="post">' .
		'<p>Bạn có chắc chắn muốn đăng xuất?' .
		'<input type="submit" name="submit" value="Đồng ý" /></p></form>' .
        '<p><a href="' . $referer . '">Hủy bỏ</a></p>' .
        '</div>';
    require('../incfiles/end.php');
}
?>