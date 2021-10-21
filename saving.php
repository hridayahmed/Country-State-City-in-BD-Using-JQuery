<?php
	session_start();
	$con = mysqli_connect("localhost","root","","test2");

	$division_id = $_POST['division_id'];
	$zila_id = $_POST['zila_id'];
	$upazila_id = $_POST['upazila_id'];

	//division search
	$division_sql = "SELECT * FROM bd_division WHERE id = '$division_id' ";
	$division_res = mysqli_query($con, $division_sql) or die(mysqli_error($con));
	$division_row = mysqli_fetch_assoc($division_res); 
	echo $division_row['name'];
	echo "<br>";

	//zila search
	$zila_sql = "SELECT * FROM bd_zila WHERE zila_id = '$zila_id' ";
	$zila_res = mysqli_query($con, $zila_sql) or die(mysqli_error($con));
	$zila_row = mysqli_fetch_assoc($zila_res); 
	echo $zila_row['name'];
	echo "<br>";

	//upazila search
	$upazila_sql = "SELECT * FROM bd_upazila WHERE upazila_id = '$upazila_id' ";
	$upazila_res = mysqli_query($con, $upazila_sql) or die(mysqli_error($con));
	$upazila_row = mysqli_fetch_assoc($upazila_res); 
	echo $upazila_row['name'];
	echo "<br>";
?>