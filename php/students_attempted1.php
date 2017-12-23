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
	<style type="text/css">
	@media print{
	h3{
		display:none;
	}
	a
	{
		color:black;
		text-decoratin:none;
	}
	
	#new{
		margin-top:-12%;
	
	}
	.CSSTableGenerator{
		margin-top:-10%;
		margin:0px;padding:0px;
		width:90%;
	}
.CSSTableGenerator table{
	margin-top:-10%;
	width:90%;
	height:100%;
	margin:0px;padding:0px;
	border:1;
	}
.CSSTableGenerator td{
	vertical-align:middle;
	text-align:center;
	padding:1px;
	font-size:10px;
	font-family:Arial;
	font-weight:normal;
	color:#000000;
}
table{
	color:#000000;
}
#footer{
	display:none;
}
#cssmenu{
	display:none;
}
#moodle{
	display:none;
}
#header{
	display:none;
}
#logo{
	display:none;
}
#footer_text{
	display:none;
}
#status_text{
	display: none;
}
#logout{
	display: none;
}
#title{
	display: none;
}
#top_margin{
	display: none;
}
#print{
	display: none;
}
#header1{
	display:none;
}
#header_text1{
	display:none;
}
#header_right{
	display:none;
}
#invisible{
	font-weight:bold;
	font-family:arial;
	display:inline;
}
#top{
	font-size:18px;
}
	
}

</style>



<script>
	function printpage()
  	{
  		window.print()
  	}

  </script>
	 
 </head> 
 <body>
 <?php
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
$semester=$_POST['semester'];
$section = $_POST['section'];

$sub_id = $_POST['subjectid'];
$exam = $_POST['exam'];
$query_faculty="SELECT * FROM assignrole where sub_id='$sub_id' AND section='$section' AND semester='$semester' ";
$query_run=mysql_query($query_faculty);
while($row_faculty=mysql_fetch_array($query_run)){
	echo $fac_id=$row_faculty['fac_id'];
}

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
 					Semester : <?php echo $semester;?><br>
 					Section : <?php echo $section;?><br>
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



$students_attempted=array(array());
for($i=0;$i<32;$i++)
{
	for($j=0;$j<6;$j++)
	{
		$students_attempted[$i][$j]=0;
	}
}
echo "<input type='button' name='print' value='PRINT'  id='print' onclick='printpage();'></input>";

$select_questions = "SELECT * FROM questions WHERE sub_id='$sub_id' AND section='$section' AND exam='$exam' ORDER BY question ASC";
$execute = mysql_query($select_questions);
echo mysql_error();

$i=1;
while($row_questions = mysql_fetch_array($execute)) {
	$question = $row_questions['question'];
	$que_max[$i]= $row_questions['max_marks'];
	$select_student = "SELECT * FROM nba_student WHERE sub_id='$sub_id' AND section='$section' AND exam='$exam'";
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
		
				<td style='text-align:center'><?php if($students_attempted[$i][1]!=0)
								
									echo C.O. 1;

						  else if($students_attempted[$i][2]!=0)
								echo C.O. 2;
							else if($students_attempted[$i][3]!=0)
								echo C.O. 3;
							else if($students_attempted[$i][4]!=0)
								echo C.O. 4;
							else if($students_attempted[$i][5]!=0)
								echo C.O. 5;?></td> 

							<td style='text-align:center'><?php if($students_attempted[$i][1]!=0) {
								
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

