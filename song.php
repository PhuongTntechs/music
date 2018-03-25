<?php
$rootpath = "";
require 'incfiles/core.php';
$title = 'Danh sách bài hát';
$headmod = "song";
require 'incfiles/head.php';
?>
<div class="row">

<?php
IF (!$id)
{
	Echo '<div class="col-xs-12 col-md-8">';
	$req = MYSQLI_QUERY($conn,"SELECT * FROM `tracks` ORDER BY `id` DESC");
	$total = MYSQL_NUM_ROWS($req);
	IF ($total > 0)
	{
		Echo '<h3 class="title">Danh sách bài hát</h3>';
		Echo '<hr style="padding: 0px;margin: 0px;" />';
		While ($res = MYSQL_FETCH_ASSOC($req))
		{
			?>
			<div class="list">
				<i class="fa fa-music"></i> <a class='name-song' href="song.php?id=<?=$res['id']?>"><?=$res['name']?></a> - <span class="artist-song"><?=id2ArtistsName($conn,$res['artist'])?></span><br />
				<audio preload="auto" controls class="audio">
					<source src="upload/<?=$res['location'];?>" type="audio/mpeg">
				</audio>
			</div>
			<?php
		}
	}
	ELSE
	{
		Echo '<div class="alert alert-warning">Không có dữ liệu</div>';
	}
	Echo '</div>';
}
ELSE
{
	?>
	<div class="col-xs-12 col-md-8">
		<?php
		MYSQLI_QUERY($conn,"UPDATE `tracks` SET `view` = (`view` + 1) WHERE `id` = $id");
		$result = MYSQLI_FETCH_ARRAY(MYSQLI_QUERY($conn,"SELECT * FROM `tracks` WHERE `id` = $id"));
		?>
		<img src="themes/images/music-banner-resized.jpg" width="100%" />
		<audio controls autoplay="true" style="width: 100%;">
			<source src="upload/<?=$result['location'];?>" type="audio/mpeg">
			Your browser does not support the audio element.
		</audio>
		
		<p class="title-song">
			<?=$result['name']?> - <?=id2ArtistsName($conn,$result['artist'])?> <span class="pull-right"><i class="fa fa-headphones"></i> <?=$result['view']?></span>
		</p>
		
		<p class="option-song"><a href="upload/<?=$result['location'];?>"><i class="fa fa-download"></i> Tải nhạc</a> &nbsp;&nbsp;&nbsp;<i class="fa fa-share-alt"></i> Chia sẻ</p>
		
		<p class="lyric-song">
			<?php
			Echo '<div class="lyric">';
			Echo '<font size="5px">Lời bài hát: '.$result['name'].'</font><hr />';
			IF ($result['lyric'] != '')
			{
				Echo nl2br($result['lyric']);
			}
			ELSE
			{
				Echo 'Chưa có lời bài hát cho bài này';
			}
			Echo '</div>';
			?>
		</p>
	</div>
	<div class="col-md-4">
		<h3 class="title">BXH bài hát</h3>
		<?php
		$req = MYSQLI_QUERY($conn,"SELECT * FROM `tracks` ORDER BY `view` DESC LIMIT 5");
		$total = MYSQL_NUM_ROWS($req);
		IF ($total > 0)
		{
			$i = 1;
			While ($res = mysql_fetch_assoc($req))
			{
				Echo "<div class='list'>
					<i class='fa fa-music'></i> <a class='name-song' href=\"song.php?id=".$res['id']."\">".$res['name']."</a> <span class='pull-right'><i class='fa fa-headphones'></i> ".$res['view']."</span><br />
					<span class='artist-song'>".id2ArtistsName($conn,$res['genres_id'])."</span>
					</div>";
				$i++;
			}
		}
		?>
		<br />
		<h3 class="title">cùng nghệ sĩ</h3>
		<?php
		$req = MYSQL_QUERY("SELECT * FROM `tracks` WHERE `artist` = ".$result['artist']." ORDER BY RAND() LIMIT 5");
		$total = MYSQL_NUM_ROWS($req);
		IF ($total > 0)
		{
			$i = 1;
			While ($res = mysql_fetch_assoc($req))
			{
				Echo "<div class='list'>
					<i class='fa fa-music'></i> <a class='name-song' href=\"song.php?id=".$res['id']."\">".$res['name']."</a> <span class='pull-right'><i class='fa fa-headphones'></i> ".$res['view']."</span><br />
					<span class='artist-song'>".id2ArtistsName($conn,$res['genres_id'])."</span>
					</div>";
				$i++;
			}
		}
		?>
	</div>
</div>
<?php
}
?>
</div>
</div>
<?php
require_once 'incfiles/end.php';