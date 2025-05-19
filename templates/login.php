<?php echo $message; ?>
<head>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<div class="flex justify-center items-center min-h-screen bg-gray-100">
    <form name="frmLogin" action="authenticate.php" method="post" class="max-w-xl mx-auto bg-white p-6 rounded-md shadow-md mt-8">
        <h2 class="text-2xl font-semibold text-center mb-6">Login</h2>

        <!-- Student ID Input -->
        <div class="mb-4">
            <label for="txtid" class="block text-sm font-medium text-gray-700">Student ID</label>
            <input name="txtid" type="text" id="txtid" required class="mt-1 p-2 border border-gray-300 rounded-md w-full focus:outline-none focus:ring-2 focus:ring-gray-500">
        </div>

        <!-- Password Input -->
        <div class="mb-4">
            <label for="txtpwd" class="block text-sm font-medium text-gray-700">Password</label>
            <input name="txtpwd" type="password" id="txtpwd" required class="mt-1 p-2 border border-gray-300 rounded-md w-full focus:outline-none focus:ring-2 focus:ring-gray-500">
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <button type="submit" name="btnlogin" class="w-full bg-gray-700 text-white p-2 rounded-md hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-500">
                Login
            </button>
        </div>
    </form>
</div>
