<?php
include "../dbinfo.inc";
$db=DB_DATABASE;
$title = $_POST['title'];
$emp = $_POST['employee'];
$start = $_POST['startDate'];
$end = $_POST['ends_at'];

$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
if (mysqli_connect_errno())
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
$statement = "delete from $db.empEvents where empName ='".$emp."' and title ='".$title."' and start ='".$start."' and end ='".$end."'";
$result=mysqli_query($con,$statement);
echo $result;
    mysqli_close($con);
?>
