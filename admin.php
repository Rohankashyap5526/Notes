<?php
// Start the session
session_start();

// Predefined username and password
$valid_username = "admin123";
$valid_password = "admin123";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted username and password
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    
    // Validate credentials
    if ($username == $valid_username && $password == $valid_password) {
        // Store login information in session
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        
        // Redirect to the protected page
        header("Location: protected.php");
        exit;
    } else {
        // Invalid login, display an error message
        $error_message = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Travelteachings</title>
    <link rel="icon" type="image/png" href="logo.png">
    
    <!-- Link to external stylesheet -->
    <link rel="stylesheet" href="stylec.css">
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
                    <li><a href="study.php">Study materials</a></li>
                    <li><a href="about.html">About author</a></li>
                    <!--li><a href="#faq">FAQ</a></li-->
                    <li><a href="cont.php">Contact us</a></li>
                </ul>
            </nav>

        </div>
    </header>


    <div class="login-container">
    <h2>Login</h2>
    <?php if (!empty($error_message)): ?>
        <p class="error"><?php echo $error_message; ?></p>
    <?php endif; ?>
    
    <form action="" method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="submit" value="Login">
    </form>
</div>









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


</body>
</html>
