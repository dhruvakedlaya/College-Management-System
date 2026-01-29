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


?>
<!DOCTYPE html>
<html lang="en">
<head>
   
    <title>My queries</title>
    <style>

    .table-container {
        width: 95%;
        margin: 0 auto;
        max-height: 540px;
        top: 70px;
        position: relative;
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
    td:nth-child(4) {
      max-width: 400px;
      word-wrap: break-word;
      overflow-wrap: break-word;
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
        bottom: 20px;
        right: 20px;
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

        </style>
</head>
<body>
<div class="table-container">
    <h1 align="center" style="color: white;">Queries</h1>
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
            
            $query = "SELECT * FROM query WHERE id = '$username'";
            $result = $con->query($query);

            while ($row = $result->fetch_assoc()) {
                $type = $row['type'];
                $queryText = $row['query'];
                $date = $row['date'];
                $response = $row['response'];

                echo "<tr>";
                echo "<td>$type</td>";
                echo "<td>$queryText</td>";
                echo "<td>$date</td>";
                echo "<td>$response</td>";
                echo "</tr>";
            }
            ?>

        </tbody>
</table>
        </div>

</body>
</html>