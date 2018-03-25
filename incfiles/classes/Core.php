<?php
Class Core
{
	public static $user_id;
    public static $user_data = array();
    public static $conn;
	
	function __construct()
	{
		$this->session_start();
		$this->db_connect();
		$this->authorize();
	}
	
    private function session_start()
    {
        session_name('SESID');
        session_start();
    }
	
	public function db_connect()
	{
		$db_host = 'localhost';
		$db_user = 'root';
		$db_pass = '';
		$db_name = 'music';
		
		// $conn = @MYSQLI_CONNECT($db_host, $db_user, $db_pass) or die("Error: Can't connect to server!");
        // @MYSQLI_SELECT_DB($db_name, $conn) or die ("ERROR: Database does't exists!");
        // MYSQLI_QUERY("SET NAMES 'UTF8'");
        $conn = mysqli_connect($db_host,$db_user,$db_pass) or die ("Error: Can't connect to server!");
        mysqli_select_db($conn, $db_name) or die ("ERROR: Database does't exists!");
        mysqli_query($conn,"SET NAMES 'UTF8'");
        self::$conn = $conn;
	}
	
	public function authorize()
	{
        $user_id = false;
        $user_ps = false;
        if (isset($_SESSION['uid']) && isset($_SESSION['ups'])) {

            $user_id = abs(intval($_SESSION['uid']));
            $user_ps = $_SESSION['ups'];
        } elseif (isset($_COOKIE['cuid']) && isset($_COOKIE['cups'])) {

            $user_id = abs(intval(base64_decode(trim($_COOKIE['cuid']))));
            $_SESSION['uid'] = $user_id;
            $user_ps = md5(trim($_COOKIE['cups']));
            $_SESSION['ups'] = $user_ps;
        }
        if ($user_id && $user_ps)
		{
            $req = mysql_query("SELECT * FROM `user` WHERE `id` = '$user_id'");
            if (mysql_num_rows($req))
			{
                $user_data = mysql_fetch_assoc($req);
                if ($user_ps === $user_data['password']) {
                    self::$user_id = $user_data['id'] ? $user_id : false;
                    self::$user_data = $user_data;
                }
            }
        }
	}
}