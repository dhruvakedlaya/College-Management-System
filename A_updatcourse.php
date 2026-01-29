<?php
$con = mysqli_connect("localhost", "root", "", "cms");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
$id = $_GET['upt'];
$sql = "UPDATE course set status='available' where sno='$id'";
$rt = $con->query($sql);
if($rt){
    echo "<script>alert('Course added back to college successfully'); window.location.href='view_course_qu.php';</script>";

}

?>