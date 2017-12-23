
<html>
<head>
<title>CO MAPPING</title>
<link rel="stylesheet" type="text/css" href="../css/common.css">
<link rel="stylesheet" type="text/css" href="../css/button.css">
<link rel="stylesheet" type="text/css" href="../css/styles.css">
<link href="../polyfill/number-polyfill.css" type="text/css" rel="stylesheet"></link>
<script src="../polyfill/vendor/jquery/jquery-1.10.2.min.js" type="text/javascript"></script>
<script src="../polyfill/number-polyfill.js" type="text/javascript"></script>
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
</head>
<body>

<?php
require_once('../../config.php');
require_login();
include 'connect.php';
global $USER;
$userid = $USER->id;
$username = $USER->username;
if($username=='arun'){
$username='111';}

// $is_admin="SELECT * FROM login WHERE userid='$username'";

// $admin= mysql_query( $is_admin, $conn );
// while($row = mysql_fetch_array($admin, MYSQL_ASSOC)){
// $category=$row['category'];
// //$b=$row[2];
// }
echo"
<div id='header1' class='noPrint'>
<div id='header_text1'>CO MAPPING</div>
<div id='header_right' align='right'>   
<ul class='button-group'>
<li><a class='button pill' href='../../index.php'>e-learning portal</a></li>
<li><a class='button pill' href='../../login/logout.php?sesskey=".$sesskey."'>Logout</a></li>
</ul>
</div> 
</div>";

