<?php
$con = mysqli_connect("localhost", "root", "", "cms");
if (!$con) {
    die(mysqli_err());
}
$qry = "SELECT * FROM student";
$res = $con->query($qry);
$nob = $res->num_rows;
if ($nob > 0) {
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/all.min.css">
	<link rel="stylesheet" href="css/fontawesome.min.css">
    <title>Student Details</title>
    <style type="text/css">
        body{
            background-image: url("backgrounds/student.avif");
            background-repeat: no-repeat;
            background-size:cover;
            
        }
        .table-container {
            width: 100%;
            margin: 0 auto;
            max-height: 540px;
            overflow: auto;
            border-radius: 20px;
            opacity:0.9;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
        }

        th,
        td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .table-heading {
            position: sticky;
            top: 0;
            background-color: black;
            color: #fff;
            z-index: 1;
        }

        th {
            background-color: black;
            color: #fff;
        }

        tr:hover {
            background-color: #ddd;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: red;
            color: white;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
            border-radius:5px;
        }
        .button:hover {
        background-color: darkred;
    }


        .back-button {
            margin-top: 20px;
            background-color: blue;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 90px;
            text-decoration: none;
            display: flex;
            position: fixed;
            bottom: 20px;
            right: 20px;
            align-items: center;
            justify-content: center;
        }

        .back-button:hover {
            background-color: #3e8e41;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }
        a.button {
  display: inline-block;
  padding: 10px 20px;
  background-color: blue;
  color: white;
  text-decoration: none;
  text-align: center;
  cursor: pointer;
  border-radius:5px;
}

a.button:hover {
  background-color: darkblue;
}

a.button:active {
  background-color: navy;
}
    </style>
</head>
<body>
    <h1 align="center">Student Details</h1>

    <div class="table-container">
        <table>
            <thead class="table-heading">
                <tr>
                    <th>Roll number</th>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Father</th>
                    <th>Mother</th>
                    <th>Email</th>
                    <th>Phone no.</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>10th%</th>
                    <th>PUC%</th>
                    <th>Course</th>
                    <th>Address</th>
                    <th>Password</th>
                    <th>Status</th>
                    <th colspan=2>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $conn = mysqli_connect("localhost", "root", "", "cms");
                if (!$conn) {
                    die('Failed to connect to the database: ' . mysqli_connect_error());
                }

                $sql = "SELECT * FROM student where status='available'";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    die('Failed to retrieve student data: ' . mysqli_error($conn));
                }

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<tr>';
                    echo '<td>' . $row['id'] . '</td>';
                    echo '<td><img src="' . $row["image"] . '" height="100px" width="100px"></td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['fname'] . '</td>';
                    echo '<td>' . $row['mname'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['phone'] . '</td>';
                    echo '<td>' . $row['dob'] . '</td>';
                    echo '<td>' . $row['gender'] . '</td>';
                    echo '<td>' . $row['tenth'] . '</td>';
                    echo '<td>' . $row['twlth'] . '</td>';
                    echo '<td>' . $row['course'] . '</td>';
                    echo '<td>' . $row['address'] . '</td>';
                    echo '<td>' . $row['pass'] . '</td>';
                    echo '<td>' . $row['status'] . '</td>';
                    echo '<td>';
                    echo '<a class="button" href="A_updatestud.php?upt='.$row['id'].'" class="b1"><i class="fa-solid fa-pen-to-square"></i></a>';
                    echo '<td>
    <form action="delete.php" method="POST">
        <input type="hidden" name="id" value="' . $row['id'] . '"/>
        <button type="submit" class="button" name="btn-delete-stud">
            <i class="fas fa-trash"></i>
        </button>
    </form>
</td>';

                    echo '</td>';
                    echo '</tr>';
                }

                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>

    <a class="back-button" href="admin_student.php">Back</a>

    
</body>
</html>

<?php
} else {
    
    echo "<script>alert('No Student Data Found'); window.location.href='admin_student.php';</script>";
}

mysqli_close($con);
?>
