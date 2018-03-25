<?php
$rootpath = "";
require 'incfiles/core.php';
$headmod = '';
require 'incfiles/head.php';

$search = isset($_REQUEST['q']) ? trim($_REQUEST['q']) : NULL;
?>
<div class="row">
<?php
IF ($search)
{
	Echo '<div class="col-xs-12 col-md-8">';
	Echo '<h3 class="title">Tìm kiếm</h3>';
	$sql = MYSQL_QUERY("SELECT * FROM `tracks` WHERE `name` LIKE '%$search%'");
	$total = MYSQL_NUM_ROWS($sql);
	IF ($total)
	{
		Echo '<h3>Bài hát "'.$search.'" có '.$total.' kết quả</h3><hr />';
		While ($res = MYSQL_FETCH_ASSOC($sql))
		{
			Echo "<div class='list' style=\"margin-top: 5px;margin-bottom: 5px\">
				<i class='fa fa-music'></i> <a class='name-song' href=\"song.php?id=".$res['id']."\">".$res['name']."</a> - <span class='artist-song'>".id2ArtistsName($res['genres_id'])."</span> <span class='pull-right'><i class='fa fa-headphones'></i> ".$res['view']." <a class='name-song' href=\"song.php?id=".$res['id']."\"><i class='fa fa-play'></i></a></span> <br />
				".($res['lyric'] != '' ? '<div style="color:gray"><i>'.text_limit($res['lyric'], 220).'</i></div>' : '')."
				</div>";
		}
	}
	ELSE
	{
		Echo "<div class=\"alert alert-warning\">Không có kết quả nào cho “{$search}”</div>";
	}
	Echo '</div>';
}
ELSE
{
?>
	<div class="col-xs-12 col-md-8">
		<div class="row">
			<div id="myCarousel" class="carousel slide" data-ride="carousel" style=" width:100%; height: auto !important;">
				<!-- Indicators -->
				<ol class="carousel-indicators">
					<?php
					for ($i = 0; $i < 3; $i++) {
						Echo '<li data-target="#myCarousel" data-slide-to="'.$i.'" '.($i == 0 ? 'class="active"' : '').'></li>';
					}
					?>
				</ol>
			
				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
					<div class="item active">
						<img src="public/images/slide/1.jpg" alt="">
					</div>
					<div class="item">
						<img src="public/images/slide/2.jpg" alt="">
					</div>
					<div class="item">
						<img src="public/images/slide/3.jpg" alt="">
					</div>
				</div>
			
				<!-- Left and right controls -->
				<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div>
	</div>

<?php
}

include 'template/bxh.php';
?>
<div class="col-xs-12 col-md-8">
	<h3 class="title">Bài hát mới nhất</h3>
	<?php
	$req = MYSQLI_QUERY($conn,"SELECT * FROM `tracks` ORDER BY `id` DESC LIMIT 5");
	$total = MYSQLI_NUM_ROWS($req);
	IF ($total > 0)
	{
		$i = 1;
		While ($res = mysqli_fetch_assoc($req))
		{
			Echo "<div class='list'>
				<i class='fa fa-music'></i> <a class='name-song' href=\"song.php?id=".$res['id']."\">".$res['name']."</a> <span class='pull-right'><i class='fa fa-headphones'></i> ".$res['view']."</span><br />
				<span class='artist-song'>".id2ArtistsName($conn,$res['artist'])."</span>
				</div>";
			$i++;
		}
	}
	?>
</div>
</div>
<?php
require_once 'incfiles/end.php';