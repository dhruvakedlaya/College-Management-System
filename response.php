<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Response Form</title>
    <style>
        body {
            background-color: rgb(248, 247, 249);
        }

        .container {
            position: relative;
            max-width: 600px;
            width: 100%;
            background-color: rgb(251, 249, 249);
            padding: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            margin: 50px auto;
            border-radius: 15px;
            text-align: center;
        }

        h4 {
            color: black;
            font-size: 30px;
            margin-top: 0;
        }

        .inputbox {
            width: 100%;
            margin-top: 10px;
        }

        .inputbox label {
            color: black;
            font-size: 20px;
            float: center;
        }

        .inputbox input, .inputbox textarea {
            width: 90%;
            height: 50px;
            border-color: black;
            font-size: 1rem;
            color: black;
            margin-top: 8px;
            border: 1px solid white;
            border-radius: 10px;
            padding: 0 15px;
        }

        .inputbox textarea {
            height: 70px;
            resize: none;
        }
        input[type=text],input[type=number],input[type=date]{
            text-align: center;
        }
        .column {
            display: flex;
            column-gap: 15px;
        }

        .container button {
            height: 55px;
            width: 100%;
            color: aliceblue;
            font-size: 1rem;
            border: none;
            margin-top: 30px;
            cursor: pointer;
            border-radius: 8px;
            font-weight: 400;
            background-color: rgb(90, 90, 241);
        }

        h3 a {
            display: inline-block;
            color: red;
            text-decoration: none;
            text-align: left;
            margin-right: auto;
        }
        .a{
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
    .a:hover{
        background-color: #3e8e41;
    }
    </style>
</head>
<body>
    <div class="container">
        <?php
        $con = mysqli_connect("localhost", "root", "", "cms");
        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $qid = $_GET['pu'];
        $sql = "SELECT student.id, student.name, query.type, query.date, query.query, query.response FROM query JOIN student ON student.id=query.id where qid='$qid'";
        $rt = $con->query($sql);
        $r = mysqli_fetch_assoc($rt);
        $id = $r['id'];
        $sn = $r['name'];
        $tp = $r['type'];
        $dt = $r['date'];
        $qry = $r['query'];
        $reply1 = $r['response'];
        ?>

        <?php
        if (!empty($reply1)) {
            echo "<script>alert('Already responded to query');</script>";
            echo '<script>window.location.href="stf_qry_view.php";</script>';
        } else {
            ?>
            <form action="" method="POST" class="form">
                <h4>RESPONSE FORM</h4>
                <div class="column">
                    <div class="inputbox">
                        <label>ID:</label>
                        <input type="text" name="id" value="<?php echo $id; ?>" readonly>
                    </div>
                    <div class="inputbox">
                        <label>Name:</label>
                        <input type="text" name="na" value="<?php echo $sn; ?>" readonly>
                    </div>
                </div>
                <div class="column">
                    <div class="inputbox">
                        <label>Internal:</label>
                        <input type="number" name="tp" value="<?php echo $tp; ?>" readonly>
                    </div>
                    <div class="inputbox">
                        <label>Date:</label>
                        <input type="date" name="dt" value="<?php echo $dt; ?>" readonly>
                    </div>
                </div>

                <div class="inputbox">
                    <label>Query:</label><br><br>
                    <textarea name="sub" rows="4" cols="50" readonly><?php echo $qry; ?></textarea>
                </div>

                <div class="inputbox">
                    <label>Response for the Query:</label><br><br>
                    <textarea name="rep" rows="4" cols="50" required></textarea>
                </div>

                <button type="submit" value="submit" name="submit">Upload</button>
            </form>

            <?php
            if (isset($_POST['submit'])) {
                $id = $_POST['id'];
                $name = $_POST['na'];
                $type = $_POST['tp'];
                $date = $_POST['dt'];
                $qr = $_POST['sub'];
                $resp = $_POST['rep'];
                $uqry = "UPDATE query SET response='$resp' WHERE qid='$qid'";
                $rlt = $con->query($uqry);
                if ($rlt) {
                    echo "<script>alert('Updated successfully');</script>";
                    echo '<script>window.location.href="stf_qry_view.php";</script>';
                } else {
                    die(mysqli_error(($con)));
                }
            }
        }
        ?>
    </div>
    <a href="stf_qry_view.php" class="a">Back</a>
</body>
</html>
