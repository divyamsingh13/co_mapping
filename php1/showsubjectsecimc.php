<?php
   echo "<select name=subjectid id=section required><option value=''>Select</option>";
	include('connect.php');
	
	require_once('../../config.php');
	require_login();
	
	
	$fac_id=$_GET['q'];
	$sid=$_GET['id'];
	//$cal=date("Y");
	
	$checksub="SELECT * FROM assignrole WHERE fac_id='$fac_id' AND sub_id='$sid'";
	
	$retval = mysql_query( $checksub, $conn );
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
	{
		echo "<option value=$row[section]>$row[section]</option>";
	}
	
	echo "</select>";
?>