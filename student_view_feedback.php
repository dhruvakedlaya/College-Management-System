<!DOCTYPE html>
<html>
<head>
    <title>Student Feedback</title>
    <?php include 'student_dash_header.php'; ?>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            overflow: hidden;
        }

        h1 {
            color: white;
            margin-top: 100px;

            text-align: center;
        }

        .table-container {
            width: 70%;
            margin: 0 auto;
            max-height: 470px;
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
        }

        th {
            background-color: black;
            color: #fff;
        }

        tr:hover {
            background-color: #ddd;
        }

        
        .error-message {
            text-align: center;
            color: red;
        }
        .feedback{
        width: 600px;
        white-space: normal;
/*        word-wrap: break-word;*/
        overflow-wrap: break-word;
        text-align: left;
        }
    </style>
</head>
<body>
    
    <div class="table-container">
        <h1>Student Feedback</h1>
        <table>
            <tr class="table-heading">
                
                
                <th>Date</th>
                <th>Feedback</th>
            </tr>
            <?php
            // PHP code to retrieve and display feedback
            $conn = mysqli_connect("localhost", "root", "", "cms");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            if (isset($_SESSION['LoginStudent'])) {
                $id = $_SESSION['LoginStudent'];

                $sql = "SELECT s.id, s.name, s.course, f.date, f.feedback FROM feedback f JOIN student s ON s.id=f.id WHERE f.type = 'student' AND s.id = '$id'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        
                        
                        echo "<td>" . $row['date'] . "</td>";
                        
                         echo "<td class='feedback'><div>" . $row['feedback'] . "</div></td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='error-message'>No feedback found</td></tr>";
                }
            }

            mysqli_close($conn);
            ?>
        </table>
    </div>
    
</body>
</html>
