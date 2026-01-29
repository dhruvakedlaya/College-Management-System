<!DOCTYPE html>
<html>
<head>
  <title>Course Navigation</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      background-image: url("backgrounds/examresult.jpg");
            background-repeat: no-repeat;
            background-size:cover;
            
    }

    .navbar {
      background-color: #f9f9f9;
      padding: 10px;
    }
    ul{
      color: white;
    }
    .navbar ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: space-around;
      background-color: black;
     
      border-radius: 50px;
    }


    .navbar li {
      margin-right: 10px;
    }

    .navbar a {
      display: block;
      padding: 8px 16px;
      text-decoration: none;
      color: white;
    }

    .navbar a:hover {
      background-color: blue;
      border-radius: 50px;
      

    }

    .active {
      background-color: #ccc;
    }

    .content {
      margin-top: 20px;
      padding: 20px;
      text-align: center;
      justify-content: center;
    }

    .table-container {
      width: 95%;
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
    .view-button{
      background-color: blue;
      color: white;
      width: 70px;
      height: 40px;
      border-radius: 5px;
    }
    .view-button:hover{
      background-color: green;
    }
    .error-message {
      color: red;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="navbar">
    <h1 align="center"> Student Marks Report</h1>
    <ul>

      <?php
        $con = mysqli_connect("localhost", "root", "", "cms"); 
        if (!$con) {
          die(mysqli_error());
        }

        
        $query = "SELECT * FROM course";
        $result = mysqli_query($con, $query);

        while ($row = mysqli_fetch_assoc($result)) {
          $courseId = $row['sno'];
          $courseName = $row['cname'];
          echo '<li><a href="?course_name='.urlencode($courseName).'">'.$courseName.'</a></li>';
        }
      ?>
    </ul>
  </div>
  <div class="content">
  <?php
      if (isset($_GET['course_name'])) {
        $selectedCourseName = urldecode($_GET['course_name']);

        // Database connection and other code here

        echo '<h2 class="center">Students Marks of '.$selectedCourseName.'</h2>';
        echo '<div class="table-container">';
        echo '<table>';
        echo '<thead class="table-heading">';
        echo '<tr>
                <th>Student Id</th>
                <th>Student Name</th>
                <th>Internal</th>
                <th>Subject 1</th>
                <th>Subject 2</th>
                <th>Subject 3</th>
                <th>Subject 4</th>
                <th>Subject 5</th>
                <th>Subject 6</th>
                <th>Total</th>
                <th>Average</th>
                <th>Grade</th>
                <th>View Report</th>
              </tr>
              </thead>';

        // Retrieve student name and marks using a JOIN query
        $query = "SELECT student.id, student.name, marks.type, marks.s1, marks.s2, marks.s3, marks.s4, marks.s5, marks.s6, marks.total, marks.avg, marks.grade
                  FROM marks
                  JOIN student ON student.id = marks.id
                  WHERE marks.course = '".mysqli_real_escape_string($con, $selectedCourseName)."' AND student.status='available'";
        $resultStudent = mysqli_query($con, $query);

        $numRows = mysqli_num_rows($resultStudent);

        if ($numRows > 0) {
          while ($rowStudent = mysqli_fetch_assoc($resultStudent)) {
            $studid=$rowStudent['id'];
            $studentName = $rowStudent['name'];
            $tp=$rowStudent['type'];
            $s1 = $rowStudent['s1'];
            $s2 = $rowStudent['s2'];
            $s3 = $rowStudent['s3'];
            $s4 = $rowStudent['s4'];
            $s5 = $rowStudent['s5'];
            $s6 = $rowStudent['s6'];
            $total = $rowStudent['total'];
            $avg = $rowStudent['avg'];
            $grade = $rowStudent['grade'];

            echo '<tr>';
            echo '<td>'.$studid.'</td>';
            echo '<td>'.$studentName.'</td>';
            echo '<td>'.$tp.'</td>';
            echo '<td>'.$s1.'</td>';
            echo '<td>'.$s2.'</td>';
            echo '<td>'.$s3.'</td>';
            echo '<td>'.$s4.'</td>';
            echo '<td>'.$s5.'</td>';
            echo '<td>'.$s6.'</td>';
            echo '<td>'.$total.'</td>';
            echo '<td>'.$avg.'</td>';
            echo '<td>'.$grade.'</td>';
            echo '<td>';
            ?>
            <form action="view_Amark.php" method="POST">
              <input type="hidden" name="id" value="<?php echo $studid; ?>">
              <input type="hidden" name="type" value="<?php echo $tp; ?>">
              <input type="submit" class="view-button" name="btn-view" value="view">
            </form>
            <?php
            echo '</td>';
            echo '</tr>';
          }
        } else {
          echo '<tr>';
          echo '<td colspan="13" class="error-message">Internal is not conducted</td>';
          echo '</tr>';
        }

        echo '</table>';
        echo '</div>';
      }
    ?>
  </div>
  <a class="a" href="admin_student.php">Back</a>
</body>
</html>
