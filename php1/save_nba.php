<?php
include 'common.php';
include('connect.php');
	if(isset($_POST['ADD'])) {
		$sub_id = $_POST['sub_id'];
		$section = $_POST['section'];
		$exam = $_POST['exam'];
		$session = $_POST['session'];
		$semester = $_POST['semester'];
		$count = $_POST['countval'];
		$j=$_POST['jval'];
		$branch = $_POST['branch'];

		// $check = "SELECT * FROM nba_student where session='$session' AND section='$section 'AND exam='$exam' AND sub_id='$sub_id' AND entered='1' ";
		// $run_check = mysql_query($check);
		// echo mysql_error();
		// $num = mysql_num_rows($run_check)+1;
		// $k=1;

		// $add = "SELECT * FROM nba_student where session='$session' AND section='$section 'AND exam='$exam' AND sub_id='$sub_id'";
		// $run_add = mysql_query($add);
		// echo mysql_error();
		// while($row_add=mysql_fetch_array($run_add))
		// {
		// 	if($k==$num+1) {

		// 	}
		// }

		
			for ($i=1; $i <=$j-1; $i++) { 
				
			$name_ind='st_name'.$i;
			$stid_index='st_id'.$i;
			//$subid_index='sub_id'.$i;
			//$exam_index='exam'.$i;
			//$section_index='section'.$i;
			//$branch_index='branch'.$i;
			//$semester_index='semester'.$i;
			//$session_index='session'.$i;


			 $name=$_POST[$name_ind];
			 $st_id=$_POST[$stid_index];
			 // $sub_id1=$_POST[$subid_index];
 			//  $exam=$_POST[$exam_index];
 			//  $section=$_POST[$section_index];
 			//  $branch=$_POST[$branch_index];
 			//  $semester=$_POST[$semester_index];
 			//  $session=$_SESSION['session'];
 			

 			$find = "SELECT * FROM nba_student where st_id='$st_id' AND exam='$exam' AND sub_id='$sub_id'";
 			$runfind = mysql_query($find);
 			if(mysql_num_rows($runfind)==0) {
 				$enter = "INSERT INTO nba_student(fac_id,st_id,name,exam,sub_id,question_no,section,session,branch,semester) VALUES('$username','$st_id','$name','$exam','$sub_id','$count','$section','$session','$branch','$semester')";
 				$run1 = mysql_query($enter);

 			}
 			$rowfind = mysql_fetch_array($runfind);
 			//if($rowfind['entered']==1)
 			//	continue;

 		$entry=0;
		for($x=1;$x<=$count;$x++)
		{
			echo $marks_index="t".$x."-".$i ;
			echo $marks=$_POST[$marks_index];
			if($marks != "") {
				$entry++;
			
			$m="mark".$x;
			
			$e="UPDATE nba_student SET $m='$marks' WHERE st_id='$st_id' AND exam='$exam' AND sub_id='$sub_id'";
			$r=mysql_query($e);
			echo mysql_error();
		}
			

} 
if($entry !=0)
	$ef="UPDATE nba_student SET entered='1' WHERE st_id='$st_id' AND exam='$exam' AND sub_id='$sub_id'";
			$rf=mysql_query($ef);
			//echo mysql_error();

			}
			echo "<script>alert('MARKS ADDED SUCCESSFULLY');</script>";
			header('Location:nba_student.php');
		}
		
	 ?>