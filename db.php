<?php 

$localhost ='localhost';
$username ='root';
$password ='';
$db_name ='student_course';

$conn = new mysqli($localhost,$username,$password,$db_name);
if (!$conn) {
    echo 'db not connected';
}
else {
    //echo 'connected';
}


?>