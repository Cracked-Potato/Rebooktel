<?php
// bookform.php

// Database connection details
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "book_db"; // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['send'])) {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $package = $_POST['package'];
    $location = $_POST['location'];
    $guest = $_POST['guest'];
    $arrival = $_POST['arrival'];
    $departure = $_POST['departure'];
    
    // Initialize the schedule variable
    $schedule = [];

    // Determine the schedule based on the selected package
    if ($package === "Cultural Immersion") {
        $schedule[] = "Day 1: Arrival in Vigan City, Orientation and welcome lunch, Traditional dance performance.";
        $schedule[] = "Day 2: Cooking class, Visit to local artisan workshops, Dinner at a local restaurant.";
        $schedule[] = "Day 3: Guided tour of the local market, Farewell lunch.";
    } elseif ($package === "Beach Getaway") {
        $schedule[] = "Day 1: Arrival in Boracay, Welcome drinks, Beach games.";
        $schedule[] = "Day 2: Snorkeling tour, Lunch at a beachfront restaurant, Sunset cruise.";
        $schedule[] = "Day 3: Free day for relaxation, Optional water sports activities.";
    } elseif ($package === "Wellness Retreat") {
        $schedule[] = "Day 1: Arrival in Palawan, Welcome yoga session, Healthy dinner.";
        $schedule[] = "Day 2: Spa treatments, Guided meditation, Nature walk.";
        $schedule[] = "Day 3: Yoga class, Healthy cooking workshop.";
    } elseif ($package === "Adventure Tour") {
        $schedule[] = "Day 1: Arrival in Zambales, Briefing for activities, Beach bonfire.";
        $schedule[] = "Day 2: Zip-lining, Hiking, Dinner at a local restaurant.";
        $schedule[] = "Day 3: Scuba diving, Free time to explore.";
    } elseif ($package === "Island Hopping") {
        $schedule[] = "Day 1: Arrival in Bacuit Archipelago, Welcome dinner.";
        $schedule[] = "Day 2: Island hopping tour, Snorkeling, Beach picnic.";
        $schedule[] = "Day 3: Free time for exploration, Optional kayaking.";
    } elseif ($package === "Food Tour") {
        $schedule[] = "Day 1: Arrival in Manila, Welcome dinner at a local restaurant.";
        $schedule[] = "Day 2: Food tasting tour, Visit to a local market.";
        $schedule[] = "Day 3: Cooking demonstration, Free time for personal exploration.";
    } elseif ($package === "Historical Tour") {
        $schedule[] = "Day 1: Arrival in Intramuros, Historical overview, Welcome dinner.";
        $schedule[] = "Day 2: Guided tour of historical sites, Visit to museums.";
        $schedule[] = "Day 3: Heritage walk, Free time for personal exploration.";
    } elseif ($package === "Staycation Package") {
        $schedule[] = "Day 1: Arrival in Makati, Welcome drinks, Spa services.";
        $schedule[] = "Day 2: Fine dining experience, City tour.";
        $schedule[] = "Day 3: Relaxation day, Optional activities.";
    }

    // If the duration is greater than 3, add personal time
    $duration = (int)$_POST['duration'];
    if ($duration > 3) {
        $extraDays = $duration - 3;
        for ($i = 4; $i <= $duration; $i++) {
            $schedule[] = "Day $i: Personal time for relaxation and exploration.";
        }
    }

    // Insert booking details into the database
    $stmt = $conn->prepare("INSERT INTO book_form (name, email, phone, address, package, location, guest, arrival, departure) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssiss", $name, $email, $phone, $address, $package, $location, $guest, $arrival, $departure);

    if ($stmt->execute()) {
        // Booking successful
        echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<section class="header">
<a href="website1.php" class="logo">rebooktel</a>

<nav class="navbar">
<a href="Website1.php">home</a >
<a href="About.php">about</a >
<a href="Packages.php">packages</a >
<a href="Book.php">book</a >
</nav>
<div id="menu-btn" class="fas fa-bars"></div>
</section>

<div class="heading" style="background:url(Picture/Services/SC.jpg)no-repeat">
<h1>Thank You!</h1>
</div>

<div class="container">
    <h1>Booking Successful!</h1>
    <p>Here are your details:</p>
    <p><strong>Name:</strong> ' . htmlspecialchars($name) . '</p>
    <p><strong>Email:</strong> ' . htmlspecialchars($email) . '</p>
    <p><strong>Phone:</strong> ' . htmlspecialchars($phone) . '</p>
    <p><strong>Address:</strong> ' . htmlspecialchars($address) . '</p>
    <p><strong>Package:</strong> ' . htmlspecialchars($package) . '</p>
    <p><strong>Location:</strong> ' . htmlspecialchars($location) . '</p>
    <p><strong>Number of Guests:</strong> ' . htmlspecialchars($guest) . '</p>
    <p><strong>Arrival Date:</strong> ' . htmlspecialchars($arrival) . '</p>
    <p><strong>Departure Date:</strong> ' . htmlspecialchars($departure) . '</p>';

        // Display the schedule of activities
        if (!empty($schedule)) {
            echo "<h2>Schedule of Activities:</h2><ul>";
            foreach ($schedule as $activity) {
                echo "<li>" . htmlspecialchars($activity) . "</li>";
            }
            echo "</ul>";
        }

        echo '<a href="website1.php" class="btn">Back to Home</a>
</div>
</section>

<section class="footer">    
<div class="box-container">
<div class="box">
    <h3>Quick Links</h3>
    <a href="Website1.php"><i class="fas fa-angle-right"></i>home</a >
    <a href="About.php"><i class="fas fa-angle-right"></i>about</a >
    <a href="Packages.php"><i class="fas fa-angle-right"></i>packages</a >
    <a href="Book.php"><i class="fas fa-angle-right"></i>book</a >

</div>

<div class="box">
    <h3>Extra Links</h3>
    <a href="About.php"><i class="fas fa-angle-right"></i>about us</a >
    <a href="Privacy-Policy.php"><i class="fas fa-angle-right"></i>privacy policy</a >
    <a href="Term-use.php"><i class="fas fa-angle-right"></i>terms of use</a >
    <a href="tel:+639955583001"><i class="fas fa-angle-right"></i>contact us</a >


</div>
<div class="box">
    <h3>contact info</h3>
    <a href="tel:+639955583001"><i class="fas fa-phone"></i>+63995-558-3001</a >
    <a href="tel:+639955583001"><i class="fas fa-phone"></i>+63995-558-3001</a >
    <a href="mailto:gabxdedma@gmail.com"><i class="fas fa-envelope"></i>gabxdedma@gmail.com</a >
    <a href="https://maps.app.goo.gl/cuvx6H1tYw2Eht4k7" target="_blank"><i class="fas fa-map"></i>Muntinlupa, 1772 Metro Manila</a >
</div>
<div class="box">
    <h3>follow us</h3>
    <a href="#"><i class="fab fa-facebook-f"></i>facebook</a >
    <a href="#"><i class="fab fa-github"></i>github</a >
    <a href="#"><i class="fab fa-instagram"></i>instagram</a >
    <a href="#"><i class="fab fa-linkedin"></i>Linkedin</a >
    


</div>
</div>
</section>

<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="script.js"> </script>
</body>
</html>
</body>
</html>';
    } else {
   
        echo "Error: " . $stmt->error;
    }

  
    $stmt->close();
    $conn->close();
}
?>
