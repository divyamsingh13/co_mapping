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
<?php
include('common.php');
echo "</br></br></br></br></br></br>";
include('connect.php');

$sem = $_POST['semester'];
$sub_id = $_POST['subjectid'];
$exam = $_POST['exam'];

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

$select_questions = "SELECT * FROM questions WHERE semester='$sem' AND sub_id='$sub_id' AND exam='$exam' GROUP BY question ORDER BY question ASC";
$execute = mysql_query($select_questions);
echo mysql_error();

$i=1;
while($row_questions = mysql_fetch_array($execute)) {
	$question = $row_questions['question'];
	$cono = $row_questions['co_no'];
	$que_max=$row_questions['max_marks'];
	$total=0;
	$number_students=0;
	$m = "mark".$i;

	$select_student = "SELECT * FROM nba_student WHERE semester='$sem' AND sub_id='$sub_id' AND exam='$exam'";
	$run = mysql_query($select_student);
	echo mysql_error();

	while($row_student = mysql_fetch_array($run)) {
		$marks = $row_student[$m];
		if($marks!="" && $marks!="-1")
		{	
			$marks;
			$total = $total+$marks;
			$number_students++; 
		}
	}
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
}
for($j=1;$j<6;$j++) {
	$ctotal = 0;
	$ctotalQuestions = 0;
	$ctotal = $ctotal+$co_total[$j];
	$ctotalQuestions =$ctotalQuestions+$co_Total_questions[$j];
	if($ctotalQuestions!=0){
		$co_avg[$j]= "".round($ctotal/$ctotalQuestions,2);
		$co_per[$j]="".round($ctotal/$co_max[$j],2)*100;
	}
	else;
		//$co_avg[$j] = 0;
}
echo "<input type='button' name='print' value='PRINT'  id='print' onclick='printpage();'></input>";
?>




 <body>
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
 </body>

