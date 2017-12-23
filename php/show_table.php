<style type="text/css">
    @media print 
    {
	    .noPrint 
	    {
	        display:none;
	    }
    }
    #addbutton{
    	align : center;
    	margin:auto;
    	vertical-align: center;
    	align-items: center;
    	padding-left: 600px;
    }
    </style>

<?php
	include('connect.php');
	$sub_id=$_GET['sub_id'];
	$exam=$_GET['exam'];
	$section=$_GET['section'];
	$session=$_GET['session'];
	$username=$_GET['username'];

	$query1= "SELECT DISTINCT semester FROM subject WHERE sub_id='$sub_id'";
	$run2=mysql_query($query1);
	echo mysql_error();
	while($row2=mysql_fetch_array($run2))
	{
		$sem=$row2['semester'];
	}
	$qw=0;
	$max_marks1=array();
	$query = "SELECT * FROM questions where sub_id='$sub_id' AND section='$section' AND exam='$exam'";
	$run = mysql_query($query);
	echo mysql_error();
	
	echo "<tr>
        <td >S.No.</td>
		<td >Roll No.</td>
		<td >Student Name</td>";
		while($row=mysql_fetch_array($run)) {
			//echo "1";
			$qno = $row['question'];
			$cono = $row['co_no'];
 			$max_marks = $row['max_marks'];
 			$max_marks1[$qw]=$row['max_marks'];
			echo "<td style='color:BLACK;' rowspan=3>Question $qno<br>
				C.O. $cono<br>
				MM  $max_marks</td>
					";
					$count=$count+1;
					$qw++;
		}
		//echo "<td>Calculated total marks</td>
		//	  <td>Actual total marks</td>";
		echo "</tr>";
		echo "</br></br></br></br></br></br>";
		$sno=0;
		$j=1;
$check = "SELECT * FROM nba_student where session='$session' AND section='$section 'AND exam='$exam' AND sub_id='$sub_id' AND entered='1' ";
$run_check = mysql_query($check);
echo mysql_error();
$sum=0;
if(mysql_num_rows($run_check)>0) {
	while($row_run_check=mysql_fetch_array($run_check)) {
		$sum=0;
		$student_query="SELECT * FROM student where st_id='$row_run_check[st_id]' ";
		$student_run = mysql_query($student_query);
		$student_row=mysql_fetch_array($student_run);

		$get_marks = "SELECT * FROM marks where st_id= '$row_run_check[st_id]' AND sub_id = '$sub_id'";
		$run_get_marks = mysql_query($get_marks);
		$row_marks = mysql_fetch_array($run_get_marks);
		$actual_marks = $row_marks['exam3'];
		$sno++;
		$name = $student_row['name'];
		echo "
			<tr></tr>                                                                 
			<tr></tr> 
			<tr id = '$sno'>                                                                                        
				<td >$sno</td>
				<td>$row_run_check[st_id]</td>
				<td>$name</td>";
		for($i=1;$i<=$count;$i=$i+1)
			{
				
					$s="mark".$i;
					$value=$row_run_check[$s];
					$sum = $sum+$value;
					echo "<td>$value</td>";
				
	}
	//echo "<td>$sum</td>";
	//echo "<td>$actual_marks</td>";
	echo "<td><input type='button' name= 'edit' class='noPrint'  value='EDIT' onclick='edit_tr($sno,$row_run_check[st_id],$count)'></td>";
}
}
$students_printed = 1;

$query="SELECT * FROM student where semester='$sem' AND section='$section'";
require('check_oe.php');
			if(check_oe($sub_id)==1){
			$query="SELECT * FROM student WHERE OE1='$username' AND semester='$sem' AND section='$section'";
			}
			elseif (check_oe($sub_id)==2) {
			$query="SELECT * FROM student WHERE OE2='$username' AND semester='$sem' AND section='$section'";
			}
			elseif (check_oe($sub_id)==3) {
			$query="SELECT * FROM student WHERE OE3='$username' AND semester='$sem' AND section='$section'";
			}
