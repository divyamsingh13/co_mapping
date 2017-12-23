
<!doctype html>
 <html lang='en'>
 <head>
	<meta charset='utf-8' />
	<title>Update Marks</title>
	<link rel='stylesheet' href='../css/finallook.css' >
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
 <style>
 	@media print{
 		#table {
 			margin-left: -.5%;
 		}
 	}
 </style> 
 <?php
include('common.php');
echo "</br></br></br></br></br></br>";
include('connect.php');
$sub_id = $_POST['subjectid'];
$section = $_POST['section'];
$exam = $_POST['exam'];
echo "<input type='button' name='print' value='PRINT'  id='print' onclick='printpage();'></input>";
echo "<body>
<div id='printable'> 
 	<table class='table' id='table' style='margin-left:.4%;'>
    <tr>
    	<td rowspan=2>Roll No</td>
    	<td rowspan=2>name</td>
		<td colspan=2>C.O Number 1</td>
		<td colspan=2>C.O Number 2</td>
		<td colspan=2>C.O Number 3</td>
		<td colspan=2>C.O Number 4</td>
		<td colspan=2>C.O Number 5</td>		
	</tr>
	<tr>
		<td>Avg</td>
		<td>Max</td>
		<td>Avg</td>
		<td>Max</td>
		<td>Avg</td>
		<td>Max</td>
		<td>Avg</td>
		<td>Max</td>
		<td>Avg</td>
		<td>Max</td>
	</tr> ";

// for excel sheet
echo "<form action='excel_exam.php' method='post'>";
			//echo "<input type='submit' value='SAVE' class='myButton'>";
			echo "<input type='hidden' value='$section' name='section'>";
			echo "<input type='hidden' value='$sub_id' name='sub_id'>";
			//echo "<input type='hidden' value='$semester' name='semester'>";
			echo "<input type='hidden' value='$exam' name='exam'>";
			//echo "<input type='hidden' value='$order' name='order'>";
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
$stu_avg=array(array());
$select_student = "SELECT * FROM nba_student WHERE sub_id='$sub_id' AND section='$section' AND exam='$exam'ORDER BY st_id ASC";
//$select_questions = "SELECT * FROM questions WHERE sub_id='$sub_id' AND section='$section' ORDER BY question ASC";
$execute = mysql_query($select_student);
echo mysql_error();

$i=1;
while($row_student = mysql_fetch_array($execute))
{?>	
	<tr>
		<td style='text-align:center'><?php echo $row_student['st_id']; ?></td>
		<td style='text-align:center'><?php echo $row_student['name']; ?></td>
	<?php
	for($i=1;$i<=5;$i++) {
		$student[$i]=0;
		$que_attempt[$i]=0;
		$co_max[$i]=0;
	}
	for($j=1;$j<=5;$j++)
	{
		$select_questions = "SELECT * FROM questions WHERE sub_id='$sub_id' AND section='$section' AND co_no='$j' ORDER BY question ASC";
		$run = mysql_query($select_questions);
		echo mysql_error();
		while($row_question=mysql_fetch_array(($run)))

		{
			$que_max=$row_question['max_marks'];
			$m="mark".$row_question['question'];
			$marks = $row_student[$m];
			if($marks!="" && $marks!="-1")
			{	
				$student[$j]=$student[$j]+$row_student[$m];
				$que_attempt[$j]=$que_attempt[$j]+1;
			}
			$co_max[$j]=$co_max[$j]+$que_max;
			
		}
		$avg[$j]=round($student[$j]/$que_attempt[$j],2);?>
		
		<td style='text-align:center'><?php echo $avg[$j]; ?></td>
		<td style='text-align:center'><?php echo $co_max[$j]; ?></td>		
		

	<?php	} ?>
	</tr>
	
<?php	} ?>






	
	</table>
	</div>
 </body>
 </html>

