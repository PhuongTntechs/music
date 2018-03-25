<?php
$rootpath = "";
require 'incfiles/core.php';
$title = 'Nghệ sĩ';
$headmod = "artist";
require 'incfiles/head.php';

IF (!$id)
{
	$req = MYSQL_QUERY("SELECT * FROM `artists` ORDER BY `id` DESC");
	$total = MYSQL_NUM_ROWS($req);
	IF ($total > 0)
	{
		Echo '<hr style="padding: 0px;margin: 0px;" />';
		While ($res = MYSQL_FETCH_ASSOC($req))
		{
			?>
			<div class="list">
				<i class="fa fa-microphone"></i> <a href="artist.php?id=<?=$res['id']?>"><?=$res['name']?></a>
				<?php
				IF ($res['description'] != '')
				{
					Echo '<br /><span class="artist-song">'.text_limit($res['description'], 150).'</span>';
				}
				?>
			</div>
			<?php
		}
	}
}
ELSE
{
	?>
	<Div class="row">
		<div class="col-xs-12 col-md-8">
		<?php
			$req = MYSQL_QUERY("SELECT * FROM `tracks` WHERE `artist` = '$id' ORDER BY `id` DESC");
			$total = MYSQL_NUM_ROWS($req);
			IF ($total > 0)
			{
				Echo '<h3 class="title">Danh sách bài hát</h3>';
				Echo '<hr style="padding: 0px;margin: 0px;" />';
				While ($res = MYSQL_FETCH_ASSOC($req))
				{
					?>
					<div class="list">
						<i class="fa fa-music"></i> <a class='name-song' href="song.php?id=<?=$res['id']?>"><?=$res['name']?></a> - <span class="artist-song"><?=id2ArtistsName($res['artist'])?></span><br />
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
			?>
		</div>
		
		<?php include 'template/bxh.php'; ?>
	</div>
	<?php
}

require_once 'incfiles/end.php';