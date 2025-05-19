<?php
include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");

echo template("templates/partials/header.php");
echo template("templates/partials/nav.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];

    //form inputs
    $studentid = trim($_POST['studentid']);
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $dob = trim($_POST['dob']);
    $house = trim($_POST['house']);
    $town = trim($_POST['town']);
    $county = trim($_POST['county']);
    $country = trim($_POST['country']);
    $postcode = trim($_POST['postcode']);
    $password = $_POST['password'];

    //validation
    if (empty($studentid) || !is_numeric($studentid)) $errors[] = "A valid Student ID is required.";
    if (empty($firstname)) $errors[] = "First Name is required.";
    if (empty($lastname)) $errors[] = "Last Name is required.";
    if (empty($dob)) $errors[] = "Date of Birth is required.";
    if (empty($password) || strlen($password) < 6) $errors[] = "Password must be at least 6 characters long.";

    if (count($errors) == 0) {
        // hash password using password_hash file
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // insert into database
        $sql = "INSERT INTO student (studentid, firstname, lastname, dob, house, town, county, country, postcode, password) 
                VALUES ('$studentid', '$firstname', '$lastname', '$dob', '$house', '$town', '$county', '$country', '$postcode', '$hashedPassword')";

        if (mysqli_query($conn, $sql)) {
            echo "<p style='color: green;'>Student added successfully!</p>";
        } else {
            echo "<p style='color: red;'>Error: " . mysqli_error($conn) . "</p>";
        }
    } else {
        foreach ($errors as $e) {
            echo "<p style='color: red;'>$e</p>";
        }
    }
}
?>

<h2>Add New Student</h2>
<form method="post" action="">
    <label>Student ID: <input type="text" name="studentid" required></label><br><br>
    <label>First Name: <input type="text" name="firstname" required></label><br><br>
    <label>Last Name: <input type="text" name="lastname" required></label><br><br>
    <label>Date of Birth: <input type="date" name="dob" required></label><br><br>
    <label>House: <input type="text" name="house"></label><br><br>
    <label>Town: <input type="text" name="town"></label><br><br>
    <label>County: <input type="text" name="county"></label><br><br>
    <label>Country: <input type="text" name="country"></label><br><br>
    <label>Postcode: <input type="text" name="postcode"></label><br><br>
    <label>Password: <input type="password" name="password" required></label><br><br>
    <input type="submit" value="Add Student">
</form>
