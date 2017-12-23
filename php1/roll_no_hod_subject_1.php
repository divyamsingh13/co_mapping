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
<?php
include('common.php');
echo "</br></br></br></br></br></br>";
include('connect.php');


$sem = $_POST['semester'];
$sub_id = $_POST['subjectid'];
$exam = $_POST['exam'];
echo "<input type='button' name='print' value='PRINT'  id='print' onclick='printpage();'></input>";
echo "<body>
<div id='printable'>
 	<table class='table' id='table' align='center' style='margin-left:.1%;'>
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

$select_student = "SELECT * FROM nba_student WHERE semester='$sem' AND sub_id='$sub_id' ORDER BY st_id ASC";
//$select_questions = "SELECT * FROM questions WHERE sub_id='$sub_id' AND section='$section' ORDER BY question ASC";
$execute = mysql_query($select_student);
echo mysql_error();

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
		$select_questions = "SELECT * FROM questions WHERE sub_id='$sub_id' AND semester='$sem' AND co_no='$j' ORDER BY question ASC";
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
