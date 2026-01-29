

<!DOCTYPE html>
<html>
<head>
  <title>Course List</title>
  <style>
   body {
            font-family: Arial, sans-serif;
            background:url("backgrounds/course.jpg");
      background-size: cover;   

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
        background-color: #ccc;
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
    .action-buttons{

    }
    td{
        padding: 30px;
    } 
    .add_button{
      width: 60px;
      height: 30px;
      background-color: darkgreen;
      padding: 10px;
      text-decoration: none;
      color: white;
      border-radius: 10px;
/*      border: 2px solid black;*/
  border: none;
    }
    .add_button:hover{
      background-color: blue;
    }
    .description {
    width: 700px;
}
.descriptions {
    width: 600px;
}
  </style>
</head>
<body>
  <h1 align="center">Course Details</h1>

  <table>
    <?php
    $con = mysqli_connect("localhost", "root", "", "cms");
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $showNotAvailable = isset($_GET['showNotAvailable']) && $_GET['showNotAvailable'] === "true";
    
    if ($showNotAvailable) {
      echo'<thead class="table-heading">
    <tr>
      <th>Name</th>
      <th>Full name</th>
      <th>Fees</th>
      <th>Description</th>
      <th>Status</th>
      <th>Update</th>
    </tr>
  </thead>';
        
        $query = "SELECT * FROM course where status='Not Available'";
        $result = mysqli_query($con, $query);
        
        if (mysqli_num_rows($result) > 0) {
          echo '<tbody>';
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$row['cname']."</td>";
            echo "<td>".$row['full']."</td>";
            echo "<td>".$row['fees']."</td>";
            echo '<td class="descriptions">'.$row['des']."</td>";
            echo "<td>".$row['status']."</td>";
            echo'<td>
                  <a href="A_updatcourse.php?upt='.$row['sno'].'" class="add_button">Add_Back</a></td>';
            echo "</tr>";
          }
          echo '</tbody>';
        } else {
          echo '<tbody>';
          echo '<tr><td colspan="6">No not available courses.</td></tr>';
          echo '</tbody>';
        }
    } else {
      echo'<thead class="table-heading">
    <tr>
      <th>Name</th>
      <th>Full name</th>
      <th>Fees</th>
      <th>Description</th>
      <th>Status</th>
    </tr>
  </thead>';
        $query = "SELECT * FROM course WHERE status = 'available'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
          echo '<tbody>';
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>".$row['cname']."</td>";
            echo "<td>".$row['full']."</td>";
            echo "<td>".$row['fees']."</td>";
           echo '<td class="description">'.$row['des']."</td>";
            echo "<td>".$row['status']."</td>";
            echo "</tr>";
          }
          echo '</tbody>';
        } else {
          echo '<tbody>';
          echo '<tr><td colspan="5">No available courses.</td></tr>';
          echo '</tbody>';
        }
    }

    mysqli_close($con);
    ?>
  </table>

  <a href="admin_dash.php" class="a">Back</a>
  <?php
    $toggleButtonLabel = $showNotAvailable ? "Hide Not Available" : "Show Not Available";
    $toggleButtonUrl = $showNotAvailable ? "view_course_qu.php" : "view_course_qu.php?showNotAvailable=true";
  ?>

  <a href="<?php echo $toggleButtonUrl; ?>" class="back-button"><?php echo $toggleButtonLabel; ?></a>
</body>
</html> 
