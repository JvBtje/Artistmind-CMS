<?php
session_start();

/*if(!empty($_SESSION)){
	header("Location: home.php");
}*/
include "../../DB.php";

$link = mysqli_connect($DbServer, $DbUsername, $DbPassword,$Db);

# We require the library
require("facebook.php");

# Creating the facebook object
$facebook = new Facebook(array(
	'appId'  => '235990959887776',
	'secret' => '2ff4bb11ede994416869ebc802da510c',
	'cookie' => true,
	'next' => 'http://www.artistmin.nl/Login.php',  
    'cancel_url' => 'http://www.artistmin.nl/Login.php'
));

# Let's see if we have an active session
$uid = $facebook->getUser();

if($uid !=0) {
	echo 'logged in';
	# Active session, let's try getting the user id (getUser()) and user info (api->('/me'))
	try{
		$uid = $facebook->getUser();
		$user = $facebook->api('/me');
	} catch (Exception $e){}
	
	if(!empty($user)){
		/*# We have an active session, let's check if we have already registered the user
		$query = mysqli_query($link,"SELECT * FROM users WHERE oauth_provider = 'facebook' AND oauth_uid = ". $user['id']);
		$result = mysqli_fetch_array($query);
		
		# If not, let's add it to the database
		if(empty($result)){
			$query = mysqli_query($link,"INSERT INTO users (oauth_provider, oauth_uid, username) VALUES ('facebook', {$user['id']}, '{$user['name']}')");
			$query = msyql_query("SELECT * FROM users WHERE id = " . mysqli_insert_id($link));
			$result = mysqli_fetch_array($query);
		}
		// this sets variables in the session 
		$_SESSION['id'] = $result['id'];
		$_SESSION['oauth_uid'] = $result['oauth_uid'];
		$_SESSION['oauth_provider'] = $result['oauth_provider'];
		$_SESSION['username'] = $result['username'];*/
	} else {
		# For testing purposes, if there was an error, let's kill the script
		die("There was an error.");
	}
} else {
	# There's no active session, let's generate one
	
	$login_url = $facebook->getLoginUrl();
	header("Location: ".$login_url);
}