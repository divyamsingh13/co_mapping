<?php
require_once('../../config.php');
require_login();
include('connect.php');

global $USER;
$userid = $USER->id;
$username = $USER->username;
$lastaccess = $USER->lastaccess;
$lastaccess_to_date = date('jS F Y h:i:s A (T)', $lastaccess);
$department = $USER->department;
$sesskey = $USER->sesskey;

$length=strlen($username);
$cmd1="SELECT * FROM login WHERE userid='$username'";
	$rst1=mysql_query($cmd1);
	$row=mysql_fetch_array($rst1);
	{	$b=$row[2];
		$a=$row[4];
	}
	if(!$rst1)
	{
	 die('Could not enter data: ' . mysql_error());
	}
	
	if($b!='ADMIN' && $b!='FACULTY' && $b!='HOD' && $b!='PROCTOR'&& $b!='COORDINATOR')
	{
	header("Location:error.php");
	}
?>

<html>
<head>
	<link rel="stylesheet" type="text/css" href="../css/basic_layout2.css">
</head>

</html>
