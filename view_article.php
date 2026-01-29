<?php
session_start();
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
            color: white;
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
        .btn {
  background-color: blue;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  position: fixed;
  top: 20px;
  right: 20px;
  z-index: 9999;
  text-decoration:none;
}

.btn:hover {
  background-color: darkblue;
}
h1 {
  background-color: #333;
  color: #fff;
  padding: 20px;
  text-align: center;
  position: fixed;
  top: -25px; /* Adjust the top value as needed */
  left: 0;
  width: 100%;
  z-index: 9999;
}



    </style>
</head>
<body>
<div class="head">
    <h1>Articles from Student</h1>
    <a href="admin_dash.php" class='btn'>BACK</a>
</div>
<div class="container">
    <?php

    $conn = mysqli_connect('localhost', 'root', '', 'cms');
    $query = "SELECT s.id, s.name, s.course, a.sno, a.image 
    FROM article a 
    JOIN student s ON s.id = a.id 
    ORDER BY a.sno DESC";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $articleId = $row['sno'];
    
            ?>

            <div class="article">
                <img src="<?php echo $row['image']; ?>" alt="Article Image">
                <h3 class="card-title"><?php echo $row['id']; ?></h3>
                <p class="card-description"><?php echo $row['name']; ?></p>
                <p class="card-description"><?php echo $row['course']; ?></p>

            </div>

        <?php
        }
    } else {
        echo "<script>alert('No articles found'); window.location.href='admin_dash.php';</script>";
        exit;
    }

    mysqli_close($conn);
    ?>
</div>

</body>
</html>
