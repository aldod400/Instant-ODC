<?php

$name = $_GET['searchquery'];
$connection = mysqli_connect("localhost", "root", "", "root");
$query = mysqli_query($connection, "SELECT * FROM students WHERE student_name = $name");
$query_results = mysqli_fetch_all($query);
foreach ($query_results as $values) {    $query2 = mysqli_query($connection, "SELECT * FROM phones WHERE student_id = $values[id]");
}