<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "barcodescanner";

$conn = mysqli_connect($servername, $username, $password, $database);
// echo var_dump($_GET);
$id = $_GET['id'];
// echo $id;
$sql = "SELECT * FROM `general_info` WHERE ID='$id';";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
// echo var_dump($row);
if($row != NULL) {
  // echo var_dump($row);
  $today = $_SESSION['timestamp'];
  // echo $today;
  date_default_timezone_set("Asia/Dhaka");
  $now = date("Y-m-d H:i:s");

  $sql = "SELECT * FROM `in_at` WHERE TIMESTAMP = '$today' && ID = '$id';";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  if($row == NULL) {
    $sql = "INSERT INTO `in_at` (`TIMESTAMP`, `ID`, `TIME`) VALUES ('$today', '$id', '$now');";
    $result = mysqli_query($conn, $sql);
    $st=$_SESSION['startat'];
    // echo $st;
    $x = substr($now, 11);
    // echo $x;
    // echo "<br>";
    $x = substr($now, -8, -3);
    // echo $x;
    $flag;
    $sql = "SELECT * FROM `event_details` WHERE `TIMESTAMP` = '$today';";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    if($st >= $x) {
      $present = $row['PRESENT']+1;
      $total = $row['TOTAL'];
      $late = $row['LATE'];
      $sql = "UPDATE `event_details` SET `PRESENT` = '$present' WHERE `event_details`.`TIMESTAMP` = '$today';";
      $result = mysqli_query($conn, $sql);
    }
    else {
      // echo "After";
      $present = $row['PRESENT'];
      $total = $row['TOTAL'];
      $late = $row['LATE']+1;
      $sql = "UPDATE `event_details` SET `LATE` = '$late' WHERE `event_details`.`TIMESTAMP` = '$today';";
      $result = mysqli_query($conn, $sql);
    }

  }
  echo 0;

  

}
else {
  echo 1;
}
?>