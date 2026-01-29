<?php
session_start();
?>

<?php
$con = mysqli_connect("localhost", "root", "", "cms");
if (!$con) {
    die(mysqli_error());
}

$res = ""; 


if (isset($_SESSION['department'])) {
    
    $department = $_SESSION['department'];
    $qry = "SELECT * FROM student WHERE course='$department' AND status='available'";
    $res = $con->query($qry);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Marks</title>
    <style>
        body {
      font-family: Arial, sans-serif;
      margin: 0;
      background-image: url("backgrounds/examresult.jpg");
            background-repeat: no-repeat;
            background-size:cover;
            
    }
        .button {
            display: inline-block;
            padding: 8px 16px;
            background-color: blue;
            color: white;
            border: none;
            border-radius: 4px;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
            cursor: pointer;
        }

        .button:hover {
            background-color: blue;
        }

        .hide {
            display: none;
        }

        .popup {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 350px;
            /* display: flex; */
            margin-right: 20px;
            transform: translate(-50%, -50%);
            background-color: #f9f9f9;
            padding: 40px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            z-index: 999;
            padding-right: 60px;
        }

        .popup input[type="text"],
        .popup input[type="number"] {
            margin-bottom: 10px;
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .popup button {
            margin-top: 10px;
            height: 40px;
            width: 80px;
            background-color: blue;
            color: white;
            border-radius: 5px;
        }

        table,
        th,
        td {
            border: none;
        }

        table {
            border-collapse: collapse;
           border-spacing: 0;
            width: 100%;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
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
            border: none;
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
            background-color: #000080;
        }
        input[type="button"]{
            height: 40px;
            width: 80px;
            color: white;
            background-color: red;
            top: 10px;
            left: 20px;
            position: relative;
            float: right;
            border-radius: 5px;
        }
        input[type="button"]:hover{
            background-color: red;
        }
    </style>

    <script>
        function showAddMarksForm() {
            document.getElementById('marksForm').classList.remove('hide');
        }

        function hideAddMarksForm() {
            document.getElementById('marksForm').classList.add('hide');
        }

        function showMarkForm(studentId, type, studentName, studentCourse) {
            document.getElementById('studentId').value = studentId;
            document.getElementById('type').value = type;
            document.getElementById('studentName').value = studentName;
            document.getElementById('studentCourse').value = studentCourse;
            document.getElementById('popupContainer').classList.remove('hide');
        }

        function hideMarkForm() {
            document.getElementById('popupContainer').classList.add('hide');
        }

        function calculateTotalAndAverage() {
            var subject1 = parseInt(document.getElementById('subject1').value) || 0;
            var subject2 = parseInt(document.getElementById('subject2').value) || 0;
            var subject3 = parseInt(document.getElementById('subject3').value) || 0;
            var subject4 = parseInt(document.getElementById('subject4').value) || 0;
            var subject5 = parseInt(document.getElementById('subject5').value) || 0;
            var subject6 = parseInt(document.getElementById('subject6').value) || 0;

            var total = subject1 + subject2 + subject3 + subject4 + subject5 + subject6;
            var average = total / 6;
            var grade = '';

            if (
                subject1 >= 35 &&
                subject2 >= 35 &&
                subject3 >= 35 &&
                subject4 >= 35 &&
                subject5 >= 35 &&
                subject6 >= 35
            ) {
                if (average >= 75) {
                    grade = 'distinction';
                } else if (average >= 65) {
                    grade = 'first class';
                } else if (average >= 55) {
                    grade = 'second class';
                } else if (average >= 35) {
                    grade = 'pass class';
                } else {
                    grade = 'fail';
                }
            } else {
                grade = 'fail';
            }

            document.getElementById('total').value = total;
            document.getElementById('average').value = average.toFixed(2);
            document.getElementById('passing_class').value = grade;
        }

    

    

    </script>
</head>

<body>
    <div id="marksForm">
        <h2 align="center" ><?php echo $department; ?> Marks Form</h2>
        <div class="table-container">
            <table>
  <tr class="table-heading">
    <th>Student ID</th>
    <th colspan="2">Action</th>
  </tr>
  <?php
  // Retrieve student data from the database and populate the table rows dynamically
  while ($row = mysqli_fetch_assoc($res)) {
    $name = $row['name'];
    $course = $row['course'];
    $studentId = $row['id'];

    // Check if internal 1 marks are added for the student
    $qry = "SELECT * FROM marks WHERE id='$studentId' AND type=1";
$res_marks = $con->query($qry);

echo "<tr>";
echo "<td>" . $studentId . "</td>";

if ($res_marks->num_rows > 0) {
    // Internal 1 marks exist, check for internal 2 marks
    $qry_internal2 = "SELECT * FROM marks WHERE id='$studentId' AND type=2";
    $res_internal2 = $con->query($qry_internal2);

    if ($res_internal2->num_rows > 0) {
        // Internal 2 marks exist, show a message indicating they have already been added
        echo "<td><button class='button' onclick=\"alert('Internal 1 marks already added!')\">1 internal</button></td>";
        echo "<td><button class='button' onclick=\"alert('Internal 2 marks already added!')\">2 internal</button></td>";
    } else {
        // Internal 2 marks are missing, show button to add them
        echo "<td><button class='button' onclick=\"alert('Internal 1 marks already added!')\">1 internal</button></td>";
        echo "<td><button class='button' onclick=\"showMarkForm('" . $studentId . "', 2, '$name', '$course')\">2 internal</button></td>";
    }
} else {
    // Internal 1 marks are missing, show a warning to add them first
    echo "<td><button class='button' onclick=\"showMarkForm('" . $studentId . "', 1, '$name', '$course')\">1 internal</button></td>";
    echo "<td><button class='button' onclick=\"alert('Add internal 1 marks first!')\">2 internal</button></td>";
}

echo "</tr>";

      
      
    echo "</tr>";
  }
  ?>
</table>

        </div>
    </div>
    <div id="popupContainer" class="hide">
        <div class="popup">
            <h2 align="center">Add Marks</h2>
            <form id="popupForm" method="POST" action="process_marks.php">
                <input type="hidden" name="id" id="studentId" value="<?php echo $id; ?>" readonly>
                <input type="text" name="name" id="studentName" value="<?php echo $name; ?>" readonly>
                <input type="hidden" name="course" id="studentCourse" value="<?php echo $course; ?>" readonly>
                <input type="text" name="type" id="type" readonly>
                <input type="number" name="subject1" id="subject1" min=0 max=100 placeholder="Subject 1" oninput="calculateTotalAndAverage()">
                <input type="number" name="subject2" id="subject2" min=0 max=100 placeholder="Subject 2" oninput="calculateTotalAndAverage()" required>
                <input type="number" name="subject3" id="subject3" min=0 max=100 placeholder="Subject 3" oninput="calculateTotalAndAverage()" required>
                <input type="number" name="subject4" id="subject4" min=0 max=100 placeholder="Subject 4" oninput="calculateTotalAndAverage()" required>
                <input type="number" name="subject5" id="subject5" min=0 max=100 placeholder="Subject 5" oninput="calculateTotalAndAverage()" required>
                <input type="number" name="subject6" id="subject6" min=0 max=100 placeholder="Subject 6" oninput="calculateTotalAndAverage()" required>
                <input type="number" name="total" id="total" placeholder="Total" readonly>
                <input type="number" name="average" id="average" placeholder="Average" readonly>
                <input type="text" name="grade" id="passing_class" placeholder="Passing Class" readonly>
                <button type="submit" name="submit">Add Marks</button>
                <!-- <button type="button" onclick="hideMarkForm()">Cancel</button> -->
                <input type="button" name="button"  onclick="hideMarkForm()" value="Cancel">
            </form>
        </div>
    </div>
  
    <a href='add_marks.php' class='a'>Back</a>
</body>
</html>
