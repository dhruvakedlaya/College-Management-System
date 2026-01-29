<?php
$con=mysqli_connect("localhost","root","","cms");
if(!$con){
    die(mysqli_err());
}
if(isset($_POST['btn-delete'])){
	$id=$_POST['id'];
	$qry="select * from staff where status='available' and id='$id'";
$res=$con->query($qry);
$r=$res->num_rows;
	if($r>0){
	
	$uqry="UPDATE staff SET status='Not Available' where id='".$id."'";
	$res=$con->query($uqry);
	$del="DELETE from login where id='$id'";
	$res1=$con->query($del);
	if($res&&$res1){
		echo"<script>alert('staff removed from college');</script>";
		echo"<script>window.location.href='viewstf.php';</script>";
	}
}
else{
	echo"<script>alert('staff is not available');</script>";
		echo"<script>window.location.href='viewstf.php';</script>";

}
}
if(isset($_POST['btn-delete-stud'])){
	$id=$_POST['id'];
	$qry="select * from student where status='available' and id='".$id."'";
$res=$con->query($qry);
$r=$res->num_rows;
	if($r>0){
	$uqry="UPDATE student SET status='Not Available' where id='".$id."'";
	$res=$con->query($uqry);
	$del="DELETE from login where id='$id'";
	$res1=$con->query($del);
	if($res&&$res1){
		echo"<script>alert('student removed from college');</script>";
		echo"<script>window.location.href='viewstd.php';</script>";
	}
}
else{
	echo"<script>alert('student is not available');</script>";
		echo"<script>window.location.href='viewstd.php';</script>";

}
}
?>