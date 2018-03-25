<div class="col-md-8">
<?php
Switch ($do)
{
	Case 'add':
		$name = isset($_POST['nameSong']) ? trim($_POST['nameSong']) : NULL;
		$artist = isset($_POST['artist']) ? abs($_POST['artist']) : NULL;
		$genres = isset($_POST['genres']) ? abs($_POST['genres']) : NULL;
		$lyric = isset($_POST['lyric']) ? trim($_POST['lyric']) : NULL;
		
		IF (isset($_POST['submit']))
		{
			$check_file = true;
			
			$error = array();
			IF ($name == NULL || $artist == NULL || $genres == NULL)
			{
				$error[] = 'Vui lòng điền đủ dữ liệu';
			}
			
			IF ($_FILES['file']['name'] != '')
			{
				$namef = UTF2ASCII($_FILES['file']['name']);
				$allow_ext = array("mp3", "wma", "m4a");
				
				$ext = format($namef);
				
				IF (!in_array($ext, $allow_ext))
				{
					$error[] = 'Định dạng file không hợp lệ';
				}
	
				$namef = time().'-'.$namef;
				$path = '../upload/'.$namef;
				if (file_exists($path))
				{
					$error[] = 'File đã tồn tại';
				}
				
			}
			else
			{
				$namef = $result['location'];
				$check_file = false;
			}
			
			IF (!$error)
			{
				IF ($check_file)
					move_uploaded_file($_FILES["file"]["tmp_name"], $path);
				
				MYSQL_QUERY("INSERT INTO `tracks` SET
				`genres_id` = $genres,
				`name` = '$name',
				`lyric` = '$lyric',
				`artist` = $artist,
				`location` = '$namef'
				") or exit(MYSQL_ERROR());
				Echo '<div class="notify">Đã thêm thành công</div>';
				?>
				<script>
				$(document).ready(function() {
					$(".notify").show(500);
					$(".notify").delay(1000);
					$(".notify").hide(500);
				});
				</script>
				<meta http-equiv="refresh" content="3;URL=<?=$home?>/admin/manager.php?act=song">
				<?php
			}
		}
		
		?>
		<div>
			<form action="manager.php?act=song&do=add" method="POST" enctype="multipart/form-data">
				<label>Tên bài hát:</label>
				<input class="form-control" type="text" name="nameSong" value="" /><br />
				
				<label>Nghệ sĩ:</label>
				<select name="artist" class="form-control">
					<option value="">--Chọn--</option>
					<?php
					$req = MYSQL_QUERY("SELECT * FROM `artists` ORDER BY `name` DESC");
					While ($res = MYSQL_FETCH_ASSOC($req))
					{
						Echo '<option value="'.$res['id'].'">'.$res['name'].'</option>';
					}
					?>
				</select><br />
				
				<label>Thể loại:</label>
				<select name="genres" class="form-control">
					<option value="">--Chọn--</option>
					<?php
					$req = MYSQL_QUERY("SELECT * FROM `genres` ORDER BY `id` DESC");
					While ($res = MYSQL_FETCH_ASSOC($req))
					{
						Echo '<option value="'.$res['id'].'">'.$res['name'].'</option>';
					}
					?>
				</select><br />
				
				<label>Lời bài hát</label>
				<textarea class="form-control" name="lyric" rows="8"></textarea><br />
				
				<label style="margin-left: 10px">File:</label>
				<input class="form-control" type="file" name="file" /><br />
				
				<label></label>
				<input class="btn btn-success" type="submit" name="submit" value="Thêm" />
			</form>
		</div>
	<?php
	Break;
	
	Case 'edit':
		$result = MYSQL_FETCH_ASSOC(MYSQL_QUERY("SELECT * FROM `tracks` WHERE `id` = $id"));
		
		$name = isset($_POST['nameSong']) ? trim($_POST['nameSong']) : NULL;
		$artist = isset($_POST['artist']) ? abs($_POST['artist']) : NULL;
		$genres = isset($_POST['genres']) ? abs($_POST['genres']) : NULL;
		$lyric = isset($_POST['lyric']) ? trim($_POST['lyric']) : NULL;
		
		IF (isset($_POST['submit']))
		{
			$check_file = true;
			
			$error = array();
			IF ($name == NULL || $artist == NULL || $genres == NULL)
			{
				$error[] = 'Vui lòng điền đủ dữ liệu';
			}
			
			IF ($_FILES['file']['name'] != '')
			{
				$namef = UTF2ASCII($_FILES['file']['name']);
				$allow_ext = array("mp3", "wma", "m4a");
				
				$ext = format($namef);
				
				IF (!in_array($ext, $allow_ext))
				{
					$error[] = 'Định dạng file không hợp lệ';
				}
	
				$namef = time().'-'.$namef;
				$path = '../upload/'.$namef;
				if (file_exists($path))
				{
					$error[] = 'File đã tồn tại';
				}
				
			}
			else
			{
				$namef = $result['location'];
				$check_file = false;
			}
			
			IF (!$error)
			{
				IF ($check_file)
					move_uploaded_file($_FILES["file"]["tmp_name"], $path);
				
				MYSQL_QUERY("UPDATE `tracks` SET
				`genres_id` = $genres,
				`name` = '$name',
				`lyric` = '$lyric',
				`artist` = $artist,
				`location` = '$namef'
				WHERE `id` = $id
				") or exit(MYSQL_ERROR());
				Echo '<div class="notify">Đã sửa thành công</div>';
				?>
				<script>
				$(document).ready(function() {
					$(".notify").show(500);
					$(".notify").delay(1000);
					$(".notify").hide(500);
				});
				</script>
				<meta http-equiv="refresh" content="3;URL=<?=$home?>/admin/manager.php?act=song">
				<?php
			}
		}
		
		?>
		<div>
			<form action="manager.php?act=song&do=edit&id=<?=$id?>" method="POST" enctype="multipart/form-data">
				<label>Tên bài hát:</label>
				<input class="form-control" type="text" name="nameSong" value="<?=$result['name']?>" /><br />
				
				<label>Nghệ sĩ:</label>
				<select name="artist" class="form-control">
					<?php
					$req = MYSQL_QUERY("SELECT * FROM `artists` ORDER BY `name` DESC");
					While ($res = MYSQL_FETCH_ASSOC($req))
					{
						Echo '<option value="'.$res['id'].'"'.($result['artist'] == $res['id'] ? ' selected' : '').'>'.$res['name'].'</option>';
					}
					?>
				</select><br />
				
				<label>Thể loại:</label>
				<select name="genres" class="form-control">
					<?php
					$req = MYSQL_QUERY("SELECT * FROM `genres` ORDER BY `id` DESC");
					While ($res = MYSQL_FETCH_ASSOC($req))
					{
						Echo '<option value="'.$res['id'].'"'.($result['genres_id'] == $res['id'] ? ' selected' : '').'>'.$res['name'].'</option>';
					}
					?>
				</select><br />
				
				<label>Lời bài hát</label>
				<textarea class="form-control" name="lyric" rows="8"><?=$result['lyric']?></textarea><br />
				
				<label>File:</label>
				<input class="form-control" type="text" value="/upload/<?=$result['location'];?>" /><br />
				
				<label style="margin-left: 10px"></label>
				<input class="form-control" type="file" name="file" /><br />
				
				<label></label>
				<input class="btn btn-default" type="submit" name="submit" value="Lưu lại" />
			</form>
		</div>
		<?php
	Break;
	
	Case 'delete':
		IF (isset($_POST['submit']))
		{
			$result = MYSQL_FETCH_ASSOC(MYSQL_QUERY("SELECT * FROM `tracks` WHERE `id` = $id"));
			
			@unlink("../upload/".$result['location']);
			
			MYSQL_QUERY("DELETE FROM `tracks` WHERE `id` = $id");
			
			Echo '<div class="notify">Đã xóa thành công</div>';
			?>
			<script>
			$(document).ready(function() {
				$(".notify").show(500);
				$(".notify").delay(1000);
				$(".notify").hide(500);
			});
			</script>
			<meta http-equiv="refresh" content="3;URL=<?=$home?>/admin/manager.php?act=song">
			<?php
		}
		ELSE
		{
		?>
		<form action="manager.php?act=song&do=delete&id=<?=$id?>" method="POST">
			Bạn có thực sự muốn xóa? <input class="btn btn-warning" type="submit" name="submit" value="Đồng ý" />
		</form>
		<?php
		}

	Break;
	
	Default:
		$req = MYSQL_QUERY("SELECT * FROM `tracks` ORDER BY `id` DESC");
		$total = MYSQL_NUM_ROWS($req);
		Echo '<div><a href="manager.php?act=song&do=add"><span class="label label-success">Thêm mới</span></a></div><br />';
		IF ($total > 0)
		{
			Echo '<hr style="padding: 0px;margin: 0px;" />';
			While ($res = MYSQL_FETCH_ASSOC($req))
			{
				?>
				<div class="list">
					<i class="fa fa-music"></i> <?=$res['name']?> - <span class="artist-song"><?=id2ArtistsName($res['artist'])?></span><br />
					<audio preload="auto" controls class="audio">
						<source src="../upload/<?=$res['location'];?>" type="audio/mpeg">
					</audio>
					<span class="pull-right">
						<a href="manager.php?act=song&do=edit&id=<?=$res['id'];?>"><span class="label label-success">Sửa</span></a> <a href="manager.php?act=song&do=delete&id=<?=$res['id'];?>"><span class="label label-danger">Xóa</span></a>
					</span>
				</div>
				<?php
			}
		}
	Break;
}
?>
</div>