$run = mysql_query($query);
echo mysql_error();
$page=1;

//$sno=0;
// /echo	"<form method='POST' action='entry2.php'>";
while($row=mysql_fetch_array($run)) {
if($students_printed == $sno+1 && $page<=5) {
$sno++;
$page++;
$students_printed++;
$st_id = $row['st_id'];
$name = $row['name'];
//$section = $row['section'];
$branch= $row['branch'];
//$semester=$row['semester'];
echo "
<tr></tr>
<tr></tr>
	<tr id = '$sno'>
		<td >$sno</td>
		<td>$st_id</td>
		<td>$name</td>";

//	
// echo"	<input type='hidden' name='sub_id' id='sub_id' value=".$sub_id.">
// 	<input type='hidden' name='exam' 	id='exam' value=".$exam.">
// 	<input type='hidden' name='section' id='section' value=".$section.">
// 	<input type='hidden' name='branch' value=".$branch.">
// 	<input type='hidden' name='semester' id='semester' value=".$sem.">
// 	<input type='hidden' name='session'  value=".$session.">
// ";

	$query5="SELECT * FROM nba_student where st_id='$st_id' AND exam='$exam' AND sub_id='$sub_id' AND entered='1' ";
	$run5 = mysql_query($query5);
	echo mysql_error();
	if(mysql_num_rows($run5)>0)
	{
		while($row5=mysql_fetch_array($run5))
		 {
			$Sum=0;
			
			// for($i=1;$i<=$count;$i=$i+1)
			// {
			// 	if($row5['entered']==1)
			// 	{
			// 		$s="mark".$i;
			// 		$value=$row5[$s];
			// 		//$Sum = $Sum+$value;
			// 		echo "<td>$value</td>";
			// 	}
			// 	else
			// 	{
			// 		echo "<td><input type='number'  name='t".$i."-".$j."' min='-1' max='".$max_marks1[$i]."' style='width:50px;'  /></td>";
			// 	}
			// }
			//if($row5['entered']==1);
			//	echo "<td><input type='button' name= 'edit' value='EDIT' onclick='edit_tr($sno,$st_id,$count)'></td>";
			//echo "<td><input type='text'  name='t-".$j."' value='".$Sum."' style='width:50px;' onkeyup='this.value = minmax(this.value, -1, 10)'/></td>";
		}
	}
	else {
		for($k=1;$k<=$count;$k=$k+1)
		{
				echo	"
				<input type='hidden' name='st_id".$j."' value=".$st_id.">
				<input type='hidden' name='st_name".$j."' value=".$name.">";
				echo "<td><input type='number'  name='t".$k."-".$j."' min = '-1' max='".$max_marks1[$k]."' style='width:50px;' step='0.1'  required/></td>";
		}
		$j++;

	}
		echo "</tr>";
		
}
else
	$students_printed++;
}	echo "<input type='hidden' name='jval' value=".$j.">
		  <input type='hidden' name='countval' value=".$count.">

		   <tr>";
		   for($a=1;$a<=($count+3)/2;$a++){
		   	echo "<td></td>";
		   }?>
		   <td style='text-align:center'><input type='submit' name='ADD' value='ADD' onclick='return confirm(" DO you want to submit ")'></td>
		   <?php
		   echo "</tr>
		   ";
		   echo"	<input type='hidden' name='sub_id' id='sub_id' value=".$sub_id.">
 	<input type='hidden' name='exam' 	id='exam' value=".$exam.">
 	<input type='hidden' name='section' id='section' value=".$section.">
 	<input type='hidden' name='branch' value=".$branch.">
 	<input type='hidden' name='semester' id='semester' value=".$sem.">
 	<input type='hidden' name='session'  id='session'	value=".$session.">
 ";



?>