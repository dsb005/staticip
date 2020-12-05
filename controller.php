<?php
//ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL);
class Staticip {
	const DB_USER = 'root';
	const DB_PASS = 'root';
	const DB_NAME = 'pr_staticip';
	public $URL;
	function __construct(){
		// Get URL
		// if($_SERVER['REMOTE_ADDR'] == '127.0.0.1')
		// 	$url = 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
		// else
		//$url = 'http://gcdc2013-scloud.appspot.com'.$_SERVER["REQUEST_URI"];
		$url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		if(!strpos($url,'?'))
			$this->URL = $url;
		else
		{
			$urlp = explode('?', $url);
			$this->URL = $urlp[0];
		}
		if(!isset($_SESSION)) session_start();
		// Run Controller
		if((isset($_GET['do']) && isset($_SESSION['USER'])) || $_GET['do'] == 'register' || $_GET['do'] == 'login' || $_GET['do'] == 'sendip')
			$this->routeAction($_GET['do']);
		else
			$this->navigate('login');
	}

	function __destruct(){
		$this->loadPart('footer');
	}

	protected function loadTemplate()
	{
		$this->loadPart('header');
		$this->loadPart('menu');
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
		$con = new PDO('mysql:host=localhost;dbname='.self::DB_NAME,self::DB_USER,self::DB_PASS);
		$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $con;
	}

	protected function routeAction($action){
		switch($action){
			case 'login': 		$this->login(); break;
			case 'logout': 		$this->logout(); break;
			case 'register': 	$this->register(); break;

			case 'home': 		$this->home(); break;
			case 'sendip': 		$this->sendip(); break;
			case 'view': 		$this->view(); break;
			case 'account':		$this->account(); break;
			case 'device':		$this->device(); break;
			case 'help':		$this->help(); break;
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
				$this->view();
				return false;
			}
			else
			{
				$_SESSION['ERRORMSG'] = 'WRONG USERNAME OR PASSWORD .. PLEASE TRY AGINE';
				$this->loadTemplate();
				$this->loadPart('login');
			}
		}
		else
		{
			$this->loadTemplate();
			$this->loadPart('login');
		}
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

	protected function getDeviceUserID($dID)
	{
		$rs = $this->dbConnect();
		$res = $rs->prepare("SELECT uID FROM devices WHERE dID=:dID");
		$res->execute(array('dID'=>$dID));
		$user = $res->fetch(PDO::FETCH_ASSOC);
		if($res->rowCount() > 0)
			return $user['uID'];
		else
			return false;
	}

	protected function getRandID($pr = false)
	{
		// $uid = hexdec(uniqid());
		// $id = str_replace(".","",$uid);
		// $id = str_replace("+","",$id);
		// $id = str_replace("E","",$id);
		//$id = hexdec(uniqid());
		$id = rand(100000000,999999999);
		if($pr)
			return substr($id,-5);
		else
			return substr($id,-10);
	}

	protected function register()
	{
		$rs = $this->dbConnect();
		if(isset($_POST['email']))
		{
			$uID = $this->getRandID();
			$add = $rs->prepare("INSERT INTO users (uID,uEmail,uPassword) values (:uID,:Email,PASSWORD(:Password))");
			$result = $add->execute(array(':uID'=>$uID,':Email'=>$_POST['email'],':Password'=>$_POST['password']));
			if($result){
				$this->login();
				return false;
			}
			else
			{
				$_SESSION['ERRORMSG'] = 'User '.$_POST['email'].'Already Exists';
			}
		}
		$this->loadTemplate();
		$this->loadPart('login');
		session_unset('ERRORMSG');
	}

	protected function getDeviceTypes($id = NULL)
	{
		$dtypes = array('pc','laptop','mobile','server');
		if($id != NULL)
			return $dtypes[$id];
		else
			return $dtypes;
	}

	protected function device()
	{
		$_SESSION['DTYPES'] = $this->getDeviceTypes();
		$dID = $this->getRandID(1);
		$rs = $this->dbConnect();
		if(isset($_GET['action']) && !isset($_POST['action']))
		{
			if($_GET['action'] == 'delete')
			{
				$res = $rs->prepare("DELETE FROM devices WHERE uID=:uID AND dID=:dID");
				$del = $res->execute(array(':uID'=>$_SESSION['USER']['ID'],':dID'=>$_GET['did']));
				if($del)
				{
					$this->getDevices();
					$this->loadTemplate();
					$this->loadPart("view");
				}
				else
				{
					$_SESSION['ERRORMSG'] = 'Cant Delete Device!';
				}
			}
		}
		elseif(isset($_POST['action']))
		{
			$_SESSION['ERRORMSG'] = NULL;
			if($_POST['action'] == 'add')
			{
				$res = $rs->prepare("INSERT INTO devices (dID, uID, dType, dName) VALUES (:dID, :uID, :dType, :dName)");
				$add = $res->execute(array(':dID'=>$dID,':uID'=>$_SESSION['USER']['ID'],':dType'=>$_POST['dtype'],':dName'=>$_POST['dname']));
				if($add){
					$_SESSION['ERRORMSG'] = 'Your Device was Added Sucessfully...';
					$this->getDevices();
					$this->loadTemplate();
					$this->loadPart("view");
				}
				else{
					$_SESSION['action'] = 'add';
					$_SESSION['ERRORMSG'] = 'Cant Add Device!';
				}
			}
			elseif($_POST['action'] == 'update')
			{
				$res = $rs->prepare("UPDATE devices set dType=:dType, dName=:dName WHERE dID=:dID");
				$upd = $res->execute(array(':dType'=>$_POST['dtype'],':dName'=>$_POST['dname'],':dID'=>$_POST['did']));
				if($upd)
				{
					$this->getDevices();
					$this->loadTemplate();
					$this->loadPart("view");
				}
				else
				{
					$_SESSION['action'] = 'update';
					$_SESSION['ERRORMSG'] = 'Cant Update Device!';
				}
			}
		}
		else
		{
			$_SESSION['ERRORMSG'] = NULL;
			$_SESSION['action'] = 'add';
			if(isset($_GET['did'])) $this->getDevices($_GET['did']);
			$this->loadTemplate();
			$this->loadPart('device');
		}
	}

