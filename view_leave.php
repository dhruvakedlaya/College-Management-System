<?php
$con = mysqli_connect("localhost", "root", "", "cms");
if (!$con) {
    die(mysqli_error());
}

$qry = "SELECT s.id, s.name, s.depart, l.leave_id, l.type, l.date, l.num, l.reason, l.status FROM staff_leave l JOIN staff s ON s.id=l.id ";
$res = $con->query($qry);
$nob = $res->num_rows;

if ($nob > 0) {
    ?>

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
                width: 90px;
                text-decoration: none;
                display: flex;
                position: fixed;
                bottom: 50px;
                left: 50px;
                align-items: center;
                justify-content: center;
            }

            .back-button:hover {
                background-color: #3e8e41;
            }

            .R{
                width: 90px;
                padding: 10px;
                background-color: green;
                border-radius: 5px;
                color: white;

            }
            .G{
                width: 90px;
                padding: 10px;
                background-color: red;
                border-radius: 5px;
                color: white;
            }
        </style>
    </head>
    <body>
        <div class="table-container">
            <h1 align="center">Staff Leave Details</h1>
            <table>
                <thead>
                    <tr class="table-heading">
                        <th>Staff ID</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Leave Type</th>
                        <th>Date</th>
                        <th>No. of Days</th>
                        <th>Reason</th>
                        <th>Status</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($r = $res->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$r['id']."</td>";
                        echo "<td>".$r['name']."</td>";
                        echo "<td>".$r['depart']."</td>";
                        echo "<td>".$r['type']."</td>";
                        echo "<td>".$r['date']."</td>";
                        echo "<td>".$r['num']."</td>";
                        echo "<td>".$r['reason']."</td>";
                        echo "<td>".$r['status']."</td>";
                        echo "<td>
                                <form method='POST' action='update_status.php'>
                                    <input type='hidden' name='leave_id' value='".$r['leave_id']."'>
                                    <input type='hidden' name='status' value='approved'>
                                    <button class='R' type='submit' name='submit'>Approve</button>
                                </form>
                            </td>";
                        echo "<td>
                                <form method='POST' action='update_status.php'>
                                    <input type='hidden' name='leave_id' value='".$r['leave_id']."'>
                                    <input type='hidden' name='status' value='rejected'>
                                    <button class='G' type='submit' name='submit'>Reject</button>
                                </form>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <a class="back-button" href="admin_staff.php">Back</a>

    </body>
    </html>

<?php
} else {
    echo "<script>alert('No staff leave records found'); window.location.href='admin_staff.php';</script>";
    exit;
}
?>

