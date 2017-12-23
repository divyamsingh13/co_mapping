<head>
<meta charset='utf-8' />
	<title>Update Marks</title>
	<link rel='stylesheet' href='../css/finallook.css' >
<link rel="stylesheet" href="../css/result.css" type="text/css" />
<!-- <link rel="stylesheet" href="../css/coloringpageprint.css" type="text/css" media="print" />  -->
		 <!-- <style>
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

</style> -->



<script>
	function printpage(){
            var cont = document.getElementById('printable').innerHTML;
            var original_cont = document.body.innerHTML;

            document.body.innerHTML = cont;
            window.print();
            document.body.innerHTML = original_cont;
        }

  </script>
  </head>
<?php
include('common.php');
echo "</br></br></br></br></br></br>";
include('connect.php');
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
$sub_id = $_POST['subjectid'];
$section = $_POST['section'];
$exam = $_POST['exam'];
$query_faculty="SELECT * FROM assignrole where sub_id='$sub_id' AND section='$section' AND semester='$semester' ";
$query_run=mysql_query($query_faculty);
while($row_faculty=mysql_fetch_array($query_run)){
	$fac_id=$row_faculty['fac_id'];
}

$get_name = "SELECT * FROM login WHERE userid='$fac_id' AND branch='$branch1'";
$run_get_name = mysql_query($get_name);
while($row_get_name=mysql_fetch_array($run_get_name)){
	$name_fac = $row_get_name['name'];
}
// for excel sheet
echo "<form action='excel_exam.php' method='post'>";
			//echo "<input type='submit' value='SAVE' class='myButton'>";
			echo "<input type='hidden' value='$section' name='section'>";
			echo "<input type='hidden' value='$sub_id' name='sub_id'>";
			//echo "<input type='hidden' value='$semester' name='semester'>";
			/*echo "<input type='hidden' value='$exam' name='exam'>";*/
			//echo "<input type='hidden' value='$order' name='order'>";
			echo "<input type='button' name='print' value='PRINT'  id='print' onclick='printpage();'></input>";
			echo "</form></div></br>";
$question_avg[31];
$co_total[6];
$co_Total_questions[6];
$co_avg[6];
$co_max[6];
$co_per[6];
for($j=0;$j<6;$j++) {
	$co_total[$j] = 0;
	$co_Total_questions[$j]=0;
	$co_avg[$j] = 0.0;
	$co_per[$j]=0.0;
}
$select_exam=array('CT1','CT2','ST2','ST1','PUT');
foreach($select_exam as $value)
{
	

$select_questions = "SELECT * FROM questions WHERE sub_id='$sub_id' AND section='$section' AND exam='$value' ORDER BY question ASC";
$execute = mysql_query($select_questions);
echo mysql_error();

$i=1;
while($row_questions = mysql_fetch_array($execute)) {
	$question = $row_questions['question']."ques";
	$cono = $row_questions['co_no'];
	$que_max=$row_questions['max_marks'];
	 $exam=$row_questions['exam'];
	$total=0;
	$number_students=0;
	$m = "mark".$i;
	
	$select_student = "SELECT * FROM nba_student WHERE sub_id='$sub_id' AND section='$section' AND exam='$value' ";
	$run = mysql_query($select_student);
	echo mysql_error();
		$ab=0;
	while($row_student = mysql_fetch_array($run)) {
		
		
		$marks = $row_student[$m];
		if($marks!="" && $marks!="-1")
		{	$ab++;
			$marks." ";
			$total = $total+$marks;
			$number_students++; 
		}
	}
	$total;
	$number_students;
	if($number_students!=0)
		$avg = round($total/$number_students,2);
	else
		$avg = 0;
	$question_avg[$question] = $avg;
	
	if($cono=='1') {
		$co_max['1']=$co_max['1']+$que_max;
		$co_total['1'] = $co_total['1']+$avg;
		$co_Total_questions['1']++;
	}

	if($cono=='2') {
		$co_max['2']=$co_max['2']+$que_max;
		$co_total['2'] = $co_total['2']+$avg;
		$co_Total_questions['2']++;
	}

	if($cono=='3') {
		$co_max['3']=$co_max['3']+$que_max;
		$co_total['3'] = $co_total['3']+$avg;
		$co_Total_questions['3']++;
	}

	if($cono=='4') {
		$co_max['4']=$co_max['4']+$que_max;
		$co_total['4'] = $co_total['4']+$avg;
		$co_Total_questions['4']++;
	}

	if($cono=='5') {
		$co_max['5']=$co_max['5']+$que_max;
		$co_total['5'] = $co_total['5']+$avg;
		$co_Total_questions['5']++;
	}
	$i++;
	;
}
for($j=1;$j<6;$j++) {
	$ctotal = 0;
	$ctotalQuestions = 0;
	$ctotal = $ctotal+$co_total[$j];echo '<br>';
	$ctotalQuestions =$ctotalQuestions+$co_Total_questions[$j];
	if($ctotalQuestions!=0){
		
		$co_per[$j]="".round($ctotal/$co_max[$j],4)*100;
		$co_avg[$j]= "".round($co_per[$j]*$co_max[$j]/100,2);
	}
	else;
		//$co_avg[$j] = 0;
}
}
?>


<!-- <!doctype html>
 <html lang='en'>
 <head>
	
	
	
	 
 </head>  -->
 <body>
 	<div id="printable">
 	<center><h5><b>AJAY KUMAR GARG ENGINEERING COLLEGE<br>
 					BRANCH: <?php echo $fullname; ?> <br>
 					Semester : <?php echo $semester;?><br>
 					Section : <?php echo $section;?><br>
 					Subject : <?php echo $sub_id;?><br>
 					Faculty : <?php echo $name_fac;?><br>
 					</b></h5>
 	<table class='table' id='table' >
    <tr>
		<td>C.O Number</td>
		<td>Max Marks</td>
		<td>Average Marks</td>
		<td>Percentage</td>
	</tr>
	<?php 
		for($j=1;$j<6;$j++) {
	?>
	<tr>
		<td style='text-align:center'>C.O Numerber <?php echo $j; ?></td>
		<td style='text-align:center'><?php echo $co_max[$j]; ?></td>
		<td style='text-align:center'><?php echo $co_avg[$j]; ?></td>
		<td style='text-align:center'><?php echo $co_per[$j]; ?></td>
	</tr>
<?php	} ?>
	</table>
	
	<b><p style='margin-left:-350px; margin-top:70px;'><?php echo $name_fac;?><br>
	 <?php echo $branch1; ?></p></b>
	</div>
 </body>

