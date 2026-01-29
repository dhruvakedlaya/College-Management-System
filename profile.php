<!Doctype html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table td, table th {
            padding: 10px;
            border: 1px solid #ccc;
        }

        table th {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        session_start();
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
        <h1>My Profile</h1>
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
                <th>Profile</th>
                <td><?php echo '<img src="' . $rs["prof"] . '" height="100px" width="100px">' ?></td>
            </tr>
            <tr>
                <th>Gender</th>
                <td><?php echo $rs['gn']; ?></td>
            </tr>
            <tr>
                <th>Date of Birth</th>
                <td><?php echo $rs['db']; ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $rs['eid']; ?></td>
            </tr>
            <tr>
                <th>Qualification</th>
                <td><?php echo $rs['qual']; ?></td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td><?php echo $rs['num']; ?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><?php echo $rs['adr']; ?></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><?php echo $rs['pass']; ?></td>
            </tr>
        </table>
        <?php
            } else {
                echo "No data found for the given ID.";
            }

            mysqli_close($con);
        } else {
            echo "Please login to view your profile.";
        }
        ?>
    </div>
    <form method="POST" action="waste1.php">
        <input type="submit" name="view" value="Edit">
    </form>
</body>
</html>
