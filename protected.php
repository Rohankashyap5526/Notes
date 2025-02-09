<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Not logged in, redirect to login page
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <!-- Link to external stylesheet -->
    <link rel="stylesheet" href="stylec.css">
    <!-- JavaScript to reload page after form submission -->
    <script>
        // Function to submit form and refresh the page
        function handleFormSubmission(event) {
            event.preventDefault(); // Prevent default form submission
            
            // Save a flag in localStorage to indicate form submission
            localStorage.setItem('formSubmitted', 'true');

            // Submit the form using JavaScript
            document.getElementById('categoryForm').submit();
        }

        // Function to handle page reload and clear the localStorage flag
        window.onload = function() {
            if (localStorage.getItem('formSubmitted') === 'true') {
                // Reload the page and clear the flag
                localStorage.removeItem('formSubmitted');
                window.location.reload();
            }
        }
    </script>

</head>
<body>
<header>
        <div class="header-content">
            <div class="logo-container">
                <!-- Logo image -->
                <img src="logo.png" alt="Website Logo" class="logo">
            </div>
            
            <!-- Hamburger icon for mobile -->
            <div class="hamburger" onclick="toggleMenu()">
                <div></div>
                <div></div>
                <div></div>
            </div>

            <!-- Navigation menu -->
            <nav>
                <ul class="header">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="study.php">Study material</a></li>
                    <li><a href="about.html">About author</a></li>
                    <!--li><a href="#faq">FAQ</a></li-->
                    <li><a href="cont.php">Ask us</a></li>
                </ul>
            </nav>

        </div>
    </header>
    




    <section class="login-container">
        
        <h2 class="section-title">Add Note</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" onsubmit="incrementNote()" >
            <label for="note_name">Note Name:</label>
            <input type="text" name="note_name" required><br><br>
            
            <div class="form-group">
        <label for="category" >Category:</label>
<select name="category" class="upload-button" required>
</div>
        <?php
        // Database connection configuration
        $servername = "localhost";
        $username = "root";
        $password = "Rohan@sql5526";
        $dbname = "test";
    
        // Create a connection to the database
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        // Query to fetch table names
        $query = "SHOW TABLES FROM $dbname";
        $result = $conn->query($query);
    
        // Loop through the results and create options
        while ($row = $result->fetch_assoc()) {
            $tableName = $row['Tables_in_' . $dbname];
            echo '<option value="' . $tableName . '">' . $tableName . '</option>';
        }
    
        // Close the database connection
        $conn->close();
        ?>
    </select>
    <br><br>
    
            <label for="file">Upload PDF:</label>
            <input type="file" name="file" accept=".pdf" required><br><br>
    
            <input type="submit" name="submit" value="Upload Note" class="upload-button">
        </form>
        <hr>
    
        <?php
        if (isset($_POST["submit"])) {
            $noteName = $_POST["note_name"];
            $category = $_POST["category"];
            $uploadDirectory = "notes/";
    
            // Check if the file was uploaded without errors
            if ($_FILES["file"]["error"] == UPLOAD_ERR_OK) {
                $fileTmpName = $_FILES["file"]["tmp_name"];
                $fileName = $_FILES["file"]["name"];
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                
                // Generate a unique filename for the uploaded PDF
                $uniqueFileName = uniqid() . "." . $fileExtension;
                $uploadPath = $uploadDirectory . $uniqueFileName;
                
                // Move the uploaded PDF to the "notes" directory
                if (move_uploaded_file($fileTmpName, $uploadPath)) {
                    // Insert data into the chosen category (table)
                    $servername = "localhost";
                    $username = "root";
                    $password = "Rohan@sql5526";
                    $dbname = "test";
    
                    $conn = new mysqli($servername, $username, $password, $dbname);
    
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
    
                    $sql = "INSERT INTO `$category` (pgf_name, notes_name) VALUES (?, ?)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("ss", $noteName, $uniqueFileName);
                    
                    if ($stmt->execute()) {
                        echo "Note uploaded and added to the $category category successfully.";
                    } else {
                        echo "Error: " . $stmt->error;
                    }
    
                    $stmt->close();
                    $conn->close();
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "Error: " . $_FILES["file"]["error"];
            }
        }
        ?>
        <section class="notes-container">
        <h2 class="section-title">Add New Category</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="category_name">Category Name:</label>
            <input type="text" name="category_name" required><br><br>
            <input type="submit" name="add_category" value="Add Category" class="upload-button">
    
        </form>
        <hr>
        </section>
    
        <?php
        // Handle the submission of the new category form
        if (isset($_POST["add_category"])) {
            $newCategoryName = $_POST["category_name"];
    
            // Replace these values with your actual database connection information
            $servername = "localhost";
            $username = "root";
            $password = "Rohan@sql5526";
             $database = "test";
    
            // Create a database connection
            $conn = new mysqli($servername, $username, $password, $dbname);
    
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
    
            // Create a new category table
            $createTableQuery = "CREATE TABLE `$newCategoryName` (
                id INT AUTO_INCREMENT PRIMARY KEY,
                pgf_name VARCHAR(255) NOT NULL,
                notes_name VARCHAR(255) NOT NULL
            )";
    
            if ($conn->query($createTableQuery) === TRUE) {
                echo "New category '$newCategoryName' and table created successfully.";
                header('Location: admin.php');
             exit(); 
        
            } else {
                echo "Error creating category table: " . $conn->error;
            }
    
            // Close the database connection
            $conn->close();
        }
        ?>
       





       

        <h2 class="section-title">delete category</h2>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >
            
            <div class="form-group">
        <label for="category" >Category:</label>
