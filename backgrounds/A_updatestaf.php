
        <?php
        $con = mysqli_connect("localhost", "root", "", "cms");
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $id=$_GET['upt'];
        $sql="select * from staff where id='$id'";
        $rt=$con->query($sql);
        $r=mysqli_fetch_assoc($rt);
        $sn=$r['name'];
        $db=$r['dob'];
        $eid=$r['email'];
        $qual=$r['qual'];
        $depart=$r['depart'];
        $ad=$r['address'];
        $phone=$r['phone'];
        $pass=$r['pass'];


        if (isset($_POST['dregister']))
        {
            $name=$_POST['na'];
            $mb=$_POST['mb'];
            $ql=$_POST['qual'];
            $dep=$_POST['depart'];
            $adr=$_POST['ad'];
            $dob=$_POST['db'];
            $ps=$_POST['ps'];
            $cps=$_POST['cps'];
            $email=$_POST['ed'];
            
            if($sn==$name && $db==$dob && $eid==$email && $qual==$ql && $depart==$dep && $pass==$ps && $ad==$adr && $phone==$mb)
            {
                echo"<script>alert('No changes were made');</script>";
                echo'<script>window.location.href="viewstf.php";</script>';
            }
            else
            {

            if($ps==$cps)
            {
                $uqry="UPDATE staff SET name='$name', dob='$dob', email='$email', phone='$mb', address='$adr', qual='$ql', depart='$dep', pass='$ps' where id='$id'";
                $rlt=$con->query($uqry);
                if($rlt)
                {
                    echo"<script>alert('Updated successfully');</script>";
                    echo'<script>window.location.href="viewstf.php";</script>';
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
        ?>
<!DOCTYPE html>
<html>
<head>
    <title>Staff Update Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: lightblue;
            background-image: url(1.jpg);
            background-repeat: no-repeat;
            background-size: cover;
        }

        form {
            background-color: #fff;
            top: 70px;
            max-width: 500px;
            margin: 0 auto;
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
            text-align: left;
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
            height: 100px; /* Adjust the desired height */
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

        
    </style>
</head>
<body>
    <form action="" method="POST" enctype="multipart/form-data">
        <h1>Staff Update Form</h1>
        <div class="container">
            <div class="left">
           <label>Staff Name</label>
                <input type="text" placeholder="Enter staff name" name="na" value="<?php echo $sn;?>" autocomplete="off" required />

                <label>Department</label>
                <input type="text" placeholder="Enter depart" value="<?php echo $depart;?>" autocomplete="off" required name="depart"/>

                <label>Date Of Birth</label>
                <input type="date" class="dob" placeholder="Enter Birth Date" value="<?php echo $db;?>" required name="db"/>
            </div>
            <div class="right">
                 <label>Email</label>
                <input type="email" placeholder="Enter Email" value="<?php echo $eid;?>" required name="ed"/> 

                <label>Qualification</label>
                <input type="text" placeholder="Enter Qualification" value="<?php echo $qual;?>" required name="qual"/>

                <label>Mobile Number</label>
                <input type="number" placeholder="Enter mobile number" required min="1000000000" max="9999999999" value="<?php echo $phone;?>" name="mb"/>

            </div>

            <label>Address:</label>
            <textarea name="adr" autocomplete="off" required></textarea><br><br> 
            
            
            <div class="left">
               <label>Enter new password</label>
                <input type="password" placeholder="Enter password" value="<?php echo $pass;?>" name="ps" required/>
            </div>
            <div class="right">
                
                <label>Confirm password</label>
                
                <input type="password" placeholder="Confirm password" value="<?php echo $pass;?>" name="cps" required/>

            </div>
        </div>
        <div class="buttons">    
            <input type="submit" name="submit" value="Submit">
            <a href="admin_Staff.php">Back</a>    
        </div>
    </form>
</body>
</html>
