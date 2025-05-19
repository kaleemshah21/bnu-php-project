<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");

   // Include the header with Tailwind CSS link
   echo template("templates/partials/header.php");

   // Check if a return message exists in the query string (e.g., login failure)
   if (isset($_GET['return'])) {
      $msg = "";
      if ($_GET['return'] == "fail") {
         $msg = "Login Failed. Please try again.";
      }
      $data['message'] = "<p class='text-red-600 text-center font-semibold'>$msg</p>";
   }

   // Check if the user is logged in
   if (isset($_SESSION['id'])) {
      // Show welcome message if the user is logged in
      $data['content'] = "<p class='text-center text-xl font-medium'>Welcome to your dashboard.</p>";
      echo template("templates/partials/nav.php");  // Include navigation
      echo template("templates/default.php", $data);  // Show the main content
   } else {
      // Show login page if not logged in
      echo template("templates/login.php", $data);
   }

   // Include the footer
   echo template("templates/partials/footer.php");

?>
