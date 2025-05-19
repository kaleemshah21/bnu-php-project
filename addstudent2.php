<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

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

    $profileImgName = null;

    if (isset($_FILES['profileimg']) && $_FILES['profileimg']['error'] == 0) {

        $maxSize = 2 * 1024 * 1024; //sets max size of image to 2mb

        if ($_FILES['profileimg']['size'] > $maxSize) {
            $errors[] = "Image size must be less than 2MB.";
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = mime_content_type($_FILES['profileimg']['tmp_name']);

        if (!in_array($fileType, $allowedTypes)) {
            $errors[] = "Only JPG, PNG, and GIF files are allowed.";
        } else {
            $uploadDir = "uploads/";
            $fileName = basename($_FILES['profileimg']['name']);
            $targetPath = $uploadDir . uniqid() . "_" . $fileName;

            if (move_uploaded_file($_FILES['profileimg']['tmp_name'], $targetPath)) {
                $profileImgName = $targetPath;
            } else {
                $errors[] = "Failed to upload image.";
            }
        }
    }

    if (count($errors) == 0) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // insert with filename
        $sql = "INSERT INTO student (studentid, firstname, lastname, dob, house, town, county, country, postcode, password, profileimg) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'sssssssssss', $studentid, $firstname, $lastname, $dob, $house, $town, $county, $country, $postcode, $hashedPassword, $profileImgName);

        if (mysqli_stmt_execute($stmt)) {
            echo "<p class='text-green-500'>Student added successfully!</p>";
        } else {
            echo "<p class='text-red-500'>Error: " . mysqli_error($conn) . "</p>";
        }
    } else {
        foreach ($errors as $e) {
            echo "<p class='text-red-500'>$e</p>";
        }
    }
}  
?>

<!-- form for adding students, styling with tailwind -->
<div class="container mx-auto p-4">
    <h2 class="text-3xl font-semibold mb-4 text-center">Add New Student</h2>
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
        <form method="post" action="" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label class="block text-lg font-medium">Student ID:</label>
                <input type="text" name="studentid" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-lg font-medium">First Name:</label>
                <input type="text" name="firstname" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-lg font-medium">Last Name:</label>
                <input type="text" name="lastname" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-lg font-medium">Date of Birth:</label>
                <input type="date" name="dob" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-lg font-medium">House:</label>
                <input type="text" name="house" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-lg font-medium">Town:</label>
                <input type="text" name="town" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-lg font-medium">County:</label>
                <input type="text" name="county" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-lg font-medium">Country:</label>
                <input type="text" name="country" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-lg font-medium">Postcode:</label>
                <input type="text" name="postcode" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-lg font-medium">Password:</label>
                <input type="password" name="password" required class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-lg font-medium">Profile Image:</label>
                <input type="file" name="profileimg" accept="image/*" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div class="flex justify-center">
                <!-- submit button -->
                <input type="submit" value="Add Student" class="mt-4 px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            </div>
        </form>
    </div>
</div>