<select name="category" class="upload-button" required>
</div>
        <?php
        // Database connection configuration
        $servername = "localhost";
        $username = "root";
        $password = "Rohan@sql5526";
        $dbname = "test";
    
        // Create a connection to the database
        $conn = new mysqli($servername, $username, $password, $dbname);
    
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        // Query to fetch table names
        $query = "SHOW TABLES FROM $dbname";
        $result = $conn->query($query);
    
        // Loop through the results and create options
        while ($row = $result->fetch_assoc()) {
            $tableName = $row['Tables_in_' . $dbname];
            echo '<option value="' . $tableName . '">' . $tableName . '</option>';
        }
    
        // Close the database connection
        $conn->close();
        ?>
    </select>




    <input type="submit" name="delete" value="delete" class="upload-button">
        </form>
        <hr>
    
        <?php

ob_start();
        if (isset($_POST["delete"])) {
          //  $noteName = $_POST["note_name"];
                      $category = $_POST["category"];

                      $servername = "localhost";
                      $username = "root";
                      $password = "Rohan@sql5526";
                      $dbname = "test";
    
                    $conn = new mysqli($servername, $username, $password, $dbname);
    
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }
                    else{
                    

    
                    $sql = "DROP TABLE `$category`";
                    $stmt = $conn->prepare($sql);
                    //$stmt->bind_param("ss", $noteName, $uniqueFileName);
                    
                    if ($stmt->execute()) {
                        echo "$category category deleted successfully.";
                    } else {
                        
                    }
    
                    $stmt->close();
                    $conn->close();
                    

                }

        }

        ob_end_flush();
        ?>











<?php
// Initialize variables
$servername = "localhost";
$username = "root";
$password = "Rohan@sql5526";
$dbname = "test";

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if (isset($_POST['delete_note'])) {
    // Get the selected category (table) and note
    $category = $_POST['category'];
    $note_name = $_POST['notes'];

    // Prepare the DELETE query
    $query = "DELETE FROM `$category` WHERE pgf_name = ?";
    
    // Prepare and bind parameters
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $note_name);

    // Execute the statement and handle the result
    if ($stmt->execute()) {
        echo "<p>Note '$note_name' has been deleted successfully from the category '$category'.</p>";
    } else {
        echo "<p>Error deleting note: " . $stmt->error . "</p>";
    }

    // Close the statement
    $stmt->close();
}
?>

