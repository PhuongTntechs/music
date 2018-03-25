<?php
$rootpath = "../";
require_once '../incfiles/core.php';
$title = 'Quản lý';
$headmod = '';
require_once '../incfiles/head.php';

if (!$user_id)
{
	header("Location: login.php");
}
else
{
		
	$array = array(
		'song',
		'artist',
		'genres'
	);
	?>
	<div class="row">
		<div class="col-md-3">
			<ul class="list-group">
				<a class="list-group-item<?=($act == 'song' ? ' active' : '')?>" href="manager.php?act=song"><i class="fa fa-music"></i> Quản lý bài hát</a>
				<a class="list-group-item<?=($act == 'artist' ? ' active' : '')?>" href="manager.php?act=artist"><i class="fa fa-user"></i> Quản lý nghệ sĩ</a>
				<a class="list-group-item<?=($act == 'genres' ? ' active' : '')?>" href="manager.php?act=genres"><i class="fa fa-list"></i> Quản lý thể loại</a>
			</ul>
		</div>
		<?php
	IF ($act && ($key = array_search($act, $array)) !== false && file_exists('includes/' . $array[$key] . '.php'))
	{
		require('includes/' . $array[$key] . '.php');
	}
	ELSE
	{
		?>
		<div class="col-md-8">
		Quản lý
		</div>
		<?php
	}
	?>
	</div>
	<?php
}
?>

</body>
<?php
require_once '../incfiles/end.php';