	protected function getDevices($id = NULL,$ip = false)
	{
		$rs = $this->dbConnect();
		$_SESSION['DEVICES'] = NULL;
		if($id != NULL)
		{
			$res = $rs->prepare("SELECT * from devices WHERE uID=:uID AND dID=:dID");
			$dev = $res->execute(array(':uID'=>$_SESSION['USER']['ID'],':dID'=>$id));
		}
		else
		{
			$res = $rs->prepare("SELECT * FROM devices where uID=:uID");
			$dev = $res->execute(array(':uID'=>$_SESSION['USER']['ID']));
		}

		if($res->rowCount() > 0)
		{
			while($row = $res->fetch(PDO::FETCH_ASSOC))
			{
				$row['dTypeID'] = $row['dType'];
				$row['iIp'] = $this->getDeviceIP($row['dID']);
				$row['dType'] = $this->getDeviceTypes($row['dType']);
				$_SESSION['DEVICES'][] = $row;
			}
		}
		else
		{
			$_SESSION['ERRORMSG'] = 'There was a Problem Loading Devices Information...';
		}
	}

	protected function getDeviceIP($dID)
	{
		$rs = $this->dbConnect();
		$res = $rs->prepare("SELECT iIp from iplog WHERE iID=(SELECT MAX(iID) from iplog GROUP BY dID HAVING dID=:dID)");
		$ip = $res->execute(array(':dID'=>$dID));
		if($res->rowCount() > 0)
		{
			$row = $res->fetch(PDO::FETCH_ASSOC);
			return $row['iIp'];
		}
		else
		{
			return '0.0.0.0';
		}
	}

	protected function home()
	{
		$this->loadTemplate();
		$this->loadPart("home");
	}

	protected function account()
	{
		$rs = $this->dbConnect();
		if(isset($_POST['name']))
		{
			$upd = $rs->prepare("UPDATE users set uName=:uName, uEmail=:uEmail, uPassword=PASSWORD(:uPassword) WHERE uID=:uID");
			$res = $upd->execute(array(':uName'=>$_POST['name'],':uEmail'=>$_POST['email'],':uPassword'=>$_POST['password'],':uID'=>$_SESSION['USER']['ID']));
			if($res)
			{
				$res = $this->getUser();
				$_SESSION['ERRORMSG'] = 'User has been Updates Successfully';
			}
			else
				$_SESSION['ERRORMSG'] = 'ERROR: Cant Update User Data...';
		}
		else
		{
			$res = $this->getUser();
			$this->loadTemplate();
		}
		$this->loadTemplate();
		$this->loadPart("account");
	}

	protected function getUser()
	{
		$rs = $this->dbConnect();
		$res = $rs->prepare("SELECT * FROM users WHERE uID=:uID");
		$res->execute(array(':uID'=>$_SESSION['USER']['ID']));
		if($res->rowCount() > 0)
		{
			$row = $res->fetch(PDO::FETCH_ASSOC);
			$_SESSION['USER']['ID'] = $row['uID'];
			$_SESSION['USER']['NAME'] = $row['uName'];
			$_SESSION['USER']['EMAIL'] = $row['uEmail'];
			return true;
		}
		else
			return false;
	}

	protected function view()
	{

		$this->getDevices();
		//if(!$_SESSION['DEVICES']) $this->navigate('device');
		$this->loadTemplate();
		$this->loadPart('view');
	}

	protected function help()
	{
		$this->loadPart('header');
		$this->loadPart('menu');
		$this->getDevices($_GET['did']);
		$this->loadPart('help');
		$this->loadPart('footer');
	}

	protected function logout()
	{
		session_destroy();
		$this->navigate();
	}

	function sendIP()
	{
		if(isset($_GET['did']))
		{
			$uID = $this->getDeviceUserID($_GET['did']);
			$user = $this->checkUser($uID);
			if(!$user)
			{
				$_SESSION['ERRORMSG'] = 'Device ID not Valid';
				return false;
			}
		}

		$today 	= date('Y-m-d H:i:s',time());
		$rs 	= $this->dbConnect();
		$ping 	= $rs->prepare("INSERT INTO iplog (iIp,iPort,dID,iDate) VALUES (:iIp,:iPort,:dID,:iDate)");
		$result = $ping->execute(array(':iIp'=>$_SERVER['REMOTE_ADDR'],':iPort'=>$_GET['port'],':dID'=>$_GET['did'],':iDate'=>$today));
		if($result)
			echo 1;
		else
			echo 0;
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
