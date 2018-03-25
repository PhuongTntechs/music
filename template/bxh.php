<div class="col-xs-12 col-md-4">
	<h3 class="title">BXH bài hát</h3>
	<?php
	$req = mysqli_query($conn,"SELECT * FROM `tracks` ORDER BY `view` DESC LIMIT 5");
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