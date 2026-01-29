 <?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Details</title>
    <style>
        body{
            background-image: url(staff1.jpg);
            background-repeat: no-repeat;
            overflow: hidden;
            background-size: cover;
            height: 100vh;
        }
        .table-container {
            width: 100%;
            margin: 0 auto;
            max-height: 540px;
            overflow: auto;
            border-radius: 20px;
            background-color: rgba(255, 255, 255, 0.8);
        }

        table {
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.3);
            background-color: transparent;
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

        .back-button {
            margin-top: 20px;
            background-color: blue;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 50px;
            text-decoration: none;
            display: flex;
            position: fixed;
            bottom: 20px;
            left: 20px;
            align-items: center;
            justify-content: center;
        }

        .back-button:hover {
            background-color: #3e8e41;
        }
        
        .a {
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

        .a:hover {
            background-color: #3e8e41;
        }
        .popup {
            display: none;
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
        }

        .popup-content {
            background-color: #fefefe;
            margin: 100px auto;
            padding: 20px;
            border: 1px solid #888;
            width: 40%;
            max-width: 400px;
            position: relative;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: black;
        }

        .content-table .R {
            width: 100px;
            height: 30px;
            background-color: #4CAF50;
            color: white;
            border-radius: 10px;
        }

        .content-table .R:hover {
            background-color: #3e8e41;
        }

        .content-table .G {
            width: 100px;
            height: 30px;
            background-color: red;
            color: white;
            border-radius: 10px;
        }

        .content-table .G:hover {
            background-color: blue;
        }
        .R{
            background-color: blue;
            padding: 10px;
            color: white;   
            border-radius: 5px;
            width: 100px;
        }
        .G{
            background-color: red;
            padding: 10px 10px;
            color: white;   
            border-radius: 5px;
            width: 70px;
        }
        a.button {
          display: inline-block;
          padding: 10px 10px;
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
    <h1 align="center">Staff Details</h1>
    <div class="table-container">
        <table>
            <thead>
                <tr class="table-heading">
                    <th>Id</th>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Date of Birth</th>
                    <th>Gender</th>
                    <th>Email</th>
                    <th>Qualification</th>
                    <th>Department</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Password</th>
                    
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
               <?php
                $con = mysqli_connect("localhost", "root", "", "cms");
                if (!$con) {
                    die(mysqli_error($con));
                }
                $qry = "SELECT * FROM staff WHERE status='available'";
                $res = $con->query($qry);
                if ($res) {
                    $nob = $res->num_rows;
                    for ($i = 0; $i < $nob; $i++) {
                        $r = $res->fetch_assoc();
                        $usr = $r['id'];
                        ?>
                        <tr>
                            <td><?php echo $r['id']; ?></td>
                            <td><?php echo '<img src="' . $r["image"] . '" height="100px" width="100px">' ?></td>
                            <td><?php echo $r['name']; ?></td>
                            <td><?php echo $r['dob']; ?></td>
                            <td><?php echo $r['gender']; ?></td>
                            <td><?php echo $r['email']; ?></td>
                            <td><?php echo $r['qual']; ?></td>
                            <td><?php echo $r['depart'];?></td>
                            <td><?php echo $r['phone']; ?></td>
                            <td><?php echo $r['address']; ?></td>
                            <td><?php echo $r['pass']; ?></td>
                            <td>
                                <a href="A_updatestaf.php?upt=<?php echo $usr; ?>" class="button">Update</a>
                            </td>
                            <td>
                                <form action="delete.php" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $r['id']; ?>">
                                    <input type="submit" class="G" name="btn-delete" value="DELETE">
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                }
                else {
                    echo "<script>alert('No records found');</script>";
                    echo "<script>window.location.href='admin_staff.php';</script>";
                    exit;
                }
                mysqli_close($con);
                ?>
            </tbody>
        </table>
    </div>
    <br>
    <a href="admin_staff.php" class="back-button">Back</a>
 
    <div id="popup" class="popup">
        <div class="popup-content">
            <span class="close" onclick="closePopup()">&times;</span>
            <h2>Edit Staff Details</h2>
            <form action="update_staff.php" method="POST">
                <input type="hidden" id="edit-id" name="id" value="">
                <label for="edit-name">Name:</label>
                <input type="text" id="edit-name" name="name" required><br><br>
                <label for="edit-dob">Date of Birth:</label>
                <input type="date" id="edit-dob" name="dob" required><br><br>
                <label for="edit-qualification">Qualification:</label>
                <input type="text" id="edit-qualification" name="qualification" required><br><br>
                <label for="edit-email">Email:</label>
                <input type="email" id="edit-email" name="email" required><br><br>
                <label for="edit-phone">Phone Number:</label>
                <input type="tel" id="edit-phone" name="phone" required><br><br>
                <label for="edit-address">Address:</label>
                <input type="text" id="edit-address" name="address" required><br><br>
                <input type="submit" value="Update">
            </form>
        </div>
    </div>

</body>
</html>
 