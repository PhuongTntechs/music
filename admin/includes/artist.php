<div class="col-md-8">
<?php
Switch ($do)
{
	Case 'add':
		$name = isset($_POST['name']) ? trim($_POST['name']) : NULL;
		$des = isset($_POST['info']) ? trim($_POST['info']) : NULL;
		
		IF (isset($_POST['submit']))
		{
			$error = array();
			IF ($name == NULL)
			{
				$error[] = 'Vui lòng điền đủ dữ liệu';
			}
			
			IF (!$error)
			{
				
				MYSQL_QUERY("INSERT INTO `artists` SET
				`name` = '$name',
				`description` = '$des'
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
				<meta http-equiv="refresh" content="3;URL=<?=$home?>/admin/manager.php?act=artist">
				<?php
			}
		}
		
		?>
		<div>
			<form action="manager.php?act=artist&do=add" method="POST">
				<label>Tên nghệ sĩ:</label>
				<input class="form-control" type="text" name="name" value="" /><br />

				<label>Thông tin:</label>
				<textarea class="form-control" name="info" rows="8"></textarea><br />
				
				<label></label>
				<input class="btn btn-default" type="submit" name="submit" value="Thêm" />
			</form>
		</div>
	<?php
	Break;
	
	Case 'edit':
		$result = MYSQL_FETCH_ASSOC(MYSQL_QUERY("SELECT * FROM `artists` WHERE `id` = $id"));
		
		$name = isset($_POST['name']) ? trim($_POST['name']) : NULL;
		$des = isset($_POST['info']) ? trim($_POST['info']) : NULL;
		
		IF (isset($_POST['submit']))
		{

			$error = array();
			IF ($name == NULL)
			{
				$error[] = 'Vui lòng điền đủ dữ liệu';
			}
			
			IF (!$error)
			{
				
				MYSQL_QUERY("UPDATE `artists` SET
				`name` = '$name',
				`description` = '$des'
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
				<meta http-equiv="refresh" content="3;URL=<?=$home?>/admin/manager.php?act=artist">
				<?php
			}
		}
		
		?>
		<div>
			<form action="manager.php?act=artist&do=edit&id=<?=$id?>" method="POST">
				<label>Tên nghệ sĩ:</label>
				<input class="form-control" type="text" name="name" value="<?=$result['name']?>" /><br />
				
				<label>Thông tin:</label>
				<textarea class="form-control" name="info" rows="8"><?=$result['description']?></textarea><br />
				
				<label></label>
				<input class="btn btn-default" type="submit" name="submit" value="Lưu lại" />
			</form>
		</div>
		<?php
	Break;
	
	Case 'delete':
		IF (isset($_POST['submit']))
		{
			MYSQL_QUERY("DELETE FROM `artist` WHERE `id` = $id");
			
			Echo '<div class="notify">Đã xóa thành công</div>';
			?>
			<script>
			$(document).ready(function() {
				$(".notify").show(500);
				$(".notify").delay(1000);
				$(".notify").hide(500);
			});
			</script>
			<meta http-equiv="refresh" content="3;URL=<?=$home?>/admin/manager.php?act=artist">
			<?php
		}
		ELSE
		{
		?>
		<form action="manager.php?act=artist&do=delete&id=<?=$id?>" method="POST">
			Bạn có thực sự muốn xóa? <input class="btn btn-default" type="submit" name="submit" value="Đồng ý" />
		</form>
		<?php
		}

	Break;
	
	Default:
		$req = MYSQL_QUERY("SELECT * FROM `artists` ORDER BY `id` DESC");
		$total = MYSQL_NUM_ROWS($req);
		Echo '<div><a href="manager.php?act=artist&do=add"><span class="label label-success">Thêm mới</span></a></div><br />';
		IF ($total > 0)
		{
			Echo '<hr style="padding: 0px;margin: 0px;" />';
			While ($res = MYSQL_FETCH_ASSOC($req))
			{
				?>
				<div class="list">
					<i class="fa fa-microphone"></i> <?=$res['name']?>
					<?php
					IF ($res['description'] != '')
					{
						Echo '<br /><span class="artist-song">'.text_limit($res['description'], 150).'</span>';
					}
					?>
					<span class="pull-right">
						<a href="manager.php?act=artist&do=edit&id=<?=$res['id'];?>"><span class="label label-success">Sửa</span></a> <a href="manager.php?act=artist&do=delete&id=<?=$res['id'];?>"><span class="label label-danger">Xóa</span></a>
					</span>
				</div>
				<?php
			}
		}
	Break;
}
?>
</div>