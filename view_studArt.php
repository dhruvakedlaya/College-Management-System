<?php
include 'student_dash_header.php';
?>
<!DOCTYPE html>
<html>
<head>
   
    <style>
      
        body {
            background-color: #fafafa;
            font-family: Arial, sans-serif;
            background: url(backgrounds/pxfuel.jpg);
            background-repeat: repeat;
            background-size: 1600px 1000px;
            padding: 20px;
        }

        .container {
            max-width: 700px;
            margin: 0 auto;

        }

        .article {
            background-color: #fff;
            box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .article img {
            width: 100%;
            height: 600px;
            margin-bottom: 20px;
        }

        .article-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .article-content {
            font-size: 14px;
            color: #777;
        }

        .head {
            text-align: center;
            color: rgb(13,2,2);
            margin-top:10%;
        }

        .like-icon {
            cursor: pointer;
        }

        .like-icon i {
            color: #ccc;
        }

        .like-icon.filled i {
            color: #ff0000;
        }
        h1 {

  color: black;
  padding: 20px;
  text-align: center;
  position: fixed;
  top: 80px; /* Adjust the top value as needed */
  left: 0;
  width: 100%;
  z-index: 1;
}
    </style>
</head>
<body>
<div class="head">
    <h1>Articles from Student</h1>
</div>
<div class="container">
    <?php

    $conn = mysqli_connect('localhost', 'root', '', 'cms');
    $query = "SELECT s.id, s.name, s.course, a.sno, a.image 
    FROM article a 
    JOIN student s ON s.id = a.id 
    ORDER BY a.sno DESC";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $articleId = $row['sno'];

        ?>

        <div class="article">
            <img src="<?php echo $row['image']; ?>" alt="Article Image">
            <h3 class="card-title"><?php echo $row['id']; ?></h3>
            <p class="card-description"><?php echo $row['name']; ?></p>
            <p class="card-description"><?php echo $row['course']; ?></p>

            <form method="POST" action="">
                <input type="hidden" name="articleId" value="<?php echo $articleId; ?>">
                
            </form>
        </div>

        <?php
    }

    mysqli_close($conn);
    ?>
</div>

</body>
</html>
