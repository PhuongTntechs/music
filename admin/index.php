<?php
$rootpath = "../";
require_once '../incfiles/core.php';

$head_location="home";

require_once '../incfiles/head.php';

if (!$user_id)
{
	header("Location: login.php");
}
else
{
	header("Location: manager.php"); // Chuyển hướng đến quản lý sinh viên
}
?>

</body>
<?php
require_once '../incfiles/end.php';