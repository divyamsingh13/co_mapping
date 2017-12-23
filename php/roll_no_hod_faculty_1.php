<head>
<script>
		function printpage()
		{
            var cont = document.getElementById('printable').innerHTML;
            var original_cont = document.body.innerHTML;

            document.body.innerHTML = cont;
            window.print();
            document.body.innerHTML = original_cont;
        }
 </script>
 <style type="text/css">
 	table.center {
    margin-left: auto;
    margin-right: auto;
}
 </style>
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
$fac_id = $_POST['faculty'];
//$exam = $_POST['exam'];


$get_name = "SELECT * FROM login WHERE userid='$fac_id' ";
$run_get_name = mysql_query($get_name);
while($row_get_name=mysql_fetch_array($run_get_name)){
	$name_fac = $row_get_name['name'];
}




$sub_id = $_POST['subjectid'];
$exam = $_POST['exam'];
echo "<input type='button' name='print' value='PRINT'  id='print' onclick='printpage();'></input>";
echo "<body>
<div id='printable'>
 	<center><h5><b>AJAY KUMAR GARG ENGINEERING COLLEGE<br>
 					BRANCH:".$fullname."<br>
 					
 					
 					Subject : ".$sub_id."<br>
 					Faculty : ".$name_fac."<br>
 					</b></h5>
 	<table class='table' id='table' style='margin-left:0px; margin-right:auto;' align='center' >
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

$select_student = "SELECT * FROM nba_student WHERE fac_id='$fac_id' AND sub_id='$sub_id' AND exam='$exam' ORDER BY st_id ASC";
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
		$select_questions = "SELECT * FROM questions WHERE sub_id='$sub_id' AND fac_id='$fac_id' AND co_no='$j' ORDER BY question ASC";
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
<b><p style='margin-left:-350px; margin-top:70px;'><?php echo $name_fac;?><br>
	 <?php echo $branch1; ?></p></b>
	</div>
 </body>
 </html>
