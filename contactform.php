<?php
$connection = new mysqli("localhost", "root", "", "form");

$name = "";
$email = "";
$phone = "";
$dob = "";
$address = "";
$program = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $dob = $_POST["dob"];
    $address = $_POST["address"];
    $program = $_POST["program"];

    do {
        if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($dob) || empty($program)) {
            $errorMessage = "All fields are required";
            break;
        }

        try {
            $sql = "INSERT INTO scout_applications (name, email, phone, dob, address, program) VALUES ('$name', '$email', '$phone', '$dob', '$address', '$program')";
            $result = $connection->query($sql);

            if ($result) {
                $successMessage = "Application submitted successfully";
                $name = "";
                $email = "";
                $phone = "";
                $dob = "";
                $address = "";
                $program = "";
            } else {
                $errorMessage = "Application submission failed";
            }
        } catch (mysqli_sql_exception $e) {
            $errorMessage = "Error: " . $e->getMessage();
        }
    } while (false);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Scout</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="CSS/bootstrap.min.css" rel="stylesheet">
    <link href="CSS/style.css" rel="stylesheet">
    <link href="CSS/animate.min.css" rel="stylesheet">
    <link href="CSS/owl.carousel.min.css" rel="stylesheet">
    <link href="CSS/tempusdominus-bootstrap-4.min.css" rel="stylesheet">
    <link href="CSS/newStyle.css" rel="stylesheet">
    <style>
        /* General Styles */
            body {
                font-family: 'Arial', sans-serif;
                background-color: #f8f9fa;
                margin: 0;
                padding: 0;
            }

            /* Navbar Styles */
            .navbar {
                background-color: #ffffff;
            }

            .navbar-brand {
                color: #007bff;
                font-weight: bold;
            }

            .navbar-nav .nav-link {
                color: #007bff;
                font-weight: 500;
                padding: 0.5rem 1rem;
            }

            .navbar-nav .nav-link:hover {
                color: #0056b3;
            }

            /* Button Styles */
            .btn-primary {
                background-color: #007bff;
                border-color: #007bff;
            }

            .btn-primary:hover {
                background-color: #0056b3;
                border-color: #004085;
            }

            /* Application Form Styles */
            .container-fluid {
                padding-top: 2rem;
                padding-bottom: 2rem;
            }

            h1.display-4 {
                color: #007bff;
                font-weight: 700;
                font-size:42px;
            }

            form {
                background: #ffffff;
                padding: 2rem;
                border-radius: 8px;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            }

            .form-label {
                font-weight: bold;
                color: #333;
            }

            .form-control {
                border-radius: 4px;
                border: 1px solid #ced4da;
            }

            .form-select {
                border-radius: 4px;
                border: 1px solid #ced4da;
            }

            .btn {
                border-radius: 4px;
            }

            /* Footer Styles */
            footer {
                background-color: #343a40;
                color: #ffffff;
                padding: 1rem 0;
            }

            footer p {
                margin: 0;
            }
            .container, .container-fluid, .container-sm, .container-md, .container-lg, .container-xl, .container-xxl {
                width: 50%;
                padding-right: var(--bs-gutter-x, .75rem);
                padding-left: var(--bs-gutter-x, .75rem);
                margin-right: auto;
                margin-left: auto;
            }
    </style>
</head>
<body>
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="Scouts&Guides.php" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <img src="img/scouts-logo.png" alt="Scouts Logo" style="height: 60px; margin-right: 10px;">
            <h2 class="m-0" style="display: block; color: #808080;">Scout & Guides</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <li class="nav-item dropdown">
                    <a href="Scouts&Guides.php" class="nav-link" id="navbarHome">Home</a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="scout-programs.html">Scout Programs</a></li>
                        <li><a class="dropdown-item" href="contactform.php">Contact Form</a></li>
                        <li><a class="dropdown-item" href="details.php">Scout Details</a></li>
                     </ul>
                </li>  
            </div>
            <a href="Scouts&Guides.php#contactForm" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Reach Us<i class="fa fa-arrow-right ms-3"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->

    <!-- Application Form Start -->
    <div class="container my-5">
        <h1 class="display-4 text-center mb-5">Join Scout & Guides</h1>
        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }

        if (!empty($successMessage)) {
            echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>$successMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        <form action="" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" value="<?php echo htmlspecialchars($phone); ?>" required>
            </div>
            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth</label>
                <input type="date" class="form-control" id="dob" name="dob" value="<?php echo htmlspecialchars($dob); ?>" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter your address" required><?php echo htmlspecialchars($address); ?></textarea>
            </div>
            <div class="mb-3">
                <label for="program" class="form-label">Select Program</label>
                <select class="form-select" id="program" name="program" required>
                    <option value="1" <?php echo ($program == '1') ? 'selected' : ''; ?>>Outdoor Adventure</option>
                    <option value="2" <?php echo ($program == '2') ? 'selected' : ''; ?>>Community Service</option>
                    <option value="3" <?php echo ($program == '3') ? 'selected' : ''; ?>>Leadership Training</option>
                    <option value="4" <?php echo ($program == '4') ? 'selected' : ''; ?>>Environmental Education</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Submit Application</button>
        </form>
    </div>
    <!-- Application Form End -->

    <!-- Footer Start -->
    <footer class="bg-dark text-white text-center py-4">
        <p>&copy; 2024 Bharat Scouts & Guides. All Rights Reserved.</p>
    </footer>
    <!-- Footer End -->

    <!-- JavaScript Libraries -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/easing.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/counterup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/moment-timezone.min.js"></script>
    <script src="js/tempusdominus-bootstrap-4.min.js"></script>
    <script src="js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/newscripts.js"></script>
</body>
</html>
