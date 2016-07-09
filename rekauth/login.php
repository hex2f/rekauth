<?php 
include('config.php');
include('db.php');
include('randlib/random.php');

if(isset($_COOKIE['token'])) {
	header('Location: '.$isloggedinpage);
}
if (!empty($_GET)) {
	function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_-') {
	    $str = '';
	    $max = mb_strlen($keyspace, '8bit') - 1;
	    for ($i = 0; $i < $length; ++$i) {
	        $str .= $keyspace[random_int(0, $max)];
	    }
	    return $str;
	}

	$username = $_GET['u'];
	$password = $_GET['p'];

	$ok = true;

	if(strlen($password) <= $minpasswordlength) {
		$ok = false;
		$regsuccess = false;
		$reason = $auth_failed_msg;
	}

	if(strlen($username) <= $minusernamelength) {
		$ok = false;
		$regsuccess = false;
		$reason = $auth_failed_msg;
	}

	if(strlen($username) >= $maxusernamelength) {
		$ok = false;
		$regsuccess = false;
		$reason = $auth_failed_msg;
	}

	if($ok == 'true') {
		$dbqueryusr = $conn->prepare("SELECT * FROM users WHERE userid = :usrname");
		$dbqueryusr->execute(array('usrname'=>$username));
		
		$result = $dbqueryusr->fetchAll();
    	if(password_verify($password,$result[0]['passhash'])) {
    		$token = random_str(256);
    		setcookie('token', $token, time() + (86400 * $token_expire_days), "/");

    		$dbqueryusr = $conn->prepare("SELECT * FROM tokens WHERE user = :usrname");
			$dbqueryusr->execute(array('usrname'=>$username));

			$result = $dbqueryusr->fetchAll();

			if($result[0]['user'] != null) {
				$dbqueryusr = $conn->prepare("DELETE FROM tokens WHERE user = :usrname");
				$dbqueryusr->execute(array('usrname'=>$username));

				$dbqueryusr = $conn->prepare("INSERT INTO tokens (user,expire,token) VALUES (:usrname,NOW() + INTERVAL :days DAY, :token)");
				$dbqueryusr->execute(array('usrname'=>$username,'token'=>$token,'days'=>$token_expire_days));
				
				header('Location: '.$isloggedinpage);
			} else {
				$dbqueryusr = $conn->prepare("INSERT INTO tokens (user,expire,token) VALUES (:usrname,NOW() + INTERVAL :days DAY, :token)");
				$dbqueryusr->execute(array('usrname'=>$username,'token'=>$token,'days'=>$token_expire_days));
				
				header('Location: '.$isloggedinpage);
			}
		}
	}
}
?>