
<!DOCTYPE html>
<html>
<head>
    <title>
        profile
    </title><?php include 'student_dash_header.php'; ?>
    <link rel="stylesheet" href="css/all.min.css">
	<link rel="stylesheet" href="css/fontawesome.min.css">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            overflow:hidden;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            margin-top:90px;
            padding: 20px;
            background-color: #EAF2F8;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            opacity: 0.9;
        }

        .profile-card {
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
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

        .edit-card input[type="text"],
        .edit-card input[type="email"],
        .edit-card input[type="tel"],
        .edit-card textarea {
            width: 200px;
            padding: 5px;
            margin-bottom: 10px;
        }

        .edit-card input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
        }
        input [type="button"]{
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
                <table>
                    <tr>
                        <th>ID</th>
                        <td><?php echo $rs['id']; ?></td>
                    </tr>
                    <tr>
                        <th>Name</th>
                        <td><?php echo $rs['name']; ?></td>
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
                        <td><?php echo $rs['email']; ?></td>
                    </tr>
                    <tr>
                        <th>Qualification</th>
                        <td><?php echo $rs['course']; ?></td>
                    </tr>
                    <tr>
                        <th>Phone Number</th>
                        <td><?php echo $rs['phone']; ?></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><?php echo $rs['address']; ?></td>
                    </tr>

                    <tr>
  <th>Address</th>
  <td><?php echo $rs['address']; ?></td>
</tr>
<tr>
  <th>Password</th>
  <td class="password-field">
    <span class="password" data-password="<?php echo $rs['pass']; ?>">********</span>
    <span class="toggle-password" onclick="togglePasswordVisibility()"><i class="far fa-eye" aria-hidden="true"></i></span>
  </td>
</tr>



<script>
  function togglePasswordVisibility() {
    var passwordField = document.querySelector('.password-field');
    var password = passwordField.querySelector('.password');
    var toggleButton = document.querySelector('.toggle-password i');

    if (password.classList.contains('show-password')) {
      password.classList.remove('show-password');
      toggleButton.classList.remove('fa-eye-slash');
      toggleButton.classList.add('fa-eye');
      password.innerHTML = "********";
    } else {
      password.classList.add('show-password');
      toggleButton.classList.remove('fa-eye');
      toggleButton.classList.add('fa-eye-slash');
      password.innerHTML = password.getAttribute('data-password');
    }
  }
</script>

          </table>
            </div>
        </div>
    
                <!-- <input type="button" value="Edit" onclick="window.location.href='update_stud_prof.php'"> -->
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
