<!DOCTYPE html>
<html>
<head>
    <title>Feedback of Staff</title>
    <style>
   body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background:url("backgrounds/feedback.jpg");
      background-size: cover;   

        }

        h1 {
            color: black;
            margin-top: 40px;
            text-align: center;
        }

        .table-container {
            width: 80%;
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

        td.feedback {
            word-break: break-word;
            width: 800px;
        }
    </style>
</head>
<body>
    <h1>Feedback of Staff</h1>
    <div class="table-container">
        <table>
            <tr>
                
                <th class="table-heading">Date</th>
                <th class="table-heading">Feedback</th>
            </tr>
            <?php
            session_start();
            // PHP code to retrieve and display feedback
            $conn = mysqli_connect("localhost", "root", "", "cms");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            if(isset($_SESSION['LoginStaff'])) {
                $id = $_SESSION['LoginStaff'];

                $sql = "SELECT s.id, s.name, s.depart, f.date, f.feedback FROM feedback f JOIN staff s ON s.id=f.id WHERE f.type = 'staff' AND s.id = '$id'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                       
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td class='feedback'>" . $row['feedback'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<script>alert('No feedback found'); window.location.href='stf_feedback.php';</script>";

                }
            }

            mysqli_close($conn);
            ?>
        </table>
    </div>
    <a href="stf_feedback.php" class="a">Back</a>
    </body>
</html>
