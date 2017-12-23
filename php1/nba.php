
<?php
include 'common.php';
echo "</br></br></br></br></br></br>";

//include('nba_common.php');
include('connect.php');

$_SESSION['sub_id'] = $_POST['subjectid'];
$_SESSION['section'] = $_POST['section'];
$_SESSION['exam'] = $_POST['exam'];
$_SESSION['session'] = $_POST['session'];

$sub_id = $_SESSION['sub_id'];
$section = $_SESSION['section'];
$exam = $_SESSION['exam'];
$session = $_SESSION['session'];

$select2 = "SELECT * FROM questions where sub_id='$sub_id' AND section='$section' AND exam='$exam'";
$runselect = mysql_query($select2);
echo mysql_error();
$rowselect = mysql_fetch_array($runselect);
echo $va = $rowselect['confirm'];
if($va==1)
{
	header('Location:nba_student.php');
}
else {
?>
<!doctype html>
 <html lang="en">
 <head>
	<meta charset="utf-8" />
	<title>Update Marks</title>
	<link rel="stylesheet" href="../css/finallook.css" >
	
	 
 </head> 

<script type="text/javascript">

function savegen(id,old_qno)
	{
		
		var xmlhttp;

		var question= document.getElementById("question"+id).value;
		var cono= document.getElementById("CO"+id).value;
		var max= document.getElementById("max_marks"+id).value;
		var sub_id= document.getElementById("subjectid").value;
		var section= document.getElementById("section").value;
		var exam= document.getElementById("exam").value;

		if(window.XMLHttpRequest)
		{
			//code for IE7,firefox,chrome,opera,safari	
			
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.open('GET', 'save_ajax_tr.php?question='+question+'&cono='+cono+'&max='+max+'&sub_id='+sub_id+'&section='+section+'&exam='+exam+'&old_qno='+old_qno+'&id='+id,true);
		xmlhttp.send();
			
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4&&xmlhttp.status==200)
			{
			
				//document.getElementById("objx").innerHTML=xmlhttp.responseText;
				
				document.getElementById(id).innerHTML=xmlhttp.responseText;
			}
		}
	}

function edit_tr(id,question,cono,max,section,exam)
	{
		
		var xmlhttp;

		var sub_id= document.getElementById("subjectid").value;
		var section= document.getElementById("section").value;
		var exam= document.getElementById("exam").value;

		if(window.XMLHttpRequest)
		{
			//code for IE7,firefox,chrome,opera,safari	
			
			xmlhttp=new XMLHttpRequest();
		}
		else
		{
			
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.open('GET', 'ajax_edit_tr.php?question='+question+'&cono='+cono+'&max='+max+'&sub_id='+sub_id+'&section='+section+'&exam='+exam+'&id='+id,true);
		xmlhttp.send();
			
		xmlhttp.onreadystatechange=function()
		{
			if(xmlhttp.readyState==4&&xmlhttp.status==200)
			{
			
				//document.getElementById("objx").innerHTML=xmlhttp.responseText;
				
				document.getElementById(id).innerHTML=xmlhttp.responseText;
			}
		}
	}

</script>
<table class="table" id="table" >
    <tr>
		<td>Questions</td>
		<td>C.O Number</td>
		<td>Maximum Marks</td>
	</tr>
	<?php
		if(isset($_POST['ADD'])) {
			$question = $_POST['Questions'];
			$cno = $_POST['CO'];
			$max = $_POST['max'];

			$details = "SELECT * FROM subject WHERE sub_id='$sub_id'";
			$rundetails = mysql_query($details);
			$rowfind = mysql_fetch_array($rundetails);
			$semester = $rowfind['semester'];
			$branch = $rowfind['branch'];

			$enter = "INSERT INTO questions VALUES('$sub_id','$section','$exam','$question','$cno','$max','0','$session','$semester','$branch','$username')";
			$run1 = mysql_query($enter);
			echo mysql_error();
		}
	 ?>

	<?php 
		$query = "SELECT * FROM questions WHERE sub_id='$sub_id' AND section='$section' AND exam='$exam' ORDER BY question ASC";
		$run = mysql_query($query);
		echo mysql_error();
		$k=1;
		while($row=mysql_fetch_array($run)) {
			$qno = $row['question'];
			$cono = $row['co_no'];
			$max_marks = $row['max_marks'];
			echo "<tr id='$k'>";
			echo "<td style='color:BLACK;'>Question $qno</td>
				  <td style='color:BLACK;'>C.O. $cono</td>
				  <td style='color:BLACK;'>$max_marks</td>";
			echo "<td><button  name='edit'  class='mybutton' onclick='edit_tr($k,$qno,$cono,$max_marks);'>EDIT</button></td>";
			$k++;
		}
	?>
<form action="nba_show.php" method="POST" id="submitform"></form>
	<tr>
	<form action="" method="POST" id="addform"></form>
		
			<td>
				<select name='Questions' form="addform"> <!-- for selecting questions -->
				 <?php
				   for($i=1;$i<=30;$i++) {
				   		$quer = "SELECT * FROM questions WHERE sub_id='$sub_id' AND section='$section' AND exam='$exam' AND question='$i'";
				   		$run2 = mysql_query($quer);
				   		echo mysql_error();
				   		if(mysql_num_rows($run2)==0) {
				  ?> 
				  <option value="<?php echo $i;?>">Question <?php echo $i;?></option>
		 		 <?php }} ?>
				</select>
			</td>
			
			<td >
				<select name='CO' form="addform"> <!-- for selectiong course outcom26 -->
					<option value='1'>C.O. 1</option>
					<option value='2'>C.O. 2</option>
					<option value='3'>C.O. 3</option>
					<option value='4'>C.O. 4</option>
					<option value='5'>C.O. 5</option>
				</select>
			</td>
			<td>
				<input type="text" name="max" form="addform"><br>
			</td>
			<td> 
				<input type="hidden" name="subjectid" id="subjectid" value="<?php echo $sub_id; ?>"  form="addform">
				<input type="hidden" name="section"   id="section"   value="<?php echo $section; ?>" form="addform">
				<input type="hidden" name="exam"      id="exam" 	 value="<?php echo $exam; ?>" 	 form="addform">
				<input type="hidden" name="session"   id="session" 	 value="<?php echo $session; ?>" form="addform">
				<button name="ADD" value="ADD" class="mybutton" form="addform"> ADD </button>
			</td>
		</tr>
	
		<tr>
	
	
		<td>&nbsp</td><br>
		<td >
			<input type="hidden" name="subjectid" value="<?php echo $sub_id; ?>" form="submitform">
			<input type="hidden" name="section" value="<?php echo $section; ?>" form="submitform">
			<input type="hidden" name="exam" value="<?php echo $exam; ?>" form="submitform">
			<input type="hidden" name="session" value="<?php echo $session; ?>" form="submitform">
			<input type="submit" name="submit" value="submit" class="mybutton" form="submitform">
		</td>
	</tr>

	
	

</table>
</body>
</html>
<?php } ?>
