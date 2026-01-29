<!DOCTYPE html>
<html lang="en">
<head>
    
    <style>
        body {
      font-family: Arial, sans-serif;
      margin: 0;
      background-image: url("backgrounds/examresult.jpg");
            background-repeat: no-repeat;
            background-size:cover;
            
    }
        .result-card {
              max-width: 600px;
              margin: 0 auto;
              padding: 20px;
              background-color: #e5d3ff;
              border: 1px solid #ccc;
              font-family: Arial, sans-serif;
              border: 2px solid black;
              position: relative;
              top: 60px;
}

.result-card h2 {
  text-align: center;
}

.student-info p {
  margin: 5px 0;
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  border: 2px solid black;
}

table th,
table td {
  padding: 8px;
  text-align: center;
  border: 1px solid black;
}

.total-average {
  margin-top: 20px;
}

.remarks {
  margin-top: 20px;
}
a{
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

    </style>
 
    <title>Result board</title>
</head>
<body>
<?php
             $con=mysqli_connect("localhost","root","","cms");
             if(!$con){
                 die(mysqli_err());
             }
             if(isset($_POST['btn-view'])){
              $id=$_POST['id'];
              $type=$_POST['type'];
              $qry = "SELECT student.id, student.name, marks.course, marks.s1, marks.s2, marks.s3, marks.s4, marks.s5, marks.s6, marks.total, marks.avg, marks.grade
          FROM marks
          JOIN student ON student.id = marks.id
          WHERE marks.id = '$id' AND marks.type = '$type'";
              $res=$con->query($qry);
              $row=$res->fetch_assoc();
              ?>
    <div class="result-card">
        <h2>Student Result Card</h2>
        <div class="student-info">
          <p><strong>Student Name:</strong> <?php echo $row['name']; ?></p>
          <p><strong>Student ID:</strong> <?php echo $row['id']; ?></p>
          <p><strong>Course:</strong><?php echo $row['course']; ?></p>
        </div>
        <table>
          <tr>
            <th>Subject</th>
            <th>Maximum Mark</th>
            <th>Minimum Mark</th>
            <th>Obtained Mark</th>
          </tr>
          
          <?php
        
              echo"<tr>";
              echo"<td> subject 1 </td>";
              echo"<td>100</td>";
              echo"<td>35</td>";
              echo"<td>".$row['s1']."</td>";
              echo"</tr>";

              echo"<tr>";
              echo"<td> subject 2 </td>";
              echo"<td>100</td>";
              echo"<td>35</td>";
              echo"<td>".$row['s2']."</td>";
              echo"</tr>";

              echo"<tr>";
              echo"<td> subject 3 </td>";
              echo"<td>100</td>";
              echo"<td>35</td>";
              echo"<td>".$row['s3']."</td>";
              echo"</tr>";

              echo"<tr>";
              echo"<td> subject 4 </td>";
              echo"<td>100</td>";
              echo"<td>35</td>";
              echo"<td>".$row['s4']."</td>";
              echo"</tr>";

              echo"<tr>";
              echo"<td> subject 5 </td>";
              echo"<td>100</td>";
              echo"<td>35</td>";
              echo"<td>".$row['s5']."</td>";
              echo"</tr>";

              echo"<tr>";
              echo"<td> subject 6 </td>";
              echo"<td>100</td>";
              echo"<td>35</td>";
              echo"<td>".$row['s6']."</td>";
              echo"</tr>";
             }


          ?>
        </table>
        <div class="total-average">
          <p><strong>Total:</strong><?php echo $row['total'];?></p>
          <p><strong>Average:</strong><?php echo $row['avg'];?></p>
          <p><strong>Grade:</strong><?php echo $row['grade'];?></p>
          
        </div>
  
      </div>
      <a href='view_Acourse.php'>Back</a>
      
</body>
</html>