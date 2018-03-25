<?php
$rootpath = "../";
require_once '../incfiles/core.php';
$headmod = '';
require_once '../incfiles/head.php';
?>
<center>
    <h1>Đăng nhập</h1>
</center>
<hr/>

<?php
IF ($user_id)
{
	Header("Location: manager.php");
}

if (isset($_POST['submit']))
{
	$user = trim($_POST['u']);
	$pass = trim($_POST['p']);
	
	$error = array();
	if (!$user)
		$error[] = '<p class="text-danger">Bạn chưa nhập tên người dùng</p>';
	if (!$pass)
		$error[] = '<p class="text-danger">Bạn chưa nhập mật khẩu</p>';
	
	if (!$error && $user && $pass)
	{
		$req = MYSQLI_QUERY($conn,"SELECT * FROM `user` WHERE `username`='" . $user . "' LIMIT 1");
		if (MYSQL_NUM_ROWS($req) > 0)
		{
			$user = MYSQLI_FETCH_ASSOC($req);
			if (md5($pass) == $user['password'])
			{ // nếu nhập đúng mật khẩu
				$cuid = base64_encode($user['id']); // mã hóa base64 cho user id
				$cups = md5($pass); // mã hóa md5 1 lần cho pass
				setcookie("cuid", $cuid, time() + 3600 * 24 * 365); // lưu user id đã được mã hóa vào cookie cuid
				setcookie("cups", $cups, time() + 3600 * 24 * 365); // lưu pass đã được mã hóa vào cookie cups
				$_SESSION['uid'] = $user['id'];
				$_SESSION['ups'] = md5($pass);
				header('Location: '.$home); // chuyển đến trang quản lý sinh viên
			}
			else // nếu mật khẩu không đúng sẽ thông báo lỗi
			{
				$error[] = '<p class="text-danger">Mật khẩu không chính xác</p>';
			}
		}
		else // thông báo người dùng không tồn tại
		{
			Echo '<p class="text-warning">Người dùng không tồn tại</p>';
		}
	}
	if ($error) // nếu có lỗi sẽ hiển thị danh sách lỗi
	{
		Echo implode("", $error);
	}
}
?>
<form action="" method="POST" class="form-horizontal">
	<div class="form-group">
		<label class="control-label col-sm-2" for="username">Tên đăng nhập:</label>
		<div class="col-sm-5">
			<input class="form-control" type="text" name="u" value="<?=(isset($_POST['u']) ? $_POST['u'] : '')?>" placeholder="Enter username..." /><br />
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="email">Mật khẩu:</label>
		<div class="col-sm-5">
			<input class="form-control" type="password" name="p" value="<?=(isset($_POST['p']) ? $_POST['p'] : '')?>" /><br />
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<input type="submit" name="submit" value="Đăng nhập" /><br />
		</div>
	</div>
</form>

<?php
require_once '../incfiles/end.php';
?>