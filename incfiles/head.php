<?php
header("Content-type: text/html; charset=utf-8");
$title = isset($title) ? $title : 'Music is my life';
?>

<html>
<head>
	<meta charset = "UTF-8" />
	<link href="<?=$home?>/themes/bootstrap-dist/css/bootstrap.css" type="text/css" rel="stylesheet" />
	<link href="<?=$home?>/themes/default.css" type="text/css" rel="stylesheet" />
	<link href="<?=$home?>/themes/font-awesome-4.7.0/css/font-awesome.css" type="text/css" rel="stylesheet" />
	<title><?=$title?></title>
</head>
<body>

<script src="<?=$home?>/themes/jquery.min.js"></script>

<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
        <div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav">
				<li <?=($headmod == '' ? 'class="active"' : '')?>><a href="<?=$home?>"><i class="fa fa-home"></i> Trang chủ</a></li>
				<li <?=($headmod == 'song' ? 'class="active"' : '')?>><a href="<?=$home?>/song.php"><i class="fa fa-music"></i> Bài hát</a></li>
				<li <?=($headmod == 'artist' ? 'class="active"' : '')?>><a href="<?=$home?>/artist.php"><i class="fa fa-users"></i> Nghệ sĩ</a></li>
			</ul>
			<div class="col-sm-3 col-md-3">
				<form class="navbar-form" role="search">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Nhập từ khóa" name="q">
					<div class="input-group-btn">
						<button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
					</div>
				</div>
				</form>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<?php
				IF ($user_id)
				{
					Echo '<li class="active"><a href="'.$home.'/admin/manager.php?act=song">'.$datauser['username'].' <span class="sr-only">(current)</span></a></li>';
					Echo '<li><a href="'.$home.'/admin/logout.php">Đăng xuất</a></li>';
				}
				ELSE
				{
					Echo '<li><a href="'.$home.'/admin/login.php"><i class="fa fa-user"></i> Đăng nhập</a></li>';
				}
				?>
			</ul>
        </div><!--/.nav-collapse -->
	</div>
</nav>

<div class="container maintxt">