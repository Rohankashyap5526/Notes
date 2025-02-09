<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="logo.png">
    <title>Travel teachings</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Link to external CSS file -->
    <link rel="stylesheet" href="test15.css">
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

    <!-- Main content section -->
    <main>
        <div class="container">
            <div class="text-content">
                <h1>Welcome to The Traveltechings</h1>
                <p>The travelteachings provides the information about basic concepts about tourism as a subject. This information might help students and other academician in getting conversant with the diffrent subject matters mentioned under different categories.</p>
            </div>
            <div class="image-content">
                <img src="k1.png" alt="Example Image">
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
            if ($tableName !== "visitors") { // Skip 'visitors' table
                        echo "<div class='section-title'>$tableName</div>";
                        echo "<div class='slider'>";
                        
                        $notesQuery = "SELECT * FROM `$tableName`";
                        $notesResult = $conn->query($notesQuery);
                        
                        if ($notesResult->num_rows > 0) {
                            while ($noteRow = $notesResult->fetch_assoc()) {
                                $pgfName = $noteRow['pgf_name'];
                                $notesName = $noteRow['notes_name'];
                                
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
                }
            } else {
                echo "No categories found.";
            }
            
            $conn->close();
            ?>
        </section>
        
        <!--<div class="statistics-container">-->
        <!--        <div class="stat">-->
        <!--            <h3>Visits</h3>-->
        <!--            <p id="visitor-count">Loading...</p>-->
        <!--        </div>-->
        <!--        <div class="stat">-->
        <!--            <h3>Downloads</h3>-->
        <!--            <p id="download-count">0</p> -->
        <!--        </div>-->
        <!--        <div class="stat">-->
        <!--            <h3>Notes</h3>-->
        <!--            <p id="note-count">Loading...</p> -->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->







        

    </main>

    <!-- Footer section -->
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


    <!-- JavaScript for hamburger menu toggle -->
    <script>
        function toggleMenu() {
            const hamburger = document.querySelector('.hamburger');
            const nav = document.querySelector('nav ul');
            hamburger.classList.toggle('active');
            nav.classList.toggle('active');
        }
        
        // Download count using localStorage
        if (localStorage.getItem('downloadCount')) {
            document.getElementById('download-count').innerText = localStorage.getItem('downloadCount');
        }

        function incrementDownload() {
            let downloadCount = localStorage.getItem('downloadCount') ? parseInt(localStorage.getItem('downloadCount')) : 0;
            downloadCount++;
            localStorage.setItem('downloadCount', downloadCount);
            document.getElementById('download-count').innerText = downloadCount;
        }

        document.addEventListener('DOMContentLoaded', function() {
        let noteCount = localStorage.getItem('noteCount') ? parseInt(localStorage.getItem('noteCount')) : 0;
        document.getElementById('note-count').innerText = noteCount;
    });






    // Function to fetch user's IP address using ipify API
function getUserIP() {
    return fetch('https://api.ipify.org?format=json')
        .then(response => response.json())
        .then(data => data.ip)
        .catch(err => {
            console.error("Error fetching IP address:", err);
            return null;
        });
}

// Function to check if a visit is from a unique IP
async function checkUniqueVisitor() {
    const currentIP = await getUserIP(); // Get current user's IP
    if (!currentIP) {
        console.error('Unable to fetch IP.');
        return;
    }

    const storedIP = localStorage.getItem('visitorIP');
    const lastVisitTime = localStorage.getItem('lastVisitTime');
    const visitExpiry = 24 * 60 * 60 * 1000; // Set expiry to 24 hours

    const currentTime = new Date().getTime();

    if (storedIP !== currentIP || (lastVisitTime && currentTime - lastVisitTime > visitExpiry)) {
        // If new IP or 24 hours have passed since last visit
        incrementVisitorCount();
        localStorage.setItem('visitorIP', currentIP); // Store the new IP
        localStorage.setItem('lastVisitTime', currentTime); // Update visit time
    } else {
        console.log('Visitor already counted recently.');
    }
}

// Function to simulate incrementing visitor count (you can replace with your logic)
function incrementVisitorCount() {
    let visitorCount = localStorage.getItem('visitorCount') ? parseInt(localStorage.getItem('visitorCount')) : 0;
    visitorCount++;
    localStorage.setItem('visitorCount', visitorCount); // Store updated count
    document.getElementById('visitor-count').innerText = visitorCount;
}

// Display the visitor count on page load
document.addEventListener('DOMContentLoaded', function() {
    const visitorCount = localStorage.getItem('visitorCount') ? parseInt(localStorage.getItem('visitorCount')) : 0;
    document.getElementById('visitor-count').innerText = visitorCount;
    checkUniqueVisitor(); // Check if current visit is unique
});


    </script>
</body>
</html>
