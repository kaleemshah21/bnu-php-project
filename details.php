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

   // if the form has been submitted
   if (isset($_POST['submit'])) {

      // build an sql statement to update the student details
      $stmt = $conn->prepare("UPDATE student SET firstname = ?, lastname = ?, house = ?, town = ?, county = ?, country = ?, postcode = ? WHERE studentid = ?");
      $stmt->bind_param("ssssssss", $_POST['txtfirstname'], $_POST['txtlastname'], $_POST['txthouse'], $_POST['txttown'], $_POST['txtcounty'], $_POST['txtcountry'], $_POST['txtpostcode'], $_SESSION['id']);
      $stmt->execute();
      $stmt->close();

   $data['content'] = "<p>Your details have been updated</p>";

   }
   else {
      // Build a SQL statement to return the student record with the id that
      // matches that of the session variable.
      $sql = "select * from student where studentid='". $_SESSION['id'] . "';";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result);

      // using <<<EOD notation to allow building of a multi-line string
      // see http://stackoverflow.com/questions/6924193/what-is-the-use-of-eod-in-php for info
      // also http://stackoverflow.com/questions/8280360/formatting-an-array-value-inside-a-heredoc
      $data['content'] = <<<EOD

   <div class="container mx-auto p-4">
       <h2 class="text-3xl font-semibold mb-4">My Details</h2>
       <form name="frmdetails" action="" method="post" class="space-y-4 max-w-2xl mx-auto">
           <div>
               <label class="block text-lg font-medium">First Name:</label>
               <input name="txtfirstname" type="text" value="{$row['firstname']}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
           </div>

           <div>
               <label class="block text-lg font-medium">Surname:</label>
               <input name="txtlastname" type="text" value="{$row['lastname']}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
           </div>

           <div>
               <label class="block text-lg font-medium">Number and Street:</label>
               <input name="txthouse" type="text" value="{$row['house']}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
           </div>

           <div>
               <label class="block text-lg font-medium">Town:</label>
               <input name="txttown" type="text" value="{$row['town']}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
           </div>

           <div>
               <label class="block text-lg font-medium">County:</label>
               <input name="txtcounty" type="text" value="{$row['county']}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
           </div>

           <div>
               <label class="block text-lg font-medium">Country:</label>
               <input name="txtcountry" type="text" value="{$row['country']}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
           </div>

           <div>
               <label class="block text-lg font-medium">Postcode:</label>
               <input name="txtpostcode" type="text" value="{$row['postcode']}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" />
           </div>

           <div class="flex justify-center">
               <input type="submit" value="Save" name="submit" class="mt-4 px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50" />
           </div>
       </form>
   </div>

EOD;

   }

   // render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
