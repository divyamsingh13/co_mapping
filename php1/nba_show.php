
<?php
include 'common.php';
echo "</br></br></br></br></br></br>";

	
include('connect.php');
$sub_id = $_POST['subjectid'];
$section = $_POST['section'];
$exam = $_POST['exam'];
$session = $_POST['session'];
?>
<!doctype html>
 <html lang="en">
 <head>
	<meta charset="utf-8" />
	<title>Update Marks</title>
	<link rel="stylesheet" href="../css/finallook.css" >
	
	<style>
		.abc {
			    background-color: red;
			    width: 300px;
			    /*border: 25px red;*/
			    /*padding: 25px;
			    margin: 25px;*/
		}
	</style> 
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
<div class='abc'> <b>Once Confirmed The Scheme Cannot Be Changed</b></div>
<table class="table" id="table">
<form method="POST" action="nba_student.php" id="confirmform"></form>
	<tr>
		<td colsapn="1">Questions</td>
		<td>C.O Number</td>
		<td>Maximum Marks</td>
	</tr>
	<?php
		if(isset($_POST['ADD'])) {
			$question = $_POST['Questions'];
			$cno = $_POST['CO'];
			$max = $_POST['max'];
			$enter = "INSERT INTO questions VALUES('$sub_id','$section','$exam','$question','$cno','$max')";
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
	
	
	<tr>
		<td>&nbsp</td><br>
		<td >
			<input type="hidden" name="subjectid" id='subjectid' value="<?php echo $sub_id; ?>"   form="confirmform">
			<input type="hidden" name="section"   id='section'   value="<?php echo $section; ?>"  form="confirmform">
			<input type="hidden" name="exam"      id='exam' 	 value="<?php echo $exam; ?>" 	  form="confirmform">
			<input type="hidden" name="session"   id='session' 	 value="<?php echo $session; ?>"  form="confirmform">
			<input type="submit" name="submit" value="Confirm" class="mybutton" form="confirmform" onclick='return confirm("Do you want to submit")'></td>
	</tr> 

	
	

</table>
</body>
</html>
