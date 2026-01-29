

        <?php
        $con = mysqli_connect("localhost", "root", "", "cms");
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $id=$_GET['upt'];
        $sql="select * from student where id='$id' and status='available'";
        $rt=$con->query($sql);
        $r=mysqli_fetch_assoc($rt);
        $sn=$r['name'];
        $fn=$r['fname'];
        $mn=$r['mname'];
        $db=$r['dob'];
        $eid=$r['email'];
        $ten=$r['tenth'];
        $twl=$r['twlth'];
        $course=$r['course'];
        $ad=$r['address'];
        $phone=$r['phone'];
        $pass=$r['pass'];

            if (isset($_POST['dregister']))
            {
                $name=$_POST['na'];
                $mb=$_POST['mb'];
                $tn=$_POST['tent'];
                $tw=$_POST['twel'];
                $fna=$_POST['fn'];
                $mna=$_POST['mn'];
                $selectedCourse = $_POST['crs'];
                $adr=$_POST['ad'];
                $dob=$_POST['db'];
                $ps=$_POST['ps'];
                $cps=$_POST['cps'];
                $email=$_POST['ed'];

                $studentCheckQuery = "SELECT * FROM student WHERE (phone='$mb' OR email='$email') AND id != '$id'";
                $studentCheckResult = $con->query($studentCheckQuery);
                if ($studentCheckResult->num_rows > 0) {
                    echo "<script>alert('Phone number or email already exist.');</script>";
                }
                else{
                    $staffCheckQuery = "SELECT * FROM staff WHERE (phone='$mb' OR email='$email') AND id != '$id'";
                    $staffCheckResult = $con->query($staffCheckQuery);
                    if ($staffCheckResult->num_rows > 0) {
                        echo "<script>alert('Phone number or email already exists.');</script>";
                    }
                    else{
                
                if ($sn == $name && $db == $dob && $eid == $email && $ten == $tn && $twl == $tw && $fn == $fna && $mn == $mna && $course == $selectedCourse && $pass == $ps && $ad == $adr && $phone == $mb)
                {
                    echo "<script>alert('No changes were made');</script>";
                }
                else
                {
                    if ($ps == $cps)
                    {
                        $uqry = "UPDATE student SET name='$name', dob='$dob', fname='$fna', mname='$mna', email='$email', phone='$mb', address='$adr', tenth='$tn', twlth='$tw', course='$selectedCourse', pass='$ps' WHERE id='$id'";
                        $rlt = $con->query($uqry);
                        $lgqry="UPDATE login set pass='$ps' where id='$id'";
                        $res=$con->query($lgqry);
                        if ($rlt&&$res)
                            {
                                 echo "<script>alert('Updated successfully');</script>";
                                echo "<script>window.location.href='viewstd.php';</script>";
                            }
                            else
                            {
                                die(mysqli_error(($con)));
                            }
                    }
                    else
                    {
                        echo "<b><center><h3>Password mismatch</h3></center></b>";
                    }
                }
            }
                }
            }

            


?>
   <!DOCTYPE html>
<html>
<head>
    <title>Staff Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: lightblue;
            background-image: url(staff_register.jpg);
            background-repeat: no-repeat;
            background-size: cover;
        }

        form {
            background-color: #fff;
            max-width: 500px;
            margin: 0 auto;
            top: 60px;
            padding: 30px;
          
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
            position: relative;
            height: 550px;
        }

        h1 {
            text-align: center;
            margin-top: 0;
        }

        label {
            display: block;
            margin-bottom: 5px;
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
            float: right;
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
            float: left;
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

        
    </style>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <h1>Student Update Form</h1>
        <div class="container">
            <div class="left">
                <label>Student Name</label>
                <input type="text" placeholder="Enter staff name" name="na" value="<?php echo $sn;?>" autocomplete="off" pattern="[A-Za-z]+" title="Name should contain alphabets" required />

                <label>Mother Name:</label>
                <input type="text" placeholder="Enter Mother name" value="<?php echo $mn;?>" autocomplete="off" pattern="[A-Za-z]+" title="Name should contain alphabets" required name="mn"/>

                 <label>Date Of Birth</label>
                <input type="date" value="<?php echo $db; ?>" id="myDate" required name="db"/>

                <label>Mobile Number</label>
                <input type="number" placeholder="Enter mobile number" required min="1000000000" max="9999999999" value="<?php echo $phone;?>" name="mb"/><br><br>

               <label>10th %</label>
               <input type="text" placeholder="Enter 10th %" value="<?php echo $ten;?>" autocomplete="off" required name="tent"/>

                <label>Enter new password</label>
                <input type="text" placeholder="Enter password" value="<?php echo $pass;?>" name="ps" required/>
                
                
            </div>
            <div class="right">

                <label>Father Name:</label>
                <input type="text" placeholder="Enter Father name" value="<?php echo $fn;?>" pattern="[A-Za-z]+" title="Name should contain alphabets" required name="fn"/>

                <label>Email</label>
                <input type="email" id="email" placeholder="Enter Email" value="<?php echo $eid;?>" required name="ed"/>   

                <label>Course</label>
                    <select name="crs" required>
                    <option value="">Select Course</option>
                    <?php
                        $courseQuery = "SELECT * FROM course";
                        $courseResult = $con->query($courseQuery);

                        while ($row = mysqli_fetch_assoc($courseResult)) {
                            $courseName = $row['cname'];
                            $selected = ($course === $courseName) ? 'selected' : '';
                            echo "<option value='$courseName' $selected>$courseName</option>";
                        }
                    ?>
                    </select>


               
                <label>Address</label>
                <textarea placeholder="Enter full address"  required name="ad" autocomplete="off"/><?php echo $ad;?></textarea>


                <label>12th %</label>
                <input type="text" placeholder="Enter 12th %" value="<?php echo $twl;?>" autocomplete="off" required name="twel"/>

                    
                <label>Confirm password</label>
                <input type="text" placeholder="Confirm password" value="<?php echo $pass;?>" name="cps" required/>
            </div>    
            </div>
        </div>
        <div class="buttons">    
           <input type="submit" name="dregister" value="Update">
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
</script>
</body>
</html>
