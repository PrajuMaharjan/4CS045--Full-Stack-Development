 <!-- Task: Create an associative array representing a Student. It must have keys for student_id ,full_name , and gpa . Print a sentence: "Name] has a GPA of [GPA]". -->
<?php

$Student=[
	"student_id"=>101,
	"full_name"=>"Praju Maharjan",
	"gpa"=>3.00
];
echo $Student["full_name"]." has a GPA of ".$Student["gpa"];
?>



