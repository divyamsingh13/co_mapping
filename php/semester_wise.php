<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../css/finallook.css" >
	<link rel="stylesheet" type="text/css" href="../polyfill/number-polyfill.css" />
	<!-- <link rel="stylesheet" href="../css/coloringpageprint.css" type="text/css" media="print" /> --> 
	<script>
function ini()
{
	//document.getElementById("select").style.visibility="hidden";
	document.getElementById("select1").style.visibility="hidden";
}
function printpage()
{
	window.print()
}
function show(type)
{	

	if(type!='DEBARRED') {
	
		document.getElementById("select1").style.visibility="hidden";
	}
	else if(type=='DEBARRED') {
		document.getElementById("select1").style.visibility="visible";
		//document.getElementById("select").style.visibility="hidden";
	}
}
function getsem() {


         var xmlhttp;
         var dpt = document.getElementById("dpt").value;


         if (window.XMLHttpRequest) {
             //code for IE7,firefox,chrome,opera,safari  

             xmlhttp = new XMLHttpRequest();
         }
         else {

             xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
         }
         xmlhttp.open("GET", "showsemester.php?q=" + dpt, true);
         xmlhttp.send();

         xmlhttp.onreadystatechange = function () {
             if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                 document.getElementById("semester").innerHTML = xmlhttp.responseText;
             }
         }
     }
</script>
</head>
<body onload='ini();'>


<?php

include 'common.php';
echo "</br></br></br></br></br></br>";
include('connect.php');
$getid="SELECT * FROM login WHERE userid='$username'";

$retval = mysql_query( $getid, $conn );
while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){
 	$dept=$row['branch'];
 	$category=$row['category'];
}
if($category!="HOD" && $category!="ADMIN"){
	header('Location: index.php');
}

echo "
<style>
@media print{
	#table{
		display: none;
	
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
	font-size:9px;
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
#end{
	padding-top:10%;
}	
}

</style>";
?>

<form method="POST" action="semester_wise.php" id="form">
	
		
	<table id="table" width="40%">
	<?php
	if($category=='ADMIN') {
	?>
	<tr >
			<td >BRANCH</td>
			<td>
				<?php
				echo "<select name='branch' id='dpt' onchange='getsem()' required><option value=''>SELECT</option>";
				$query="SELECT DISTINCT branch FROM student ORDER BY branch ASC";
				mysql_select_db('portal');
				$getit = mysql_query( $query, $conn );
				while($row = mysql_fetch_array($getit, MYSQL_ASSOC)){
				$branch=$row['branch'];
				echo "<option value='$branch'>$branch</option>";
				}
				echo "</select>";
				?>
			</td>
		</tr>
	<?php  } ?>
		<tr>
		<td>Semester:</td>
		<td><select size="1" name="semester" id="semester" required="required">
		<option value="">SELECT</option>
		<?php
			$getsem = "SELECT DISTINCT(semester) from student WHERE branch='$dept' ORDER BY semester";
			$run_sem = mysql_query($getsem);
			while($row_sem= mysql_fetch_array($run_sem)) {
				echo "<option value='$row_sem[semester]'>$row_sem[semester]</option>";
			} 
		?></select></td>
		</tr>
		<tr>
			<td>select exam:</td>
			<td>
				<select size="1" name="exam" required="required" >
				<?php
					$selectexam="SELECT * FROM allow where type='T'";                          
					

					$get = mysql_query( $selectexam, $conn );
					while($row = mysql_fetch_array($get, MYSQL_ASSOC))
					{
						if($row['value']=='Y' && $row['type']=='T'){
						echo "<option value='$row[setting]'>$row[setting]</option>";           
						}
					}
				?>
					
					
				</select>
			</td>
		</tr>
		<tr>
			<td>select list type:</td>
			<td>
				<select size="1" name="type" required="required" onchange='show(this.value);'>
					<option value=''>SELECT</option>
					<option value='ABSENT'>ABSENT</option>           
					<option value='DEBARRED'>DEBARRED</option>
					<option value='PC'>PC</option>
					<option value='UFM'>UFM</option>
				</select>
			</td>
		</tr>
		
		<!-- <tr id='select'>
			<td>
				EXAM ABSENT IN:
			</td>
			<td>
				<select size="1" name="sub_type1"  onchange='show();'>
					<option value=''>SELECT</option>
					<option value='1'>ONE</option>           
					<option value='2'>TWO</option>
					<option value='3'>THREE</option>
					<option value='4'>FOUR</option>
					<option value='5'>ALL TYPE</option>
				</select>
			</td>
		</tr> -->
		<tr id='select1'>
			<td>
				DEBARRED TYPE:
			</td>
			<td>
				<select size="1" name="sub_type2"  >
					<option value=''>SELECT</option>
					<option value='sub'>SUBJECT-WISE</option>           
					<option value='overall'>OVERALL</option>
				</select>
			</td>
		</tr>
		
		<tr>
			<td></td>
			<td>
			<input type="submit" value="Submit" name="submit" class="myButton">
			</td>
		</tr>
		
	</table>
		
	
