<!DOCTYPE html>
<html>
<head>
    <title>Staff Leave Details</title>
    <style>
          body {
            font-family: Arial, sans-serif;
            background:url("backgrounds/leave.jpg");
      background-repeat: no-repeat;
            overflow: hidden;
            background-size: cover;
            height: 100vh;

        }
    .table-container {
        width: 95%;
        margin: 0 auto;
        max-height: 540px;
        overflow: auto;
        border-radius: 20px;
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
        border-radius: 10px;
    }

    th {
        background-color: black;
        color: #fff;
    }

    tr:hover {
        background-color: #ddd;
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
        background-color: #000080;
    }
    </style>
</head>
<body>
    <?php
    session_start();
    if(isset($_SESSION['LoginStaff']))
    {
        $username = $_SESSION['LoginStaff'];
    }
    else
    {
        header('Location: login.php');
    }
    $con = mysqli_connect("localhost", "root", "", "cms");
    if (!$con) {
        die(mysqli_error());
    }

    $qry = "SELECT s.id, s.name, s.depart ,l.type, l.date, l.num, l.reason, l.status FROM staff_leave l JOIN staff s ON s.id=l.id where l.id='$username'";
    $res = $con->query($qry);
    $nob = $res->num_rows;

    if ($nob > 0) {
    ?>
    <h1 align="center">Staff Leave Details</h1>
    <div class="table-container">
        <table class="content-table">
            <thead>
                <tr>
                    
                    <th>Leave Type</th>
                    <th>Date</th>
                    <th>No. of Days</th>
                    <th>Reason</th>
                    <th>Status</th>
                    <th>Available Leave</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($i = 0; $i < $nob; $i++) {
                    $r = $res->fetch_assoc();
                    ?>
                    <tr>
                        
                        <td><?php echo $r['type']; ?></td>
                        <td><?php echo $r['date']; ?></td>
                        <td><?php echo $r['num']; ?></td>
                        <td><?php echo $r['reason']; ?></td>
                        <td><?php echo $r['status']; ?></td>
                        <td>
                            <?php
                            // Retrieve available leave from the staff table
                            $staffId = $r['id'];
                            $staffQuery = "SELECT total_leave FROM staff WHERE id='$staffId'";
                            $staffResult = $con->query($staffQuery);
                            if ($staffResult && $staffResult->num_rows > 0) {
                                $staffData = $staffResult->fetch_assoc();
                                $availableLeave = $staffData['total_leave'];
                                echo $availableLeave;
                            } else {
                                echo "N/A";
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>

   
    <a href="stf_leave.php" class="a">Back</a>

    <?php
    } else {
        echo "<script>alert('No leave application found');</script>";
        echo "<script>window.location.href='stf_leave.php';</script>";
    }
    ?>
</body>
</html>
