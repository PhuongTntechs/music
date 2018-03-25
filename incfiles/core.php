<?php
define('ROOTPATH', dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

//Error_Reporting(E_ALL & ~E_NOTICE);
ini_set('arg_separator.output', '&amp;');
ini_set('display_errors', 'On');

spl_autoload_register("autoload");
function autoload($name)
{
	global $rootpath;
    $file = $rootpath . 'incfiles/classes/' . $name . '.php';
    if (file_exists($file))
        require_once $file;
}

$home = "http://localhost/music";

// REQUEST
$id = isset($_GET['id']) ? trim($_GET['id']) : false;
$act = isset($_REQUEST['act']) ? trim($_REQUEST['act']) : '';
$do = isset($_REQUEST['do']) ? trim($_REQUEST['do']) : '';
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 5; // số item hiển thị trên 1 trang

new Core;
$user_id = Core::$user_id;
$datauser = Core::$user_data;
$conn = Core::$conn;
// include_once 'func.php';
// Lấy tên thể loại từ id
function id2GenresName($conn,$id)
{
	IF ($id != 0)
	{
		$req = MYSQLI_FETCH_ARRAY(MYSQLI_QUERY($conn,"SELECT * FROM `genres` WHERE `id` = $id"));
		Return $req['name'];
	}
	ELSE
		Return 0;
}

// Lấy tên nghệ sĩ từ id
function id2ArtistsName($conn,$id)
{
	IF ($id != 0)
	{
		$req = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM `artists` WHERE `id` = $id"));
		Return $req['name'];
	}
	ELSE
		Return 0;
}
include_once 'func.php';
?>