<?php
$con=mysqli_connect("localhost","root","","cms");
if(!$con){
    die("connection failed".mysqli_connect_error());
}

$read="SELECT * from student order by id desc limit 1";
$result=mysqli_query($con,$read);

if($result){
    $fetch=mysqli_fetch_assoc($result);
    $lastroll=$fetch['id'];

    if($lastroll==null){
        $newroll="STUD230001";

    }else{
        $newroll=str_replace("STUD23","",$lastroll);
        $newroll=str_pad($newroll+1,4,0,STR_PAD_LEFT);
        $newroll="STUD23".$newroll;
    }

}else{
    echo"<script>alert('no record found');</script>";
    echo "<script>window.location.href='addstd.php';</script>";
    exit;
}

if(isset($_POST['submit'])){
    $filename= $_FILES["fileupload"]["name"];
    $tmpname=$_FILES["fileupload"]["tmp_name"];
    $folder="images/".$filename;
    move_uploaded_file($tmpname, $folder);

    $name=$_POST['name'];
    $fname=$_POST['fname'];
    $mname=$_POST['mname'];
    $roll=$_POST['id'];
    $gn=$_POST['gn'];
    $eid=$_POST['eid'];
    $db=$_POST['db'];
    $adr=$_POST['adr'];
    $crs=$_POST['crs'];
    $ten=$_POST['ten'];
    $twl=$_POST['puc'];
    $num=$_POST['num'];
    $pass=$_POST['pass'];
    $type="student";

   
    $emailCheckQuery = "SELECT * FROM student WHERE email='$eid'";
    $emailCheckResult = $con->query($emailCheckQuery);
    if($emailCheckResult->num_rows != 0){
        echo"<script>alert('Email already exists');</script>";
        echo "<script>window.location.href='addstd.php';</script>";
        exit;
    }

    $phoneCheckQuery = "SELECT * FROM student WHERE phone='$num'";
    $phoneCheckResult = $con->query($phoneCheckQuery);
    if($phoneCheckResult->num_rows != 0){
        echo"<script>alert('Phone number already exists');</script>";
        echo "<script>window.location.href='addstd.php';</script>";
        exit;
    }

    $sql="INSERT INTO student (id,name,fname,mname,image,email,phone,dob,gender,tenth,twlth,course,address,status,pass)VALUES('$roll','$name','$fname','$mname','$folder','$eid','$num','$db','$gn','$ten','$twl','$crs','$adr','available','$pass')";
    $res=$con->query($sql);

    $sql1="INSERT INTO login(type,id,pass)VALUES('$type','$roll','$pass')";
    $res1=$con->query($sql1);

    if($res){
        echo"<script>alert('Student added successfully');</script>";
        echo "<script>window.location.href='admin_student.php';</script>";
        exit;
    }else{
        die(mysqli_error());
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: lightblue;
            background-image: url("backgrounds/add.jpg");
            background-repeat: no-repeat;
            overflow: hidden;
            background-size: cover;
        }

        form {
            background-color: #fff;
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            opacity: 0.9;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            position: relative;
            height: 670px;
        }

        h1 {
            text-align: center;
            margin-top: 0;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="file"] {
            width: 100%;
            margin-bottom: 18px;
        }

        input[type="number"],
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border-radius: 3px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        textarea {
            resize: none;
            height: 60px;
            overflow-y: scroll;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
            width: 90px;
            text-align: center;
            display: inline-block;
            float: left;
        }

        a {
            background-color: blue;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            float: right;
        }

        .error {
            color: red;
            font-style: italic;
            font-size: 12px;
            margin-bottom: 5px;
        }

        .container {
            height: auto;
        }

        .container::after {
            content: "";
            display: table;
            clear: both;
        }

        .left {
            width: 45%;
            float: left;
        }

        .right {
            width: 45%;
            float: right;
        }

        .password-container {
            position: relative;
        }

        .password-container input[type="password"] {
            padding-right: 30px;
        }

        .password-container .show-password-icon {
            position: absolute;
            top: 35%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <h1>Student Registration Form</h1>
        <div class="container">
            <div class="left">
                <label>Roll Number:</label>
           		<input type='text' name='id' value="<?php echo $newroll; ?>"  readonly> <br><br>

           		<label>Father Name:</label>
            	 <input type="text" name="fname" placeholder="Enter Father Name" required pattern="[A-Za-z]+" title="Name should contain alphabets" required><br><br>

                <label>Profile image of student:</label>
            	<input type="file" name="fileupload" required accept=".jpg, .jpeg">

            	<label>Date of birth:</label>
                <input type="date" name="db" id="myDate" required>

                <label>Course:</label>
	            <select name="crs" style="width: 100%;" required>
                <option value=""> Select Department</option>
	            <?php
						    $c=0;
						    $qry="SELECT * from course";
						    $res=$con->query($qry);
						    $nob=$res->num_rows;
						    while($c<$nob){
							    $row=$res->fetch_assoc();
							    echo "<option>".$row['cname']."</option>";
							    $c=$c+1;
					    	}
					     ?>
	            </select><br><br>

	            <label>10th mark:</label>
                <input type="number" min="0" max="100" name="ten" autocomplete="off" required><br><br>

                <label>Mobile number:</label>
                <input type="number" min="1000000000" max="9999999999" name="num" autocomplete="off" required><br><br>

                
            </div>
            <div class="right">
                <label>Name:</label>
                <input type="text" name="name" autocomplete="off" autofocus required pattern="[A-Za-z]+" title="Name should contain alphabets" required><br><br>

                <label>Mother Name:</label>
            	<input type="text" name="mname" placeholder="Enter Mother Name" required pattern="[A-Za-z]+" title="Name should contain alphabets" required> <br><br>

                <label>Gender:</label>
                <input type="radio" value="Male" name="gn" required>Male 
                <input type="radio" value="Female" name="gn" required>Female
                <input type="radio" value="Other" name="gn" required>Other<br><br>
                
                <label>Email:</label>
                <input type="email" name="eid" placeholder="Enter email" required> 

                <label>Address</label>
                <textarea name="adr" placeholder="Enter address or locaton of student" required></textarea>

                <label>PUC mark:</label>
                <input type="number" min="0" max="100" name="puc" autocomplete="off" required><br><br>

                <label>Password:</label>
                <div class="password-container">
                    <input type="password" name="pass" value="<?php echo $newroll; ?>" readonly required>
                    <span class="show-password-icon" onclick="togglePasswordVisibility()">&#128065;</span>
                </div>
            </div>

            
                
            </div>
        </div>
        <div class="buttons">    
            <input type="submit" name="submit" value="Submit">
            <a href="admin_student.php">Back</a>    
        </div>
    </form>
    <script>
        var currentDate = new Date();
        var minDate = new Date();
        minDate.setFullYear(currentDate.getFullYear() - 25);
        var maxDate = new Date();
        maxDate.setFullYear(currentDate.getFullYear() - 19);
        var minDateString = minDate.toISOString().split('T')[0];
        var maxDateString = maxDate.toISOString().split('T')[0];

        window.onload = function() {
            document.getElementById("myDate").setAttribute("min", minDateString);
            document.getElementById("myDate").setAttribute("max", maxDateString);
        };

        function togglePasswordVisibility() {
            var passwordInput = document.querySelector("input[name='pass']");
            var showPasswordIcon = document.querySelector(".show-password-icon");
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                showPasswordIcon.innerHTML = "&#128064;"; 
            } else {
                passwordInput.type = "password";
                showPasswordIcon.innerHTML = "&#128065;"; 
            }
        }
    </script>
</body>
</html>
