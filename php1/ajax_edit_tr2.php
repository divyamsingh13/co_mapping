<?php
	include("connect.php");
	$id = $_GET['id'];
	$st_id = $_GET['st_id'];
	$exam = $_GET['exam'];
	//$max_marks = $_GET['max'];
	$sub_id = $_GET['sub_id'];
	$count = $_GET['count'];
	//$section = $_GET['section'];
	//$exam = $_GET['exam'];
$query_new= "SELECT * FROM student where st_id='$st_id'";
$run_new = mysql_query($query_new);
$row = mysql_fetch_array($run_new);
	echo "<form method='POST' action=''>
			<tr>
				<td>$id</td>
				<td>$st_id</td>
				<td>$row[name]</td>";
				
	$query_new1="SELECT * FROM nba_student where st_id='$st_id' AND exam='$exam' AND sub_id='$sub_id'";
	$run_new1 = mysql_query($query_new1);
	echo mysql_error();
	
	while($row5=mysql_fetch_array($run_new1)) {
		$Sum=0;
		
		for($i=1;$i<=$count;$i=$i+1)
		{
			$s="mark".$i;
				$value=$row5[$s];
				//$Sum = $Sum+$value;
				echo "<td colspan='1'><input type='text' style='width:50px;' value='$value' id='new".$id."-".$i."'></td>";
		}
	}
		echo"	<td> 
				<input type='hidden' name='subjectid' id ='sub_id".$id."' value='$sub_id'>
				<input type='hidden' name='exam' id ='exam".$id."' value='$exam'>
				<input type='button' name='SAVE' value='SAVE' onclick='savegen($id,$count,$st_id)' >
			</td>
			</tr>
		</form>";
?>
