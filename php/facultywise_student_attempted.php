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
	
<script>
	function printpage()
  	{
  		window.print()
  	}

  </script>
	  
 </head> 
 <body><?php
 echo "<input type='button' name='print' value='PRINT'  id='print' onclick='printpage();'></input>";

 $getid="SELECT * FROM login WHERE userid='$username'";

$retval = mysql_query( $getid, $conn );
while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){
 	$category=$row['category'];
 	$branch1=$row['branch'];
 	$name = $row['name'];
}

if($branch1=='CSE'){
			$fullname='COMPUTER SCIENCE AND ENGINEERING';	
			}
			else if($branch1=='IT'){
			$fullname='INFORMATION TECHNOLOGY';
			}
			else if($branch1=='ME'){
			$fullname='MECHANICAL ENGINEERING';
			}
			else if($branch1=='ECE'){
			$fullname='ELECTRONICS & COMMUNICATION ENGINEERING';
			}
			else if($branch1=='EI'){
			$fullname='ELECTRONICS & INSTRUMENTATION ENGINEERING';
			}
			else if($branch1=='EN'){
			$fullname='ELECTRICAL & ELECTRONICS ENGINEERING';
			}
			else if($branch1=='CE'){
			$fullname='CIVIL ENGINEERING';
			}
			else if($branch1=='AS-HU'){
			$fullname='APPLIED SCIENCE AND HUMANITIES';
			}
			else if($branch1=='MCA'){
			$fullname='MASTER OF COMPUTER APPLICATION';
			}
//$semester=$_POST['semester'];
//$section = $_POST['section'];
$fac_id = $_POST['faculty'];
$sub_id = $_POST['subjectid'];
$exam = $_POST['exam'];

$get_name = "SELECT * FROM login WHERE userid='$fac_id' ";
$run_get_name = mysql_query($get_name);
while($row_get_name=mysql_fetch_array($run_get_name)){
	$name_fac = $row_get_name['name'];
}

$sub_id = $_POST['subjectid'];
$section = $_POST['section'];
$exam = $_POST['exam'];
?>
	<center><h5><b>AJAY KUMAR GARG ENGINEERING COLLEGE<br>
 					BRANCH: <?php echo $fullname; ?> <br>
 					

 					
 					Subject : <?php echo $sub_id;?><br>
 					Faculty : <?php echo $name_fac;?><br>
 					</b></h5>
 	<table class='table' id='table' >
 	<tr><td>Question</td>
	
	
		<td style='text-align:center'>C.O Number</td>
		<td style='text-align:center'>Students Attempted</td>
		<td style='text-align:center'>Max Marks</td>
		
	

</tr>

	
<?php



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
<b><p style='margin-left:-350px; margin-top:70px;'><?php echo $name_fac;?><br>
	 <?php echo $branch1; ?></p></b>
</body>

