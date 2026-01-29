<?php
$con=mysqli_connect("localhost","root","","cms");
if(!$con){
    die(mysqli_err());
}
if(isset($_POST['btn-delete'])){
	$qry="select * from student where status='available'";
    $res=$con->query($qry);
    $r=$res->num_rows;
	if($r>0){
	$id=$_POST['id'];
	$uqry="UPDATE student SET status='Not Available' where id='".$id."'";
	$res=$con->query($uqry);
	$del="DELETE from login where user='$id'";
	$res1=$con->query($del);
	if($res&&$res1){
		echo"<script>alert('student removed from college');</script>";
		echo"<script>window.location.href='viewstd.php';</script>";
	}
    else{
        echo"<script>alert('FAILED');</script>";
		echo"<script>window.location.href='viewstd.php';</script>";
    }
}
else{
	echo"<script>alert('student is not available in the college');</script>";
		echo"<script>window.location.href='viewstd.php';</script>";

}
}
?>