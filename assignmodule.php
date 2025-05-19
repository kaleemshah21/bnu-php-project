<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // If a module has been selected
   if (isset($_POST['selmodule'])) {
      $sql = "INSERT INTO studentmodules VALUES ('" . $_SESSION['id'] . "','" . $_POST['selmodule'] . "');";
      $result = mysqli_query($conn, $sql);
      $data['content'] .= "<p class='text-green-600'>The module " . $_POST['selmodule'] . " has been assigned to you.</p>";
   }
   else  // If a module has not been selected
   {

     // Build SQL statement that selects all the modules
     $sql = "SELECT * FROM module";
     $result = mysqli_query($conn, $sql);

     $data['content'] .= "<div class='max-w-4xl mx-auto bg-white p-6 rounded-md shadow-md mt-8'>";
     $data['content'] .= "<h2 class='text-2xl font-semibold text-center mb-6'>Assign a Module</h2>";
     $data['content'] .= "<form name='frmassignmodule' action='' method='post' class='space-y-6'>";
     $data['content'] .= "<label for='selmodule' class='block text-sm font-medium text-gray-700'>Select a module to assign</label>";
     $data['content'] .= "<select name='selmodule' class='mt-1 p-2 border border-gray-300 rounded-md w-full focus:outline-none focus:ring-2 focus:ring-gray-500'>";
     
     // Display the module names in a dropdown selection box
     while ($row = mysqli_fetch_array($result)) {
        $data['content'] .= "<option value='$row[modulecode]'>$row[name]</option>";
     }

     $data['content'] .= "</select>";

     // Submit button
     $data['content'] .= "<div class='mt-6'>";
     $data['content'] .= "<input type='submit' name='confirm' value='Save' class='w-full bg-gray-700 text-white p-2 rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500'>";
     $data['content'] .= "</div>";
     $data['content'] .= "</form>";
     $data['content'] .= "</div>";
   }

   // Render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