if($_SESSION['category']=='ADMIN' || $_SESSION['category']=='FACULTY' || $_SESSION['category']=='HOD' || $_SESSION['category']=='PROCTOR' || $_SESSION['category']=='COORDINATOR'){
echo "<div id='cssmenu' class='noPrint'>";
if($_SESSION['category']=='PROCTOR')
	echo "<ul><li class='active'><a href='index.php'><span>HOME</span></a></li></ul>";
elseif($_SESSION['category']=='FACULTY')
{
echo "<ul>
	<li class='active'><a href='index.php'><span>HOME</span></a></li>
	<li><a href='#'><span>SCHEME</span></a>
   <ul>
		<li>
			<a href='entry_nba.php'><span>ADD SCHEME</span></a>

		</li>
		<li>

			<a href='entry2.php'><span>ADD/UPDATE MARKS</span></a>

		</li>
		
   </ul>
   </li>
   <li>

			<a href='entry3.php'><span>VIEW CO PERCENTAGE</span></a>

		</li>
	<li>

			<a href='entry4.php'><span>VIEW STUDENTS ATTEMPTED</span></a>

		</li>
   </ul>";

//if(mysql_num_rows(mysql_query("SELECT * FROM assignrole WHERE fac_id='$username' AND type='P'"))>0)

}
else if($_SESSION['category']=='HOD')
{
echo "
<ul>
   <li class='active'><a href='index.php'><span>HOME</span></a></li>
   <li >

			<a href='delete_scheme_hod.php'><span style='width:35%'>Delete Scheme</span></a>

		</li>
	<li><a href='#'><span>CO PERCENTAGE</span></a>
		<ul>
			<li ><a href='hod_section_nba.php'  ><span style='width:25%'>SECTION WISE</span></a></li>
			<li ><a href='hod_nba_faculty.php'  ><span style='width:25%'>FACULTY WISE</span></a></li>
			<li ><a href='hod_nba_subjectwise.php'  ><span style='width:25%'>SUBJECT WISE</span></a></li>
		</ul>
	</li>
	<li><a href='#'><span>STUDENT ATTEMPTED</span></a>
		<ul>
			<li ><a href='hod_section_nba_attempted.php'  ><span style='width:25%'>SECTION WISE</span></a></li>
			<li ><a href='hod_nba_faculty_attempted.php'  ><span style='width:25%'>FACULTY WISE</span></a></li>
			<li ><a href='hod_nba_subjectwise_attempted.php'  ><span style='width:25%'>SUBJECT WISE</span></a></li>
			
		</ul>
	</li>
	<li><a href='#'><span>Complete Scheme</span></a>
		<ul>
			<li ><a href='roll_no_hod_section.php'  ><span style='width:25%'>SECTION WISE</span></a></li>
			<li ><a href='roll_no_hod_faculty.php'  ><span style='width:25%'>FACULTY WISE</span></a></li>
			<li ><a href='roll_no_hod_subject.php'  ><span style='width:25%'>SUBJECT WISE</span></a></li>
		</ul>
	</li>
   ";
//echo "<li><a href='update_hod.php'><span>UPDATE</span></a></li>";
//echo "<li><a href='imc_hod.php'><span>GENERATE IMC</span></a></li>";
//echo "<li><a href='imc_hod_prac.php'><span>GENERATE PRACTICAL IMC</span></a></li>";
                 


	
echo "</ul>";


}
else if($_SESSION['category']=='COORDINATOR')
{
echo "
<ul>
   <li class='active'><a href='index.php'><span>HOME</span></a></li>
   ";
//echo "<li><a href='update_hod.php'><span>UPDATE</span></a></li>";
//echo "<li><a href='imc_hod.php'><span>GENERATE IMC</span></a></li>";
//echo "<li><a href='imc_hod_prac.php'><span>GENERATE PRACTICAL IMC</span></a></li>";
                 


                 

echo "<li><a href='#'><span>VIEW MARKS</span></a>
   <ul>
		<li>
			<a href='complete_student_information.php'><span>VIEW RESULT STUDENT WISE</span></a>
		</li>";
echo "<li>
				<a href='result_faculty_wise.php'><span>VIEW RESULT FACULTY WISE</span></a>
			</li>";
echo"<li>
			<a href='result_section.php'><span>VIEW RESULT SECTION WISE</span></a>
		</li>
		<li>
			<a href='result_practical_exam.php'><span>VIEW RESULT PRACTICAL WISE</span></a>
		</li>
		<li class='last'>
			<a href='result_exam.php'><span>VIEW RESULT EXAM WISE</span></a>
		</li>";
		echo "</ul>
   
   </li><!--<li><a href='generate_marks.php'>GENERATE ST-2 MARKS</a></li>-->";
	
		echo "<li class='last'><a href='#'><span>GENERATE LETTER</span></a>
			<ul>
		
		<li >

			<a href='poorac.php'  ><span>ST1 / ST2</span></a>

		</li>

		<li>

			<a href='perform.php'><span>Attendance</span></a>

		</li>

		<li>

			<a href='disp_st2.php'><span>DISPATCH LIST</span></a>

		</li>
		<li>

			<a href='letter4sh.php'><span>Absent From Exam (Letter)</span></a>

		</li>

		<li>

			<a href='disp_absent.php'><span>Absent From Exam (Dispatch List)</span></a>

		</li>

		
		
	</ul></li>";
	// echo "<li><a href='exam_analysis2.php'><span>EXAM REPORT</span></a></li>";
echo "</ul>";


}

else
{
echo "<ul>
   <li class='active'><a href='index.php'><span>HOME</span></a></li>";
		echo "<li><a href='#'><span>GENERATE IMC</span></a>
				<ul>
                                      
					<li>
					<a href='imc_set_dir.php'><span>SET THEORY DIR CASES</span></a>
					</li>
                                       
                         <li>
						<a href='imc_admin.php'><span>GENERATE THEORY IMC</span></a>
					</li>
                                        
                        <li>
					<a href='imc_admin_practical.php'><span>GENERATE PRACTICAL IMC</span></a>
					</li>

                                         
                                         <li>
						<a href='imc_reset_dir_dept.php'><span>RESET DIR CASES</span></a>
					</li>

                     <!--               
					<li>
						<a href='imc_set_dir_section.php'><span>SET DIR CASES SECTION</span></a>
					</li>
					
					
                         <li>
						<a href='imc_reset_dir_section.php'><span>RESET DIR CASES SECTION </span></a>
                          </li>
                         -->
				</ul>
			</li>";
echo "<li><a href='#'><span>VIEW MARKS</span></a>
   <ul>
		<li>
			<a href='complete_student_information.php'><span>VIEW RESULT STUDENT WISE</span></a>
		</li>";
echo "<li>
				<a href='result_faculty_wise_admin.php'><span>VIEW RESULT FACULTY WISE</span></a>
			</li>";
		echo"<li>
			<a href='result_section.php'><span>VIEW RESULT SECTION WISE</span></a>
		</li>
		<li>
			<a href='result_practical_exam.php'><span>VIEW RESULT PRACTICAL WISE</span></a>
		</li>
		<li class='last'>
			<a href='result_exam.php'><span>VIEW RESULT EXAM WISE</span></a>
		</li>";
	echo "</ul>
   
   </li>";
 	echo "<!--<li><a href='generate_marks.php'>GENERATE ST-2 MARKS</a></li>--><li><a href='#'><span>MARK PC/DB</span></a>
			<ul>
				<!--<li>
					<a href='debar.php'><span>MULTIPLE STUDENT</span></a>
				</li>-->
				<li>
					<a href='debar_sub.php'><span>Debar subjectwise</span></a>
				</li>
				<li>
					<a href='action_single.php'><span>Complete Debar</span></a>
				</li>";
				//$check="SELECT * FROM allow_menu WHERE menu='ufm'";
				$check="SELECT * FROM allow WHERE setting='ufm'";
				
				$checkit= mysql_query( $check, $conn );
				while($row = mysql_fetch_array($checkit, MYSQL_ASSOC)){
				$per=$row['value'];
				}
				if($per=='Y' || $_SESSION['category']=='ADMIN'){
				echo "<li>
					<a href='ufm.php'><span>ADD UFM</span></a>
				</li>";
				}
			echo "</ul>
		</li>";
		
	//echo "<li><a href='allot_oe.php'><span>ALLOTE OPEN ELECTIVE</span></a></li>";
   echo "<li class='last'><a href='#'><span>SETTINGS</span></a>
			<ul>
		<!--<li>
			<a href='sync_student.php'><span>SYNC STUDENT</span></a>
		</li>
		<li>
			<a href='sync_assignrole.php'><span>SYNC ASSIGN ROLE</span></a>
		</li>-->
		<li>

			<a href='sync_marks.php'><span>SYNC MARKS</span></a>

		</li>
		<li>

			<a href='sync_marks2.php'><span>CUSTOM SYNC MARKS</span></a>

		</li>

		<li>

			<a href='sync_prac2.php'><span>SYNC PRACTICAL MARKS</span></a>

		</li>
		<!--<li>
			<a href='update_mm.php'><span>UPDATE MAX MARKS</span></a>
		</li>-->
		<li>

			<a href='enter.php'><span>ALLOTE SUBJECT</span></a>

		</li>

		<li >
			<a href='allow_exams.php'><span>ALLOW EXAMS</span></a>
		</li>
		<li >
			<a href='allow_menu.php'><span>ALLOW MENU</span></a>
		</li>
		<!--<li >
			<a href='add_student.php'><span>ADD STUDENT</span></a>
		</li>
		<li >
			<a href='delete_student.php'><span>DELETE STUDENT</span></a>
		</li>
		<li >
			<a href='edit_student.php'><span>EDIT STUDENT</span></a>
		</li>-->
	</ul></li>";

echo "<li class='last'><a href='#'><span>GENERATE LETTER</span></a>
			<ul>
		
		<li>

			<a href='poorac.php'><span>ST1 / ST2</span></a>

		</li>

		<li>

			<a href='perform.php'><span>Attendance</span></a>

		</li>

		<li>

			<a href='disp_st2.php'><span>Dispatch List</span></a>

		</li>

		<li>

			<a href='letter4s.php'><span>ABSENT FROM EXAM</span></a>

		</li>

		
	</ul></li>";
	echo "<li class=''><a href='#'><span>REPORT</span></a>
			<ul>
		
		<li>

			<a href='report_admin.php'><span>COMPLETE REPORT</span></a>

		</li>
		<li>

			<a href='semester_wise.php'><span>SEMESTER-WISE REPORT</span></a>

		</li>

		

		

		
	</ul></li>";
	echo "<li class='last'><a href='#'><span>ACTIVITY LOG</span></a>
			<ul>
		
		<li>

			<a href='subjectwise.php'><span>Subject Wise</span></a>

		</li>

		<li>

			<a href='datewise.php'><span>Date Wise</span></a>

		</li>

		<li>

			<a href='studentwise.php'><span>Student Wise</span></a>

		</li>

		

		
	</ul></li>";

echo '</ul>';


}


echo "</div>";
}



?>

