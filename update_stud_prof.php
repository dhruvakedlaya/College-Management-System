<!DOCTYPE html>
<html>
<head>
    <title>
        Update Profile
    </title>
    <link rel="stylesheet" href="css/all.min.css">
	<link rel="stylesheet" href="css/fontawesome.min.css">
	<link rel="stylesheet" href="css/dashStyle.css">
    <?php include 'student_dash_header.php'; ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            overflow: hidden;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            margin-top:60px;
            padding: 20px;
            background-color: #EAF2F8;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            opacity:0.9;
        }

        .profile-card {
            text-align: center;
            margin-bottom: 20px;
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
    </style>
    
</head>
<body>
    <div class="container">
        <?php
        
        if (isset($_SESSION['LoginStudent'])) {
            $staffId = $_SESSION['LoginStudent'];
            $con = mysqli_connect("localhost", "root", "", "cms");
            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $qry = "SELECT * FROM student WHERE id='$staffId'";
            $result = mysqli_query($con, $qry);

            if (mysqli_num_rows($result) > 0) {
                $rs = mysqli_fetch_assoc($result);
        ?>
        <div class="profile-card">
    <div class="profile-picture">
        <?php echo '<img src="' . $rs["image"] . '" alt="Profile Picture">' ?>
    </div>
    <div class="profile-details">
        <form method="POST" action="update_stud_details.php" enctype="multipart/form-data">
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
                    <th>Qualification</th>
                    <td><?php echo $rs['course']; ?></td>
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
                <style>
  .password-field {
    position: relative;
  }

  .toggle-password {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
  }
</style>

<tr>
  <th>Password</th>
  <td class="password-field">
    <input type="password" style="border:none" name="pass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title=" 8 digit character alphabet, number,special character" value="<?php echo $rs['pass']; ?>">
    <span class="toggle-password" onclick="togglePasswordVisibility()"><i class="fa-regular fa-eye" alt="Toggle Password"></i></span>
  </td>
</tr>

<script>
  function togglePasswordVisibility() {
    var passwordField = document.querySelector('input[name="pass"]');
    var toggleButton = document.querySelector('.toggle-password');

    if (passwordField.type === 'password') {
      passwordField.type = 'text';
      toggleButton.innerHTML = '<i class="fa-regular fa-eye" alt="Toggle Password"></i>';

    } else {
      passwordField.type = 'password';
      toggleButton.innerHTML = '<i class="fa-regular fa-eye" alt="Toggle Password"></i>';
    }
  }
</script>

                </tr>
            </table>
            <input type="submit" name="submit" value="Update">
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
    
</body>
</html>
