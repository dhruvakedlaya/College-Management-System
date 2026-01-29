<?php
    include 'student_dash_header.php';
    if (isset($_SESSION['LoginStudent'])) {
        $username = $_SESSION['LoginStudent'];
    } else {
        header('Location: index.php');
    }
    $con = mysqli_connect("localhost", "root", "", "cms");
    if (!$con) {
        die(mysqli_error());
    }

    $sql = "SELECT query FROM student WHERE id='$username'";
    $reslt = $con->query($sql);
    $row = $reslt->fetch_assoc();
    $department = $row['course']; // Change the department based on the logged-in staff

    $_SESSION['department'] = $department;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>My queries</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Type</th>
                <th>Query</th>
                <th>Date</th>
                <th>Response</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Fetch and display student queries from the database
                $query = "SELECT * FROM queries WHERE student_id = '$username'";
                $result = $con->query($query);

                while ($row = $result->fetch_assoc()) {
                    $type = $row['type'];
                    $query = $row['query'];
                    $date = $row['date'];
                    $response = $row['response'];

                    echo "<tr>";
                    echo "<td>$type</td>";
                    echo "<td>$query</td>";
                    echo "<td>$date</td>";
                    echo "<td>$response</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</body>
</html>
