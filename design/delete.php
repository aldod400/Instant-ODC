<?php

$id =  $_GET['id'];

printf($id);
$connection = mysqli_connect("localhost","root","","instant");
$query =  mysqli_query($connection,"DELETE FROM `students` WHERE `student_id` = $id");

header("location: tables.php");

