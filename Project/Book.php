<?php
// Get selected package from the URL if available
$selectedPackage = isset($_GET['package']) ? htmlspecialchars($_GET['package']) : '';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Book</title>
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="style.css">
<script>
        const packages = {
            "Cultural Immersion": ["Vigan City", "Intramuros", "Batanes"],
            "Beach Getaway": ["Boracay", "Palawan", "Siargao"],
            "Wellness Retreat": ["Baguio", "Dumaguete"],
            "Adventure Tour": ["Mount Apo", "Chocolate Hills"],
            "Island Hopping": ["Cebu", "Coron"],
            "Food Tour": ["Binondo", "Cebu"],
            "Historical Tour": ["Intramuros", "Vigan"],
            "Staycation Package": ["Tagaytay", "Baguio"]
            // Add more packages and their locations as needed
        };

        function updateLocations() {
            const packageSelect = document.getElementById('packageSelect');
            const locationSelect = document.getElementById('locationSelect');
            const selectedPackage = packageSelect.value;

            // Clear previous locations
            locationSelect.innerHTML = '<option value="">Select Location</option>';

            // Add new locations based on selected package
            if (selectedPackage in packages) {
                packages[selectedPackage].forEach(location => {
                    const option = document.createElement('option');
                    option.value = location;
                    option.textContent = location;
                    locationSelect.appendChild(option);
                });
            }
        }

        function updateDetails() {
            const package = document.getElementById('packageSelect').value;
            const duration = parseInt(document.getElementById('durationSelect').value);
            const scheduleContainer = document.getElementById('scheduleContainer');
            const scheduleList = document.getElementById('scheduleList');

            // Clear previous schedule
            scheduleList.innerHTML = '';

            let schedules = [];

            // Schedule activities based on the selected package
            if (package === "Cultural Immersion") {
                if (duration >= 3) {
                    schedules.push("Day 1: Orientation and welcome lunch, Traditional dance performance.");
                    schedules.push("Day 2: Cooking class, Visit to local artisan workshops, Dinner at a local restaurant.");
                    schedules.push("Day 3: Guided tour of the local market, Farewell lunch.");
                }
            } else if (package === "Beach Getaway") {
                if (duration >= 3) {
                    schedules.push("Day 1: Beach welcome party.");
                    schedules.push("Day 2: Island hopping tour, Snorkeling.");
                    schedules.push("Day 3: Relaxation and sunset cruise.");
                }
            } else if (package === "Wellness Retreat") {
                if (duration >= 3) {
                    schedules.push("Day 1: Welcome dinner.");
                    schedules.push("Day 2: Spa day, Yoga session.");
                    schedules.push("Day 3: Nature trek.");
                }
            } else if (package === "Adventure Tour") {
                if (duration >= 3) {
                    schedules.push("Day 1: Briefing.");
                    schedules.push("Day 2: Hiking day.");
                    schedules.push("Day 3: Relaxation and reflection.");
                }
            } else if (package === "Island Hopping") {
                if (duration >= 3) {
                    schedules.push("Day 1: Welcome dinner.");
                    schedules.push("Day 2: Island hopping tour.");
                    schedules.push("Day 3: Snorkeling and beach time.");
                }
            } else if (package === "Food Tour") {
                if (duration >= 3) {
                    schedules.push("Day 1: Food tasting tour.");
                    schedules.push("Day 2: Visit local restaurants.");
                    schedules.push("Day 3: Cooking class.");
                }
            } else if (package === "Historical Tour") {
                if (duration >= 3) {
                    schedules.push("Day 1: City tour.");
                    schedules.push("Day 2: Visit to historical sites.");
                    schedules.push("Day 3: Cultural show.");
                }
            } else if (package === "Staycation Package") {
                if (duration >= 3) {
                    schedules.push("Day 1: Leisure time.");
                    schedules.push("Day 2: Visit to local attractions.");
                    schedules.push("Day 3: Spa day.");
                }
            }

            // If the duration is greater than 3, add personal time
            if (duration > 3) {
                const extraDays = duration - 3;
                schedules.push(`Day ${duration - 2}: Personal time for relaxation and exploration.`);
                if (extraDays > 1) {
                    schedules.push(`Day ${duration - 1}: Personal time for relaxation and exploration.`);
                    if (extraDays > 2) {
                        schedules.push(`Day ${duration}: Personal time for relaxation and exploration.`);
                    }
                }
            }

            // Show schedule container if there are schedules
            if (schedules.length > 0) {
                scheduleContainer.style.display = 'block';
                schedules.forEach(schedule => {
                    const scheduleItem = document.createElement('div');
                    scheduleItem.innerText = schedule;
                    scheduleList.appendChild(scheduleItem);
                });
            } else {
                scheduleContainer.style.display = 'none';
            }
        }

        function checkArrival() {
            const arrivalDate = new Date(document.getElementById('arrivalDate').value);
            const duration = parseInt(document.getElementById('durationSelect').value);
            const departureDate = document.getElementById('departureDate');

            if (duration > 0) {
                // Set the latest allowed departure date based on the arrival date
                const maxDepartureDate = new Date(arrivalDate);
                maxDepartureDate.setDate(arrivalDate.getDate() + duration);

                // Update the minimum departure date
                departureDate.setAttribute('min', arrivalDate.toISOString().split('T')[0]);
                departureDate.setAttribute('max', maxDepartureDate.toISOString().split('T')[0]);
            }
        }

        function checkDeparture() {
            const arrivalDate = new Date(document.getElementById('arrivalDate').value);
            const departureDate = new Date(document.getElementById('departureDate').value);
            const duration = parseInt(document.getElementById('durationSelect').value);

            // Calculate the expected departure date based on arrival and duration
            const expectedDepartureDate = new Date(arrivalDate);
            expectedDepartureDate.setDate(arrivalDate.getDate() + duration);

            // If the selected departure date is not valid, show an alert
            if (departureDate < expectedDepartureDate) {
                alert('Departure date must be at least ' + duration + ' days after arrival.');
                document.getElementById('departureDate').value = '';
            }
        }

        // Validation function
        function validateForm() {
            // Your validation logic here
            return true;
        }
    </script>
    
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
<div class="heading" style="background:url(Picture/Header/B.jpg)no-repeat">
<h1>Book now</h1>
</div>
<body>
    <section class="booking">
        <h1 class="heading-title">Book Your Trip!</h1>
        <form name="bookingForm" action="bookform.php" method="post" class="book-form" onsubmit="return validateForm();">
            <div class="flex">
                <div class="inputBox">
                    <span>Name:</span>
                    <input type="text" placeholder="Enter your name" name="name" required>
                </div>

                <div class="inputBox">
                    <span>Email:</span>
                    <input type="email" placeholder="Enter your email" name="email" required>
                </div>

                <div class="inputBox">
                    <span>Contact No:</span>
                     <input type="tel" placeholder="Enter your phone" name="phone" pattern="[0-9]{11,}" required>
                     <small>Format: 11 digits or more (e.g., 09123456789)</small>
                </div>

                <div class="inputBox">
                    <span>Address:</span>
                    <input type="text" placeholder="Enter your address" name="address" required>
                </div>

                <div class="inputBox">
                    <span>Package:</span>
                    <select name="package" id="packageSelect" onchange="updateLocations(); updateDetails();" required>
                    <option value="">Select Package</option>
                <option value="Cultural Immersion" <?php if ($selectedPackage == 'Cultural Immersion') echo 'selected'; ?>>Cultural Immersion</option>
                <option value="Beach Getaway" <?php if ($selectedPackage == 'Beach Getaway') echo 'selected'; ?>>Beach Getaway</option>
                <option value="Wellness Retreat" <?php if ($selectedPackage == 'Wellness Retreat') echo 'selected'; ?>>Wellness Retreat</option>
                <option value="Adventure Tour" <?php if ($selectedPackage == 'Adventure Tour') echo 'selected'; ?>>Adventure Tour</option>
                <option value="Island Hopping" <?php if ($selectedPackage == 'Island Hopping') echo 'selected'; ?>>Island Hopping</option>
                <option value="Food Tour" <?php if ($selectedPackage == 'Food Tour') echo 'selected'; ?>>Food Tour</option>
                <option value="Historical Tour" <?php if ($selectedPackage == 'Historical Tour') echo 'selected'; ?>>Historical Tour</option>
                <option value="Staycation Package" <?php if ($selectedPackage == 'Staycation Package') echo 'selected'; ?>>Staycation Package</option>
            </select>
                </div>

                <div class="inputBox">
                    <span>Location:</span>
                    <select name="location" id="locationSelect" required>
                        <option value="">Select Location</option>
                    </select>
                </div>

                <script>
