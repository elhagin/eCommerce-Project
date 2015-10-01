<?php
function conn()
{
	$mysqli = mysqli_connect("localhost:3306", "root", "", "testphp");
	if (mysqli_connect_errno($mysqli)) {
	    echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
}
?>