<?php
date_default_timezone_set("Asia/Riyadh");
class Staticme {
	const DB_USER = 'root';
	const DB_PASS = 'root';
	const DB_NAME = 'staticme';
	public $URL;
	function __construct(){
		// Get URL
		$url = 'http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
		if(!strpos($url,'?'))
			$this->URL = $url;
		else
		{
			$urlp = explode('?', $url);
			$this->URL = $urlp[0];
		}
		if(!isset($_SESSION)) session_start();
		// Load Parts
		if(!isset($_GET['uid']))
		{
			$this->loadPart('header');
			$this->loadPart('menu');
		}
		// Run Controller
		if(isset($_REQUEST['do']))
			$this->routeAction($_REQUEST['do']);
		else
			$this->navigate('login');
	}

	function __destruct(){
		$this->loadPart('footer');
	}

	function navigate($target = NULL){
		if($target)
			header("Location: index.php?do=".$target);
		else
			header("Location: index.php");
	}

	function loadPart($part)
	{
		require_once('part_'.$part.'.php');
	}

	protected function dbConnect()
	{
		return new PDO('mysql:host=localhost;dbname='.self::DB_NAME,self::DB_USER,self::DB_PASS);
	}

	function routeAction($action){
		switch($action){
			case 'login': 		$this->login(); break;
			case 'logout': 		$this->logout(); break;
			case 'register': 	$this->register(); break;
			case 'sendip': 		$this->sendip(); break;
			case 'view': 		$this->view(); break;
		}
	}

	protected function login()
	{
		$rs = $this->dbConnect();
		if(isset($_POST['email']))
		{
			$res = $rs->prepare("SELECT * FROM users WHERE uEmail=:Email AND uPassword=PASSWORD(:Password)");
			$res->execute(array(':Email'=>$_POST['email'],':Password'=>$_POST['password']));
			if($res->rowCount() > 0)
			{
				$row = $res->fetch(PDO::FETCH_ASSOC);
				$_SESSION['USER']['ID'] = $row['uID'];
				$_SESSION['USER']['NAME'] = $row['uName'];
				$_SESSION['USER']['EMAIL'] = $row['uEmail'];
				$this->navigate('view');
			}
			else
			{
				$_SESSION['ERRORMSG'] = 'WRONG USERNAME OR PASSWORD .. PLEASE TRY AGINE';
				$this->navigate('login');
			}
		}
		else
			$this->loadPart('form');
	}

	// Check if user Exists
	protected function checkUser($uID)
	{
		$rs = $this->dbConnect();
		$res = $rs->prepare("SELECT * FROM users WHERE uID=:uID");
		$res->execute(array(':uID'=>$uID));
		if($res->rowCount() > 0)
			return true;
		else
			return false;
	}

	protected function register()
	{
		$rs = $this->dbConnect();
		if(isset($_POST['email']))
		{
			$uID = rand(1111111111,9999999999);
			$add = $rs->prepare("INSERT INTO users (uID,uEmail,uPassword) values (:uID,:Email,PASSWORD(:Password))");
			$result = $add->execute(array(':uID'=>$uID,':Email'=>$_POST['email'],':Password'=>$_POST['password']));
			if($result)
				$this->loadPart('body');
			else
				$_SESSION['ERRORMSG'] = 'User '.$_POST['email'].'Already Exists';
			$this->loadPart('form');
		}
		else
			$this->loadPart('form');
		session_unset('ERRORMSG');
	}

	protected function view()
	{
		$ipData = $this->getIp($_SESSION['USER']['ID']);
		if($ipData) { $_SESSION['USER']['IP'] = $ipData['iIp']; $_SESSION['USER']['IP_DATE'] = $ipData['iDate']; } else echo 'NO';
		$this->loadPart('body');
		$this->loadPart('footer');
	}

	protected function logout()
	{
		session_destroy();
		print_r($_SESSION['USER']);
		$this->navigate();
	}

	function sendIP()
	{
		$uID = (isset($_GET['uid']))?$_GET['uid']:$_SESSION['USER']['ID'];
		$today = date('Y-m-d H:i:s',time());
		$rs = $this->dbConnect();
		// Check if User Existst
		$user = $this->checkUser($uID);
		if(!$user) if(isset($_GET['uid'])) { echo 0; return false; } else return false;
		$ping = $rs->prepare("INSERT INTO iplog (uID,iIp,iDate) VALUES (:uID,:iIp,:iDate)");
		$result = $ping->execute(array(':uID'=>$uID,':iIp'=>$_SERVER['REMOTE_ADDR'],':iDate'=>$today));
		if($result)
			if(isset($_GET['uid'])) echo 1; else echo '<div class="val">SENDING IP:'.$_SERVER['REMOTE_ADDR'].'...</div>';
		else
			if(isset($_GET['uid'])) echo 0; else return false;
	}

	protected function getIP($uID)
	{
		$rs = $this->dbConnect();
		$res = $rs->prepare("SELECT * FROM iplog WHERE uID=:uID ORDER BY iDate DESC");
		$res->execute(array(':uID'=>$uID));
		if($res->rowCount() > 0)
			return $res->fetch(PDO::FETCH_ASSOC);
		else
			return false;
	}
}

?>