</form>
<?php
if(isset($_POST['submit'])){
	if($category=='ADMIN'){
		$dept= $_POST['branch'];
	}

	$sem = $_POST['semester'];
	$exam=$_POST['exam'];
	$type = $_POST['type'];
	if($type=='DEBARRED')
			$sub_type=$_POST['sub_type2'];

if($dept=="CSE")
$bran="Computer Science Engineering";

elseif($dept=="ME")
$bran="Mechanical Engineering";

elseif($dept=="EN")
$bran="Electrical Engineering ";

else if($dept=="IT")
$bran="Information Technology ";

else if($dept=="EE")
$bran="Electrical and Electronics  Engineering ";

else if($dept=="AS-HU")
$bran="Applied Science and Humanities";

else if($bept=="ECE")
$bran="Electronics and Communication Engineering";

	$date = date("d/m/Y");
	if($exam='ST1')
		$e='exam3';
	else if($exam='ST2')
		$e='exam4';
	else if($exam='PUT')
		$e='exam5';

	echo "<div align='center' id='new'>
			<div align='center' style='font-weight:bold;font-size:20px'>
				<br>AJAY KUMAR GARG ENGINEERING COLLEGE,GHAZIABAD<br>
			</div>";
			if($type=='ABSENT')
				echo "
				<div align='center' style='font-weight:600;font-size:16px'>
					$bran($sem SEMESTER)
					<br>LIST OF STUDENTS ABSENT IN $exam
					<br>  Report Date-$date
				</div> ";

			if($type=='DEBARRED')
				{
					if($sub_type=='overall')
						$j='DEBARRED';
					else 
						$j='SUBJECT-WISE DEBARRED';
					echo "
								<div align='center' style='font-weight:600;font-size:16px'>
									$bran($sem SEMESTER)
									<br>LIST OF STUDENTS $j IN $exam
									<br>  Report Date-$date
								</div> ";}

			if($type=='PC')
				echo "
				<div align='center' style='font-weight:600;font-size:16px'>
					$bran($sem SEMESTER)
					<br>LIST OF STUDENTS PROVISIONALLY CLEARED IN $exam
					<br>  Report Date-$date
				</div> ";

			if($type=='UFM')
				echo "
				<div align='center' style='font-weight:600;font-size:16px'>
					$bran($sem SEMESTER)
					<br>LIST OF STUDENTS MARKED FOR UFM IN $exam
					<br>  Report Date-$date
				</div> ";
	echo "<input type='button' name='print' value='PRINT'  id='print' onclick='printpage();'></input>";
	echo "</div>";
	echo "<div align='center'>";
	echo "<table align='center'  class='CSSTableGenerator'>";
	if($type=='PC') {
		$i=0;
		echo "<tr id='top'>
					<td><b>S.No.</b></td>
					<td><b>Roll No.</b></td>
					<td ><b>Name</b></td>
					<td><b> SECTION</b></td>
					
				</tr>";
		$get_student = "SELECT * FROM student WHERE branch='$dept' AND semester='$sem' ORDER BY section";
		$run_student = mysql_query($get_student);
		while($row_student=mysql_fetch_array($run_student)){
			$st_id=$row_student['st_id'];
			$name = $row_student['name'];
			$section = $row_student['section'];
			$get_pc = "SELECT * FROM pclist WHERE st_id='$st_id' AND exam='$exam' ";
			$run_pc = mysql_query($get_pc);
			if(mysql_num_rows($run_pc)>0)
			{	
				$i++;
				echo "<tr>
						<td>$i</td>
						<td>$st_id</td>
						<td>$name</td>
						<td>$section</td>";
				echo "</tr>";
			}
		}
	}

	if($type=='UFM') {
		$i=0;
		echo "<tr id='top'>
					<td><b>S.No.</b></td>
					<td><b>Roll No.</b></td>
					<td ><b>Name</b></td>
					<td><b> SECTION</b></td>
					<td><b> SUBJECT</b></td>
				</tr>";
		$get_student = "SELECT * FROM student WHERE branch='$dept' AND semester='$sem' ORDER BY section";
		$run_student = mysql_query($get_student);
		while($row_student=mysql_fetch_array($run_student)){
			$st_id=$row_student['st_id'];
			$name = $row_student['name'];
			$section = $row_student['section'];
			$get_ufm = "SELECT * FROM ufm WHERE st_id='$st_id' AND exam='$exam' ";
			$run_ufm = mysql_query($get_ufm);
			if(mysql_num_rows($run_ufm)>0)
			{	
				$i++;
				echo "<tr>
						<td>$i</td>
						<td>$st_id</td>
						<td>$name</td>
						<td>$section</td>
						<td>";
				while($row_ufm=mysql_fetch_array($run_ufm)) {
					echo $row_ufm['sub_id']."<br>";
				}
				echo "</td>";
				echo "</tr>";
			}
		}
	}

	if($type=='DEBARRED') {
		$i=0;
		if($sub_type=='sub') {
			echo "<tr id='top'>
						<td><b>S.No.</b></td>
						<td><b>Roll No.</b></td>
						<td ><b>Name</b></td>
						<td><b> SECTION</b></td>
						<td><b> SUBJECT</b></td>
					</tr>";
			$get_student = "SELECT * FROM student WHERE branch='$dept' AND semester='$sem' ORDER BY section";
			$run_student = mysql_query($get_student);
			while($row_student=mysql_fetch_array($run_student)){
				$st_id=$row_student['st_id'];
				$name = $row_student['name'];
				$section = $row_student['section'];
				$get_sub_debar = "SELECT * FROM debar_sub WHERE st_id='$st_id' AND exam='$exam' ";
				$run_sub_debar = mysql_query($get_sub_debar);
				if(mysql_num_rows($run_sub_debar)>0)
				{	
					$i++;
					echo "<tr>
							<td>$i</td>
							<td>$st_id</td>
							<td>$name</td>
							<td>$section</td>
							<td>";
					while($row_sub_debar=mysql_fetch_array($run_sub_debar)) {
						echo $row_sub_debar['sub_id']."<br>";
					}
					echo "</td>";
					echo "</tr>";
				}
			}
		}

		if($sub_type=='overall') {
			echo "<tr id='top'>
						<td><b>S.No.</b></td>
						<td><b>Roll No.</b></td>
						<td ><b>Name</b></td>
						<td><b> SECTION</b></td>
						
					</tr>";
			$get_student = "SELECT * FROM student WHERE branch='$dept' AND semester='$sem' ORDER BY section";
			$run_student = mysql_query($get_student);
			while($row_student=mysql_fetch_array($run_student)){
				$st_id=$row_student['st_id'];
				$name = $row_student['name'];
				$section = $row_student['section'];
				$get_debar = "SELECT * FROM debar WHERE st_id='$st_id' AND exam='$exam' ";
				$run_debar = mysql_query($get_debar);
				if(mysql_num_rows($run_debar)>0)
				{	
					$i++;
					echo "<tr>
							<td>$i</td>
							<td>$st_id</td>
							<td>$name</td>
							<td>$section</td>";
					
					echo "</tr>";
				}
			}
		}
	}

	if($type=='ABSENT') {
		$i=0;
	// 	if($sub_type=='1') {
	// 		echo "<tr id='top'>
	// 					<td><b>S.No.</b></td>
	// 					<td><b>Roll No.</b></td>
	// 					<td ><b>Name</b></td>
	// 					<td><b> SECTION</b></td>
	// 					<td><b> SUBJECT</b></td>
	// 				</tr>";
	// 		$get_student = "SELECT * FROM student WHERE branch='$dept' AND semester='$sem' ORDER BY section,st_id";
	// 		$run_student = mysql_query($get_student);
	// 		while($row_student=mysql_fetch_array($run_student)){
	// 			$st_id=$row_student['st_id'];
	// 			$name = $row_student['name'];
	// 			$section = $row_student['section'];
	// 			$get_sub_debar = "SELECT * FROM marks WHERE st_id='$st_id' AND $e='A' ";
	// 			$run_sub_debar = mysql_query($get_sub_debar);
	// 			if(mysql_num_rows($run_sub_debar)==1)
	// 			{	
	// 				$i++;
	// 				echo "<tr>
	// 						<td>$i</td>
	// 						<td>$st_id</td>
	// 						<td>$name</td>
	// 						<td>$section</td>
	// 						<td>";
	// 				while($row_sub_debar=mysql_fetch_array($run_sub_debar)) {
	// 					echo $row_sub_debar['sub_id']."<br>";
	// 				}
	// 				echo "</td>";
	// 				echo "</tr>";
	// 			}
	// 		}
	// 	}

	// 	if($sub_type=='2') {
	// 		echo "<tr id='top'>
	// 					<td><b>S.No.</b></td>
	// 					<td><b>Roll No.</b></td>
	// 					<td ><b>Name</b></td>
	// 					<td><b> SECTION</b></td>
	// 					<td>SUBJECT</td>
	// 				</tr>";
	// 		$get_student = "SELECT * FROM student WHERE branch='$dept' AND semester='$sem' ORDER BY section,st_id";
	// 		$run_student = mysql_query($get_student);
	// 		while($row_student=mysql_fetch_array($run_student)){
	// 			$st_id=$row_student['st_id'];
	// 			$name = $row_student['name'];
	// 			$section = $row_student['section'];
	// 			$get_absent = "SELECT * FROM marks WHERE st_id='$st_id' AND $e='A' ";
	// 			$run_absent = mysql_query($get_absent);
	// 			echo mysql_error();
	// 			if(mysql_num_rows($run_absent)==2)
	// 			{	
	// 				$i++;
	// 				echo "<tr>
	// 						<td>$i</td>
	// 						<td>$st_id</td>
	// 						<td>$name</td>
	// 						<td>$section</td>
	// 						<td>";
	// 				while($row_absent=mysql_fetch_array($run_absent)) {
	// 					echo $row_absent['sub_id']."<br>";
	// 				}
	// 				echo "</td>";
	// 				echo "</tr>";
	// 			}
	// 		}
	// 	}
	
	// 	if($sub_type=='3') {
	// 		echo "<tr id='top'>
	// 					<td><b>S.No.</b></td>
	// 					<td><b>Roll No.</b></td>
	// 					<td ><b>Name</b></td>
	// 					<td><b> SECTION</b></td>
	// 					<td>SUBJECT</td>
	// 				</tr>";
	// 		$get_student = "SELECT * FROM student WHERE branch='$dept' AND semester='$sem' ORDER BY section,st_id";
	// 		$run_student = mysql_query($get_student);
	// 		while($row_student=mysql_fetch_array($run_student)){
	// 			$st_id=$row_student['st_id'];
	// 			$name = $row_student['name'];
	// 			$section = $row_student['section'];
	// 			$get_absent = "SELECT * FROM marks WHERE st_id='$st_id' AND $e='A' ";
	// 			$run_absent = mysql_query($get_absent);
	// 			if(mysql_num_rows($run_absentabsent)==3)
	// 			{	
	// 				$i++;
	// 				echo "<tr>
	// 						<td>$i</td>
	// 						<td>$st_id</td>
	// 						<td>$name</td>
	// 						<td>$section</td>
	// 						<td>";
	// 				while($row_absent=mysql_fetch_array($run_absent)) {
	// 					echo $row_absent['sub_id']."<br>";
	// 				}
	// 				echo "</td>";
	// 				echo "</tr>";
	// 			}
	// 		}
	// 	}
	
	// if($sub_type=='4') {
	// 		echo "<tr id='top'>
	// 					<td><b>S.No.</b></td>
	// 					<td><b>Roll No.</b></td>
	// 					<td ><b>Name</b></td>
	// 					<td><b> SECTION</b></td>
	// 					<td>SUBJECT</td>
	// 				</tr>";
	// 		$get_student = "SELECT * FROM student WHERE branch='$dept' AND semester='$sem' ORDER BY section,st_id";
	// 		$run_student = mysql_query($get_student);
	// 		while($row_student=mysql_fetch_array($run_student)){
	// 			$st_id=$row_student['st_id'];
	// 			$name = $row_student['name'];
	// 			$section = $row_student['section'];
	// 			$get_absent = "SELECT * FROM marks WHERE st_id='$st_id' AND $e='A' ";
	// 			$run_absent = mysql_query($get_absent);
	// 			if(mysql_num_rows($run_absent)==4)
	// 			{	
	// 				$i++;
	// 				echo "<tr>
	// 						<td>$i</td>
	// 						<td>$st_id</td>
	// 						<td>$name</td>
	// 						<td>$section</td>
	// 						<td>";
	// 				while($row_absent=mysql_fetch_array($run_absent)) {
	// 					echo $row_absent['sub_id']."<br>";
	// 				}
	// 				echo "</td>";
	// 				echo "</tr>";
	// 			}
	// 		}
	// 	}
		// if($sub_type=='5') {
			echo "<tr id='top'>
						<td><b>S.No.</b></td>
						<td><b>Roll No.</b></td>
						<td ><b>Name</b></td>
						<td><b> SECTION</b></td>
						<td><b> SUBJECT</b></td>
					</tr>";
			$get_student = "SELECT * FROM student WHERE branch='$dept' AND semester='$sem' ORDER BY section,st_id";
			$run_student = mysql_query($get_student);
			while($row_student=mysql_fetch_array($run_student)){
				$sub_count=0;
				$absent=0;
				$st_id=$row_student['st_id'];
				$name = $row_student['name'];
				$section = $row_student['section'];
				$get_marks = "SELECT * FROM marks WHERE st_id='$st_id'";
				$run_marks = mysql_query($get_marks);	
					
				while($row_marks=mysql_fetch_array($run_marks)) {

					$sub_id=$row_marks['sub_id'];
					$marks=$row_marks[$e];
					$get_category = "SELECT category FROM subject WHERE sub_id='$sub_id'";
					$run_category = mysql_query($get_category);
					$row_category = mysql_fetch_array($run_category);
					if($row_category[0]=='T' || $row_category[0]=='O') {
						$sub_count++;
						if($marks=='A'){
							$absent_sub[$st_id][$absent]=$sub_id;
							$absent++;
						}
						
					}

				}
				
				if($absent==$sub_count){
					$i++;
					echo "<tr>
							<td>$i</td>
							<td>$st_id</td>
							<td>$name</td>
							<td>$section</td>
							<td>ABSENT IN ALL</td>";

				}
				if($absent!=$sub_count && $absent!=0){
					$i++;
					echo "<tr>
							<td>$i</td>
							<td>$st_id</td>
							<td>$name</td>
							<td>$section</td>
							<td>";
							for($k=0;$k<$absent;$k++) {
							echo $absent_sub[$st_id][$k]."<br>";	
							}
							echo "</td>";

				}
				echo "</tr>";
			}
		}
	
	

	echo "</table>";
				
		
echo "</div>";
echo "<div id='end' align='left' style='margin-left:10%;'>";
		$select_hod="SELECT name FROM login WHERE branch='$dept' AND category='HOD'";
		$run = mysql_query($select_hod);
		while($row_hod=mysql_fetch_array($run)){
			$hodname=$row_hod['name'];
			$category = 'HOD';
		}
			if ($dept=='MBA')
				  {

					echo "<b style='font-size:14px'>$hodname</b></br>
					<b style='font-size:14px'>DIRECTOR, AKGIM</b>
				 </div>";
				  }

				else if ($dept=='AS-HU')
				{
					
					echo "<b style='font-size:14px'>$hodname</b></br>
					<b style='font-size:14px'>DEAN, 1ST Year</b>
				</div>";
			    }

				else
				{

					echo "<b style='font-size:14px'>$hodname</b></br>
					<b style='font-size:14px'>$category $dept</b>
				</div>";
			}
// echo "<table style='border:none'>
// 			<tr><td style='text-align:left;border:none'>NOTE:</td></tr>
// 			<tr><td style='text-align:left;border:none'>1. The 'less than 50' for those who lies in range of 0 to 49.45</td></tr>
// 			<tr><td style='text-align:left;border:none'>2. The '50 to 60' for those who lies in range of 49.45-59.45</td></tr>
// 			<tr><td style='text-align:left;border:none'>3. The '60 to 70' for those who lies in range of 59.45-69.45</td></tr>
// 			<tr><td style='text-align:left;border:none'>4. The '70 to 75' for those who lies in range of 69.45-74.45</td></tr>
// 			<tr><td style='text-align:left;border:none'>5. The '75+' for those who lies in range of  74.45-100</td></tr>
// 		</table>";
	
		
}

?>
</body>
</html>