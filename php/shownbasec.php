<?php
	
    $sem=$_GET['sem'];
    $dept = $_GET['dept'];

	include('connect.php');
    mysql_select_db('portal');
	echo '<option>SELECT</option>';
			$checksub="SELECT distinct(section) FROM student where branch = '$dept' AND semester = '$sem'";
		
	    $retval = mysql_query( $checksub, $conn );
	    while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
	    {
		    echo "<option value=$row[section]>$row[section]</option>";
	    }
	//}
    
	
?>
