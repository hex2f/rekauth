<?php 
include('config.php');
include('db.php');

if (!empty($_GET)) {
	$username = $_GET['u'];
	$password = $_GET['p'];
	$confpass = $_GET['pc'];
	$mail = $_GET['m'];
	$confmail = $_GET['mc'];

	$ok = true;
	$regsuccess = true;

	if($password != $confpass) {
		$ok = false;
		$regsuccess = false;
		$reason = $password_notmatch_msg;
	}

	if($mail != $confmail) {
		$ok = false;
		$regsuccess = false;
		$reason = $mail_notmatch_msg;
	}

	if(strlen($password) < $minpasswordlength) {
		$ok = false;
		$regsuccess = false;
		$reason = $password_tooshort_msg;
	}

	if(strlen($username) < $minusernamelength) {
		$ok = false;
		$regsuccess = false;
		$reason = $username_tooshort_msg;
	}

	if(strlen($username) > $maxusernamelength) {
		$ok = false;
		$regsuccess = false;
		$reason = $username_toolong_msg;
	}

	if($ok == 'true') {
		$dbqueryusr = $conn->prepare("SELECT * FROM users WHERE userid = :usrname");
		$dbqueryusr->execute(array('usrname'=>$username));
		
		$result = $dbqueryusr->fetchAll();

    	if($result != null) {
    		$ok = false;
    		$regsuccess = false;
			$reason = $username_taken_msg;
    	}
    	if($ok == 'true') {
    		$options = [
			    'cost' => $password_encrypt_cost,
			];
    		$passwordhashed = password_hash($password, PASSWORD_BCRYPT, $options);
    		$stmt = $conn->prepare("INSERT INTO users (userid,passhash,mail,lastseen,registered) VALUES (:username,:password,:mail,NOW(),NOW())");
    		$stmt->bindParam(':username', $username);
    		$stmt->bindParam(':password', $passwordhashed);
    		$stmt->bindParam(':mail', $mail);
    		$stmt->execute();
    		$regsuccess = true;
    		header('Location: '+$loginpage);
    	}
	}
}
if($regsuccess != true) {
	echo $reason;
}
?>