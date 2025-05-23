
<?php
    include("_includes/config.inc");
    include("_includes/dbconnect.inc");
    include("_includes/functions.inc");  

    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

    // Fetch student records
    $sql = "SELECT studentid, firstname, lastname, dob, house, town, county, country, postcode FROM student";
    $result = mysqli_query($conn, $sql);
    $students = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .center {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Student Records</h2>
    <table>
        <thead>
            <tr>
                <th>Student ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Date of Birth</th>
                <th>House</th>
                <th>Town</th>
                <th>County</th>
                <th>Country</th>
                <th>Postcode</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?= htmlspecialchars($student['studentid']) ?></td>
                    <td><?= htmlspecialchars($student['firstname']) ?></td>
                    <td><?= htmlspecialchars($student['lastname']) ?></td>
                    <td><?= htmlspecialchars($student['dob']) ?></td>
                    <td><?= htmlspecialchars($student['house']) ?></td>
                    <td><?= htmlspecialchars($student['town']) ?></td>
                    <td><?= htmlspecialchars($student['county']) ?></td>
                    <td><?= htmlspecialchars($student['country']) ?></td>
                    <td><?= htmlspecialchars($student['postcode']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <br>
</body>
</html>
