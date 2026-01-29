<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>
        Update Profile
    </title>
    <link rel="stylesheet" href="css/all.min.css">
	<link rel="stylesheet" href="css/fontawesome.min.css">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background:url("backgrounds/471.jpg");
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            margin-top:10px;
            padding: 20px;
            background-color: #EAF2F8;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            opacity:0.95;
        }

        .profile-card {
            text-align: center;
           
        }

        .profile-picture {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto;
            background-color: white;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-picture img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-details {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .profile-details table {
            width: 100%;
            border-collapse: collapse;
        }

        .profile-details td,
        .profile-details th {
            padding: 10px;
            border: 1px solid #ccc;
        }

        .profile-details th {
            background-color: #f0f0f0;
        }

        .edit-card {
            display: none;
            margin-top: 20px;
        }

        .edit-card label {
            display: inline-block;
            width: 100px;
            margin-bottom: 10px;
        }

    
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        textarea,
        input[type="password"] {
            width: 100%;
            box-sizing: border-box;
            padding: 5px;
            text-align: center;
        }
            textarea {
            resize: none;
        }
        input[type="submit"] {
                width: 100%;
                background-color: green; /* Update the color to green */
                color: white;
                border: none;
                padding: 10px;
                cursor: pointer;
            }
            .a{
        float: left;
        width: 40px;
        height: 20px;
        display: flex;
        position: relative;
        align-items: center;
        border-radius: 5px;
        cursor: pointer;
        justify-content: center;
        color: white;
        text-decoration: none;
        background-color: blue;
        padding: 10px;
        bottom: 20px;
        left: 20px;
        position: fixed;

    }
    .a:hover{
        background-color: #000080;
    }
    .btn:hover{
        background-color: #006400;
    }
    </style>
    
</head>
<body>
    <div class="container">
        <?php
        
        if (isset($_SESSION['LoginStaff'])) {
            $staffId = $_SESSION['LoginStaff'];
            $con = mysqli_connect("localhost", "root", "", "cms");
            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $qry = "SELECT * FROM staff WHERE id='$staffId'";
            $result = mysqli_query($con, $qry);

            if (mysqli_num_rows($result) > 0) {
                $rs = mysqli_fetch_assoc($result);
        ?>
        <div class="profile-card">
    <div class="profile-picture">
        <?php echo '<img src="' . $rs["image"] . '" alt="Profile Picture">' ?>
    </div>
    <div class="profile-details">
        <form method="POST" action="update_staf_details.php" enctype="multipart/form-data">
        <table>
                <tr>
                    <th>ID</th>
                    <td><?php echo $rs['id']; ?></td>
                </tr>
                <tr>
                <th>New Image</th>
                <td><input type="file" name="new_image" accept="image/*"></td>
            </tr>
                <tr>
                    <th>Name</th>
                    <td><input style="border:none" type="text" name="name" value="<?php echo $rs['name']; ?>"></td>
                </tr>
                <tr>
                    <th>Gender</th>
                    <td><?php echo $rs['gender']; ?></td>
                </tr>
                <tr>
                    <th>Date of Birth</th>
                    <td><?php echo $rs['dob']; ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><input style="border:none" type="email" name="email" value="<?php echo $rs['email']; ?>"></td>
                </tr>
                <tr>
                    <th>Qualification
                    </th>
                    <td><input style="border:none" type="text" name="qual" value="<?php echo strtoupper($rs['qual']); ?>"></td>
                </tr>
                <tr>
                    <th>Department</th>
                    <td><?php echo $rs['depart']; ?></td>
                </tr>
                <tr>
                    <th>Phone Number</th>
                    <td><input style="border:none" type="tel" name="phone" value="<?php echo $rs['phone']; ?>"></td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td><textarea style="border:none"  name="address"><?php echo $rs['address']; ?></textarea></td>
                </tr>
                <tr>
  <th>Password</th>
  <td class="password-field">
    <input type="password" style="border:none" name="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" value="<?php echo $rs['pass']; ?>">
    <span class="toggle-password" onclick="togglePasswordVisibility()"><i class="far fa-eye" aria-hidden="true"></i></span>
  </td>
</tr>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<script>
  function togglePasswordVisibility() {
    var passwordField = document.querySelector('input[name="pass"]');
    var toggleButton = document.querySelector('.toggle-password i');

    if (passwordField.type === 'password') {
      passwordField.type = 'text';
      toggleButton.classList.remove('fa-eye');
      toggleButton.classList.add('fa-eye-slash');
    } else {
      passwordField.type = 'password';
      toggleButton.classList.remove('fa-eye-slash');
      toggleButton.classList.add('fa-eye');
    }
  }
</script>

</tr>

            </table>
            <input type="submit" name="submit" class='btn' value="Update">
        </form>
    </div>
</div>


        <?php
            } else {
                echo "No data found for the given ID.";
            }

            mysqli_close($con);
        }
    
        ?>
    </div>
    <a href="staff_prof.php" class="a">Back</a>
</body>
</html>
