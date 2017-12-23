<?php
	include("connect.php");
	$id = $_GET['id'];
	$qno = $_GET['question'];
	$cono = $_GET['cono'];
	$max_marks = $_GET['max'];
	$sub_id = $_GET['sub_id'];
	$section = $_GET['section'];
	$exam = $_GET['exam'];

	echo "<form method='POST' action=''>
			<tr>
				<td>
				<select name='questions' id='question$id'>";
	echo "<option value='$qno'>Question $qno</option>";		 
	for($i=1;$i<=30;$i++) {
		$quer = "SELECT * FROM questions WHERE sub_id='$sub_id' AND section='$section' AND exam='$exam' AND question='$i'";
	   	$run2 = mysql_query($quer);
	   	echo mysql_error();
		if(mysql_num_rows($run2)==0) {
   
  			echo "<option value='$i'>Question $i</option>";
	  	}
	}
	echo "</select>
			</td>
		
			<td >
				<select name='co' id='CO$id'>
					<option value='$cono'>C.O. $cono</option>";
					for($j=1;$j<=5;$j++){
						if($j!=$cono)
						echo "<option value='$j'>C.O. $j</option>";
					}
				echo "</select>
			</td>
			<td>
				<input type='text' name='Max' id='max_marks$id' value='$max_marks'><br>
			</td>
			<td> 
				<input type='hidden' name='subjectid' value='$sub_id'>
				<input type='hidden' name='section' value='$section'>
				<input type='hidden' name='exam' value='$exam'>
				<input type='submit' name='SAVE' value='SAVE' class='mybutton' onclick='savegen($id,$qno)' >
			</td>
			</tr>
		</form>";