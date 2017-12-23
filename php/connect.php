<?php

		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = 'HPv185e@#%';
		$conn = mysql_connect($dbhost, $dbuser, $dbpass);
		if(! $conn )
		{
		  die('Could not connect: ' . mysql_error());
		}
		mysql_select_db('portal');
		
?>
