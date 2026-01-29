<!DOCTYPE html>
<html>
<head>
  <title>Notice....</title>
  <?php include 'student_dash_header.php'; ?>
  <style>
    body{
      overflow: hidden;
    }
    .container {
      max-width: 600px;
      margin: 0 auto;
      position: relative;
      top: 130px;
      opacity: 0.8;

    }

    h1 {
      align-items: center;
      color: white;
      /*position: relative;
      top: 100px;*/
    }

    form {
      display: flex;
      flex-direction: column;
      margin-bottom: 20px;
    }

    label {
      font-weight: bold;
      margin-bottom: 5px;
    }

    input[type=text],
    textarea {
      padding: 5px;
      margin-bottom: 10px;
      border: none;
      border-radius: 3px;
      box-shadow: 0 0 3px rgba(0, 0, 0, 0.2);
    }

    input[type=submit] {
      padding: 5px 10px;
      background-color: #4caf50;
      color: white;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    input[type=submit]:hover {
      background-color: #3e8e41;
    }

    .notice {
      margin-bottom: 20px;
      padding: 10px;
      border: 1px solid #ddd;
      background-color: #fdfff5;
      border-radius: 10px;
      word-wrap: break-word; 
    overflow-wrap: break-word;
    }

    .notice .date {
      font-style: italic;
      font-size: 0.8em;
      color: #999;
    }

    .notice::before {
      content: "Important Notice By Admin: ";
      font-weight: bold;
      color: red;
    }
    .notices{
      color: darkred;
      border: 1px solid #ddd;
      padding: 10px;
      border-radius: 10px;
      background-color: ghostwhite;
      text-align: center;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1 align="center">Notice...</h1>
    <?php

    $conn = mysqli_connect("localhost", "root", "", "cms");
    if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
    }

    $currentDate = date("Y-m-d");
    $sql = "SELECT * FROM notice WHERE date = '$currentDate' ORDER BY sno DESC";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        $date = date('F j, Y', strtotime($row['date']));
        echo "<div class='notice'>";
        echo "<p>" . $row["notice"] . "</p>";
        echo "<div class='date'>" . $date . "</div>";
        echo "</div>";
      }
    } else {
     echo "<div class='notices'>";
  echo "<p>Notice not found.</p>";
  echo "</div>";

    }

    ?>
  </div>
  
</body>
</html>
