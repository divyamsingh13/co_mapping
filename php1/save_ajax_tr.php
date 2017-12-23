<?php
include("connect.php");
	$id=$_GET['id'];
	$old_qno = $_GET['old_qno'];
	$qno = $_GET['question'];
	$cono = $_GET['cono'];
	$max_marks = $_GET['max'];
	$sub_id = $_GET['sub_id'];
	$section = $_GET['section'];
	$exam = $_GET['exam'];

	$new = "UPDATE questions SET question='$qno',co_no='$cono',max_marks='$max_marks' WHERE sub_id='$sub_id' AND section='$section' AND exam='$exam' AND question='$old_qno'";
			$run1 = mysql_query($new);
			echo mysql_error();
	echo "<tr id='$id'>";
			echo "<td style='color:BLACK;'>Question $qno</td>
				  <td style='color:BLACK;'>C.O. $cono</td>
				  <td style='color:BLACK;'>$max_marks</td>";
			echo "<td><button  name='edit'  class='mybutton' onclick='edit_tr($id,$qno,$cono,$max_marks);'>EDIT</button></td>";

?>
