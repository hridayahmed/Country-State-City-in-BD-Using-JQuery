<?php
session_start();
$con = mysqli_connect("localhost","root","","test2");
if(isset($_POST["action"]))
{
	$output = '';
	if($_POST["action"] == "division_id")
	{
		$query_change = $_POST["query"]; 
		$query = "SELECT * FROM bd_zila WHERE division_id = '$query_change' ";
		$result = mysqli_query($con, $query);
		$output .= '<option value="" selected="selected">Select Zila</option>';
		while($row = mysqli_fetch_array($result))
		{
		$output .= '<option value="'.$row["zila_id"].'">'.$row["name"].'</option>';
		}
	}

	if($_POST["action"] == "zila_id")
	{
		$query_change = $_POST["query"];
		$query = "SELECT * FROM bd_upazila WHERE zila_id = '$query_change' ";
		$result = mysqli_query($con, $query);
		$output .= '<option value="">Select Upazila</option>';
		while($row = mysqli_fetch_array($result))
		{
		$output .= '<option value="'.$row["upazila_id"].'">'.$row["name"].'</option>';
		}
	}
	echo $output;
}
?>