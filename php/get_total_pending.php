<?php
include_once("connection.php");

$today = date("Y-m-d");
$yesterday = date("Y-m-d", strtotime("-1 day"));
$tomorrow = date("Y-m-d", strtotime("+1 day"));
$nextday = date("Y-m-d", strtotime("+3 day"));


$query = "SELECT 
            (SELECT COUNT(*) FROM appointments WHERE stat = 'pending') as next_count,
            (SELECT COUNT(*) FROM appointments WHERE stat = 'pending') as next_pending,
            (SELECT COUNT(*) FROM appointments WHERE stat = 'approved') as next_approved,
            (SELECT COUNT(*) FROM appointments WHERE  stat = 'pending') as next_count";
            

$result = mysqli_query($con, $query);

if ($result) {
    $counts = mysqli_fetch_assoc($result);
    echo json_encode($counts);
} else {
    echo json_encode(["error" => "Error executing query"]);
}

mysqli_close($con);
?>