// Define locations for each package
const packageLocations = {
    "Cultural Immersion": ["Vigan City", "Cebu City", "Batanes"],
    "Beach Getaway": ["Boracay", "El Nido", "Siargao"],
    "Wellness Retreat": ["Palawan", "Batangas", "Davao"],
    "Adventure Tour": ["Zambales", "Banaue", "Camiguin"],
    "Island Hopping": ["Bacuit Archipelago", "Coron", "Hundred Islands"],
    "Food Tour": ["Manila", "Cebu", "Davao"],
    "Historical Tour": ["Intramuros", "Corregidor Island", "Rizal Park"],
    "Staycation Package": ["Makati", "Tagaytay", "Cebu City"]
};

// Function to update location options based on selected package
function updateLocationOptions() {
    const packageSelect = document.getElementById("packageSelect");
    const locationSelect = document.getElementById("locationSelect");

    // Get selected package and corresponding locations
    const selectedPackage = packageSelect.value;
    const locations = packageLocations[selectedPackage] || [];

    // Clear existing options
    locationSelect.innerHTML = '<option value="">Select Location</option>';

    // Populate new options based on selected package
    locations.forEach(location => {
        const option = document.createElement("option");
        option.value = location;
        option.textContent = location;
        locationSelect.appendChild(option);
    });
}

// Event listener for package selection change
document.getElementById("packageSelect").addEventListener("change", updateLocationOptions);

// Trigger update on page load in case package is pre-selected
window.addEventListener("load", updateLocationOptions);
</script>


                <div class="inputBox">
                    <span>Number of Days:</span>
                    <select name="duration" id="durationSelect" onchange="updateDetails();" required>
                        <option value="3">3 Days</option>
                        <option value="4">4 Days</option>
                        <option value="5">5 Days</option>
                        <option value="6">6 Days</option>
                        <option value="7">7 Days</option>
                    </select>
                </div>

                <div class="inputBox">
                    <span>How Many:</span>
                    <input type="number" placeholder="Number of guests" name="guest" min="1" required>
                </div>

                <div class="inputBox">
                    <span>Arrival:</span>
                    <input type="date" name="arrival" id="arrivalDate" onchange="checkArrival();" required>
                </div>

                <div class="inputBox">
                    <span>Departure:</span>
                    <input type="date" name="departure" id="departureDate" onchange="checkDeparture();" required>
                </div>
            </div>
            
            <div class="inputBox" id="scheduleContainer" style="display: none;">
                <span>Schedule of Activities:</span>
                <div id="scheduleList"></div>
            </div>

            <input type="submit" value="Submit" class="btn" name="send">
        </form>
    </section>
</body>
</html>

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

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="script1.js">
</script>
</body>
</html>