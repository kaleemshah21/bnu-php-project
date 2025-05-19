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

      // Build SQL statement that selects a student's modules
      $sql = "SELECT * FROM studentmodules sm, module m WHERE m.modulecode = sm.modulecode AND sm.studentid = '" . $_SESSION['id'] . "';";

      $result = mysqli_query($conn,$sql);

      // prepare page content
      $data['content'] = "<div class='max-w-4xl mx-auto bg-white p-6 rounded-md shadow-md mt-8'>";
      $data['content'] .= "<h2 class='text-2xl font-semibold text-center mb-6'>Your Modules</h2>";
      $data['content'] .= "<table class='w-full table-auto border-collapse border border-gray-300'>";
      $data['content'] .= "<thead><tr><th colspan='3' class='py-2 text-center bg-gray-200 text-gray-700'>Modules</th></tr></thead>";
      $data['content'] .= "<thead><tr><th class='py-2 px-4 border border-gray-300 text-left'>Code</th><th class='py-2 px-4 border border-gray-300 text-left'>Type</th><th class='py-2 px-4 border border-gray-300 text-left'>Level</th></tr></thead>";
      $data['content'] .= "<tbody>";
      // Display the modules within the HTML table
      while($row = mysqli_fetch_array($result)) {
         $data['content'] .= "<tr>";
         $data['content'] .= "<td class='py-2 px-4 border border-gray-300'>$row[modulecode]</td>";
         $data['content'] .= "<td class='py-2 px-4 border border-gray-300'>$row[name]</td>";
         $data['content'] .= "<td class='py-2 px-4 border border-gray-300'>$row[level]</td>";
         $data['content'] .= "</tr>";
      }
      $data['content'] .= "</tbody>";
      $data['content'] .= "</table>";
      $data['content'] .= "</div>";

      // render the template
      echo template("templates/default.php", $data);

   } else {
      header("Location: index.php");
   }

   echo template("templates/partials/footer.php");

?>
