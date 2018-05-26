<?php
include "../dbinfo.inc";
$db=DB_DATABASE;
/* Connect to MySQL and select the database. */
$con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
if (mysqli_connect_errno())
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
$statement="SELECT empID,empName FROM $db.employee";
$result=mysqli_query($con,$statement);
if(!$result){  die("SQL Error:".mysqli_error($con));  }
  // Fetch one and one row
 $usersinfo_arr = array();
 $info_arr= array();
while ($row = mysqli_fetch_array($result)) {
  $empid= $row['empID'];
  $empname=$row['empName'];
  $info_arr[] = array("empID" =>$empid ,"empName" => $empname);
}
// encoding array to json format
echo json_encode($info_arr);
// debug_to_console( $usersinfo_arr );
 // Free result set
mysqli_free_result($result);
mysqli_close($con);

?>
