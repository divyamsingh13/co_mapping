<?php
	
    $fac_id=$_GET['fac_id'];
    $sub = $_GET['sub'];

	include('connect.php');
    mysql_select_db('portal');
	echo '<option>SELECT</option>';
			$checksub="SELECT distinct(section) FROM assignrole where fac_id = '$fac_id' AND sub_id = '$sub'";
		
	    $retval = mysql_query( $checksub, $conn );
	    while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
	    {
		    echo "<option value=$row[section]>$row[section]</option>";
	    }
	//}
    
	
?>
