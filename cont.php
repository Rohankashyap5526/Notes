<?php
// Handle the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Set the recipient email address
    $to = "travelteachings@gmail.com"; // Replace with your email

    // Create the email subject and message body
    $email_subject = "Contact Us Form: " . $subject;
    $email_body = "You have received a new message from the Contact Us form on your website.\n\n".
                  "Name: $name\n".
                  "Email: $email\n\n".
                  "Message:\n$message";

    // Set the email headers
    $headers = "From: $email\n";
    $headers .= "Reply-To: $email";

    // Send the email
    if (mail($to, $email_subject, $email_body, $headers)) {
        $success_message = "Message sent successfully!";
    } else {
        $error_message = "Failed to send the message.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ask Us</title>
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
                    <li><a href="cont.php">Ask us</a></li>
                </ul>
            </nav>

        </div>
    </header>
    <div class="container">
            <div class="text-content">
                <h1>Ask about tourism</h1>
                <p>Home / Ask </p>
                </div>
            </div>

<div class="containerc">
    <!-- Left Side: Text Container -->
    <div class="left-containerc">
        <h2>Ask about tourism</h2>
        <p>If you have any questions, feel free to Ask us by filling out the form on the right. We aim to respond to all inquiries within 24 hours.</p>
    </div>

    <!-- Right Side: Form Container -->
    <div class="right-containerc">
        <!-- Display success or error message -->
        <?php if (isset($success_message)): ?>
            <p class="success"><?php echo $success_message; ?></p>
        <?php elseif (isset($error_message)): ?>
            <p class="error"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form action="" method="post">
            <input type="text" name="name" placeholder="Your Name" required>
            <input type="email" name="email" placeholder="Your Email" required>
            <input type="text" name="subject" placeholder="Subject" required>
            <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
            <input type="submit" value="Submit">
        </form>
    </div>
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
