<?php
   echo "<select name=subjectid id=section required><option value=''>Select</option>";
	include('connect.php');
	
	require_once('../../config.php');
	require_login();
	global $USER;
	$userid = $USER->id;
	$username = $USER->username;
	
	$sid=$_GET['q'];
	$dept=$_GET['dept'];
	//$cal=date("Y");
	$checksub="SELECT distinct(section) FROM assignrole WHERE branch='$dept' AND sub_id='$sid' order by section ASC";
	
	$retval = mysql_query( $checksub, $conn );
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
	{
		echo "<option value=$row[section]>$row[section]</option>";
	}
	
	echo "</select>";
?>
