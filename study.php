<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="logo.png">
    <title>Travel teachings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="stylest9.css">
</head>
<body>
    <!-- Header section with logo and navigation -->
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
    <main>
        <div class="container">
            <div class="text-content">
                <h1>Study material </h1>
                <p>Home / Study material </p>
                </div>
            </div>

        <div>
            <h3 class="section-title">NOTES</h3>
        <section class="notes-container">
            <?php
    // Replace these values with your actual database connection information
    $servername = "localhost";
    $username = "root";
    $password = "Rohan@sql5526";
    $database = "test";
    
    // Create a database connection
    $conn = new mysqli($servername, $username, $password, $database);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Get a list of table names in your database
    $query = "SHOW TABLES";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tableName = $row['Tables_in_' . $database];
            echo "<div class='section-title'>$tableName</div>";
            echo "<div class='slider'>";
            
            // Fetch notes from the specific table and display them `$tableName`
            $notesQuery = "SELECT * FROM `$tableName`";
            $notesResult = $conn->query($notesQuery);
            
           if ($notesResult->num_rows > 0) {
        while ($noteRow = $notesResult->fetch_assoc()) {
            //echo "<div class='container'>";
            $pgfName = $noteRow['pgf_name']; // Use 'pgf_name' instead of 'note_name'
            $notesName = $noteRow['notes_name']; // Use 'notes_name' instead of 'note_name' 
            
            echo "<div class='notescont'>";
                                echo "<div class='left-section'>";
                                echo "<a href='notes/$notesName' target='_blank'><m class='fas fa-file-pdf fa-2x'></m></a>";
                                echo "<a href='notes/$notesName' style='color: inherit; text-decoration: none;'><n>$pgfName</n></a>";
                                echo "</div>";
                                echo "<a href='download.php?file=$notesName' download onclick='incrementDownload()'><o class='fas fa-download fa-2x'></o></a>";
                                echo "</div>";
    
            
        }
    } else {
        echo "No notes found in this category.";
    }
    
            
            echo "</div>";
        }
    } else {
        echo "No categories found.";
    }
    
    // Close the database connection
    $conn->close();
    ?>
        </section>







        

    </main>

    <!-- Footer section -->
    <footer class="footer">
        <!-- Site Logo -->
        <div class="footer-logo">
            <img src="logo.png" alt="Site Logo">
        </div>
    
    
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


    <!-- JavaScript for hamburger menu toggle -->
    <script>
        function toggleMenu() {
            const hamburger = document.querySelector('.hamburger');
            const nav = document.querySelector('nav ul');
            hamburger.classList.toggle('active');
            nav.classList.toggle('active');
        }
    </script>
</body>
</html>
