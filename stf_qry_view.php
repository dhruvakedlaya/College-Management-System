<?php
session_start();
if (isset($_SESSION['LoginStaff'])) {
    $username = $_SESSION['LoginStaff'];
} else {
    header('Location: index.php');
}
$con = mysqli_connect("localhost", "root", "", "cms");
if (!$con) {
    die(mysqli_error());
}
$sql = "SELECT depart, image from staff where id='$username'";
$reslt = $con->query($sql);
$row = $reslt->fetch_assoc();
$department = $row['depart']; 
$img = $row['image'];
$_SESSION['department'] = $department;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Query View</title>
    <style> body{
            background-image: url("backgrounds/5274051.jpg");
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
            position: sticky;
            top: 0;
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
            background-color: #3e8e41;
        }
        
        td.query,
        td.response {
            word-break: break-word;
            max-width: 200px;
        }
        
        .reply-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: blue;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.2s ease-in-out;
        }

        .reply-button:hover {
            background-color: #3e8e41;
        }
    </style>
</head>
<body>
     <h1 align="center">Student Query</h1>
<div class="table-container">
    <?php
    $qry = "SELECT student.id, student.name, student.status, query.response, query.qid, query.date, query.type, query.query 
        FROM query JOIN student ON student.id=query.id 
        WHERE student.status='available' AND student.course='$department'
        ORDER BY query.qid DESC";
    $res = $con->query($qry);
    if ($res->num_rows > 0) {
        ?>
       
        <table>
            <thead>
            <tr class="table-heading">
                <th>ID</th>
                <th>Name</th>
                <th>Internal</th>
                <th>Date</th>
                <th>Query</th>
                <th>Action</th>
                <th>Response</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($res)) {
                echo "<tr>";
                echo "<td>".$row['id']."</td>";
                echo "<td>".$row['name']."</td>";
                echo "<td>".$row['type']."</td>";
                echo "<td>".$row['date']."</td>";
                echo "<td class='query'>".$row['query']."</td>";
                echo '<td><a href="response.php?pu='.$row['qid'].'" class="reply-button">Reply</a></td>';
                echo "<td class='response'>".$row['response']."</td>";
                echo "</tr>";
            }
            ?>
            </tbody>
        </table>
        <?php
    } else {
        echo "<script>alert('No queries found');</script>";
        echo "<script>window.location.href='add_marks.php';</script>";
    }
    $con->close();
    ?>
</div>

<a href="add_marks.php" class="a">Back</a>
</body>
</html>
