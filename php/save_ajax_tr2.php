<?php
include("connect.php");
	$id=$_GET['id'];
	//$old_qno = $_GET['old_qno'];
	$marks = array();
	$marks = explode(',',$_GET['question']);
	$count = $_GET['count'];
	//$max_marks = $_GET['max'];
	$sub_id = $_GET['sub_id'];
	//$section = $_GET['section'];
	$exam = $_GET['exam'];
	$st_id = $_GET['st_id'];
	for($i=0;$i<$count;$i++) {
		$x=$i+1;
		$m="mark".$x;
	
	$new = "UPDATE nba_student SET $m='$marks[$i]' WHERE st_id='$st_id' AND exam='$exam' AND sub_id='$sub_id' ";
			$run1 = mysql_query($new);
			echo mysql_error();
	 	}
	 	$sum=0;
	$query_new= "SELECT * FROM student where st_id='$st_id'";
$run_new = mysql_query($query_new);
$row = mysql_fetch_array($run_new);
	echo "		<td>$id</td>
				<td>$st_id</td>
				<td>$row[name]</td>";
				
	$query_new1="SELECT * FROM nba_student where st_id='$st_id' AND exam='$exam' AND sub_id='$sub_id'";
	$run_new1 = mysql_query($query_new1);
	echo mysql_error();

	$get_marks = "SELECT * FROM marks where st_id= '$st_id' AND sub_id = '$sub_id'";
		$run_get_marks = mysql_query($get_marks);
		$row_marks = mysql_fetch_array($run_get_marks);
		$actual_marks = $row_marks['exam3'];
	
	while($row5=mysql_fetch_array($run_new1)) {
		$Sum=0;
		
		for($i=1;$i<=$count;$i=$i+1)
		{
			$s="mark".$i;
				$value=$row5[$s];
				$sum = $sum+$value;
				echo "<td >$value</td>";
		}

		echo "
		<input type='hidden' name='subjectid' id ='sub_id".$id."' value='$sub_id'>
				<input type='hidden' name='exam' id ='exam".$id."' value='$exam'>
				<td >$sum</td>
				<td >$actual_marks</td>
				<td><input type='button' name= 'edit' value='EDIT' onclick='edit_tr($id,$st_id,$count)'></td>";
	}

?>