<h2 class="section-title">Delete Notes</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <div class="form-group">
        <label for="category">Category:</label>
        <select name="category" class="upload-button" required onchange="this.form.submit()">
            <option value="">Select a Category</option>
            <?php
            // Query to fetch table names
            $query = "SHOW TABLES FROM $dbname";
            $result = $conn->query($query);

            // Loop through the results and create options
            while ($row = $result->fetch_assoc()) {
                $tableName = $row['Tables_in_' . $dbname];
                $selected = (isset($_POST['category']) && $_POST['category'] == $tableName) ? 'selected' : '';
                echo '<option value="' . $tableName . '" ' . $selected . '>' . $tableName . '</option>';
            }
            ?>
        </select>
    </div>

    <?php
    // If a category is selected, fetch the notes for that category
    if (isset($_POST["category"])) {
        $category = $_POST["category"];

        // Query to fetch note names from the selected table
        $query = "SELECT pgf_name FROM `$category`";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo '<div class="form-group">';
            echo '<label for="notes">Notes:</label>';
            echo '<select name="notes" class="upload-button" required>';
            echo '<option value="">Select a Note</option>';

            // Loop through the results and create options
            while ($row = $result->fetch_assoc()) {
                $noteName = $row['pgf_name'];
                echo '<option value="' . $noteName . '">' . $noteName . '</option>';
            }

            echo '</select>';
            echo '</div>';
        } else {
            echo "<p>No notes found for the selected category.</p>";
        }
    }
    ?>

    <?php if (isset($_POST["category"])): ?>
        <input type="submit" name="delete_note" value="Delete Note" class="upload-button">
    <?php endif; ?>
</form>

<?php
// Close the database connection
$conn->close();
?>










        </form>
        <hr>

        <div class="content">
    <a class="k" href="logout.php">Logout</a>
    </div>

</section>
    





    <footer class="footer">
        <!-- Site Logo -->
    
    
<ul class="social-icons">
<!-- Facebook -->
<li><a href="https://www.facebook.com/malrarenu?mibextid=MKOS29" target="_blank"><img src="f.png" alt="Facebook"></a></li>

<!-- Instagram -->
<li><a href="https://instagram.com/sustainable_zindgi?igshid=OGQ5ZDc2ODk2ZA==" target="_blank"><img src="i.png" alt="Instagram"></a></li>

<!-- Twitter -->
<li><a href="mailto:malrarenu@gmail.com" target="_blank"><img src="R.png" alt="Twitter"></a></li>

<!-- LinkedIn -->
<li><a href="https://www.linkedin.com/in/renu-malra-405a3217?trk=contact-info" target="_blank"><img src="l.png" alt="LinkedIn"></a></li>
<!-- LinkedIn -->
<!--li><a href="https://kuk.academia.edu/renumalra" target="_blank"><img src="A.png" alt="LinkedIn"></a></li-->
<!-- LinkedIn -->
<li><a href="https://www.researchgate.net/profile/Renu-Malra" target="_blank"><img src="RE.png" alt="LinkedIn"></a></li>
<li><a href="admin.php" target="_blank"><img src="lock.png" alt="admin"></a></li>
</ul>  
<hr>
<p class="footer-paragraph">&copy; 2024 Traveltechings. All rights reserved.</p> 
</footer>
<script>
        function toggleMenu() {
            const hamburger = document.querySelector('.hamburger');
            const nav = document.querySelector('nav ul');
            hamburger.classList.toggle('active');
            nav.classList.toggle('active');
        }
        
        function incrementNote() {
        // Retrieve the current note count from localStorage, increment it, and update localStorage
        let noteCount = localStorage.getItem('noteCount') ? parseInt(localStorage.getItem('noteCount')) : 8;
        noteCount++;
        localStorage.setItem('noteCount', noteCount);
    }
    </script>

</body>
</html>