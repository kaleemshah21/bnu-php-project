<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<?php
    include("_includes/config.inc");
    include("_includes/dbconnect.inc");
    include("_includes/functions.inc");  

    echo template("templates/partials/header.php");
    echo template("templates/partials/nav.php");

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete']) && isset($_POST['students'])) {
        foreach ($_POST['students'] as $id) {
            $id = mysqli_real_escape_string($conn, $id);
            mysqli_query($conn, "DELETE FROM student WHERE studentid = '$id'");
        }
        echo "<p class='text-green-500'>Selected students have been deleted.</p>";
    }

    // Fetch student records from database
    $sql = "SELECT studentid, firstname, lastname, dob, house, town, county, country, postcode, profileimg FROM student";
    $result = mysqli_query($conn, $sql);
    $students = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
    <script>
        function confirmDeletion() {
            return confirm("Are you sure you want to delete the selected students?");
        }
    </script>
</head>
<body class="bg-gray-100">
    <div class="max-w-7xl mx-auto px-4 py-6">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">Student Records</h2>
        <!-- students form -->
        <form method="post" onsubmit="return confirmDeletion();" class="bg-white shadow-md rounded-lg p-6">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="px-4 py-2 text-left"> <input type="checkbox" class="select-all-checkbox"> </th>
                        <th class="px-4 py-2">Image</th>
                        <th class="px-4 py-2">Student ID</th>
                        <th class="px-4 py-2">First Name</th>
                        <th class="px-4 py-2">Last Name</th>
                        <th class="px-4 py-2">Date of Birth</th>
                        <th class="px-4 py-2">House</th>
                        <th class="px-4 py-2">Town</th>
                        <th class="px-4 py-2">County</th>
                        <th class="px-4 py-2">Country</th>
                        <th class="px-4 py-2">Postcode</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- loops through the students and displays their details -->
                    <?php foreach ($students as $student): ?>
                        <tr class="border-b">
                            <td class="px-4 py-2">
                                <!-- checkbox for selecting records -->
                                <input type="checkbox" name="students[]" value="<?= htmlspecialchars($student['studentid']) ?>" class="student-checkbox">
                            </td>
                            <td class="px-4 py-2">
                                <?php if (!empty($student['profileimg'])): ?>
                                    <img src="<?= htmlspecialchars($student['profileimg']) ?>" width="60" height="60" class="object-cover rounded-full">
                                <?php else: ?>
                                    <span>No image</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-2"><?= htmlspecialchars($student['studentid']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($student['firstname']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($student['lastname']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($student['dob']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($student['house']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($student['town']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($student['county']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($student['country']) ?></td>
                            <td class="px-4 py-2"><?= htmlspecialchars($student['postcode']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="mt-4 flex justify-between items-center">
                <!-- submit button to delete selexted students -->
                <button type="submit" name="delete" class="bg-red-500 hover:bg-red-700 text-white py-2 px-4 rounded-md">Delete Selected</button>
            </div>
        </form>
    </div>
</body>
</html>
