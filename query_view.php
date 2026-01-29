<!-- 
<!DOCTYPE html>
<html lang="en">
<head>
    <title>View Queries</title>
    <style>
        .table-container{
            width:95%;
            margin:0 auto;
            max-height:540px;
            border-radius:20px;
        }
        table{
            border-collapse:collapse;
            width:100px;
            background-color:#fff;
            box-shadow:0 2px 5px;
        }
        th,tr{
            padding:10px;
            text-align:center;
            border-bottem:1px solid #ddd;
        }
        .table-heading tr{
            position:sticky;
            top:0;
            background-color:black;
            color:white;
            Z-index:1;

        }
    </style>
</head>
<body>
    <div class="table-container">
        <h1 align="center>Query</h1>
        <table>
            <thread>
                <tr class="table-heading">
                    <th>roll no</th>
                    <th>name</th>
                    <th>course</th>
                    <th>Internals</th>
                    <th>query</th>
                </tr>
            <thread>
            <tbody>
             <?php
                $con = mysqli_connect("localhost", "root", "", "cms");
                if (!$con) {
                    die(mysqli_error($con));
                }
                $qry = "SELECT * FROM query";
                $result = mysqli_query($con, $qry);
                if (!$result) {
                    die('Failed to retrieve student data: ' . mysqli_error($conn));
                }
                while($row=mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>" .$row['id'] ."</td>";
                    echo "<td>" .$row['name'] ."</td>";
                    echo "<td>" .$row['course'] ."</td>";
                    echo "<td>" .$row['type'] ."</td>";
                    echo "<td>" .$row['query'] ."</td>";
                    echo "</tr>";
                }
                mysqli_close($con);
                ?>
            </tbody>

    </div>

</body>
</html> -->











<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff Details</title>
    <style>
        * {
            font-family: sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            text-align: center;
            justify-content: center;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
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
    </style>
</head>
<body>
    <h1 align="center">Staff Details</h1>
    <table class="content-table">
        <thead>
          <tr>
          <th>roll no</th>
                    <th>name</th>
                    <th>course</th>
                    <th>Internals</th>
                    <th>query</th>
            
        </thead>
        <tbody>
        <?php
                $con = mysqli_connect("localhost", "root", "", "cms");
                if (!$con) {
                    die(mysqli_error($con));
                }
                $qry = "SELECT * FROM query";
                $result = mysqli_query($con, $qry);
                if (!$result) {
                    die('Failed to retrieve student data: ' . mysqli_error($conn));
                }
                while($row=mysqli_fetch_assoc($result)){
                    echo "<tr>";
                    echo "<td>" .$row['id'] ."</td>";
                    echo "<td>" .$row['name'] ."</td>";
                    echo "<td>" .$row['course'] ."</td>";
                    echo "<td>" .$row['type'] ."</td>";
                    echo "<td>" .$row['query'] ."</td>";
                    echo "</tr>";
                }
                mysqli_close($con);
                ?>
        </tbody>
    </table>
    <br>
    <a href="admin_dash.php">Back</a> 

            </body>
            </html>