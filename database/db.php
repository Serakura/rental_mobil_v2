<?php

$conn = mysqli_connect("localhost", "root", "", "rent_cars");

// Check connection
if (mysqli_connect_errno()) {
	echo "Connection failed : " . mysqli_connect_error();
}
