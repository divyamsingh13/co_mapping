<?php
	
    $fac_id=$_GET['fac_id'];
    $dept = $_GET['dept'];

	include('connect.php');
    mysql_select_db('portal');
	echo '<option>SELECT</option>';
			$checksub="SELECT distinct(sub_id) FROM assignrole where fac_id='$fac_id'";
		
	    $retval = mysql_query( $checksub, $conn );
	    while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
	    {
	    	$getcategory  = "SELECT * FROM subject WHERE sub_id='$row[sub_id]'";
	    	$runcategory = mysql_query($getcategory);
	    	$rowcat = mysql_fetch_array($runcategory);
	    	if($rowcat['category']=='T' || $rowcat['category']=='O')
		    echo "<option value=$row[sub_id]>$row[sub_id]</option>";
	    }
	//}
    
	
?>
