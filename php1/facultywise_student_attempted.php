<?php
include('common.php');
echo "</br></br></br></br></br></br>";
include('connect.php');
?>
<!doctype html>
 <html lang='en'>
 <head>
	<meta charset='utf-8' />
	<title>Update Marks</title>
	<link rel='stylesheet' href='../css/finallook.css' >
	
	 
 </head> 
 <body>
 	<table class='table' id='table' >
 	<tr><td>Question</td>
	
	
		<td style='text-align:center'>C.O Number</td>
		<td style='text-align:center'>Students Attempted</td>
		<td style='text-align:center'>Max Marks</td>
		
	

</tr>

	
<?php

echo $sub_id = $_POST['subjectid'];
echo $fac_id = $_POST['faculty'];
$exam = $_POST['exam'];
$que_max=array();
$students_attempted=array(array());
for($i=0;$i<32;$i++)
{
	for($j=0;$j<6;$j++)
	{
		$students_attempted[$i][$j]=0;
	}
}

$select_questions = "SELECT distinct(question),co_no,max_marks FROM questions WHERE fac_id='$fac_id' AND sub_id='$sub_id' AND exam='$exam' ORDER BY question ASC";
$execute = mysql_query($select_questions);
echo mysql_error();

$i=1;
while($row_questions = mysql_fetch_array($execute)) {
	$question = $row_questions['question'];
	$que_max[$i]= $row_questions['max_marks'];
	$select_student = "SELECT * FROM nba_student WHERE fac_id='$fac_id' AND sub_id='$sub_id' AND exam='$exam'";
	$run = mysql_query($select_student);
	while($row_student = mysql_fetch_array($run)) {
		if($row_student["mark".$i]!="" && $row_student["mark".$i]!="-1")
			$students_attempted[$question][$row_questions['co_no']]++;
	}
	$i++;
}
$j=1;


 for($i=1;$i<32;$i++)
	{$flag = 0;
		?>
		<tr><td style='text-align:center'><?php echo "Q".$i;?></td>
		
				<td style='text-align:center'><?php
							 if($students_attempted[$i][1]!=0)
								
									echo 'C.O. 1';

						  	else if($students_attempted[$i][2]!=0)
								echo 'C.O. 2';
							else if($students_attempted[$i][3]!=0)
								echo 'C.O. 3';
							else if($students_attempted[$i][4]!=0)
								echo 'C.O. 4';
							else if($students_attempted[$i][5]!=0)
								echo 'C.O. 5';?>
									
								</td> 

							<td style='text-align:center'><?php
							 if($students_attempted[$i][1]!=0) {
								
									echo $students_attempted[$i][1];
									$flag = 1;
							}
								
									
						  else if($students_attempted[$i][2]!=0){
								echo $students_attempted[$i][2];
								$flag = 1;
						  }
							else if($students_attempted[$i][3]!=0) {
								echo $students_attempted[$i][3];
								$flag = 1;
							}
							else if($students_attempted[$i][4]!=0) {
								echo $students_attempted[$i][4];
								$flag = 1;
							}
							else if($students_attempted[$i][5]!=0) {
								echo $students_attempted[$i][5];
								$flag = 1;
								}?></td> 
							
				<!-- <td><?php echo $students_attempted[$i][$j];?></td> --> 
				<?php if($flag==1) {
					?>
					<td style='text-align:center'><?php echo $que_max[$j];
					$j++;?></td> 
					<?php }
					?>
				

		</tr>
		<?php
	}
		?> 
</table>
</body>

