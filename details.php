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
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .navbar {
            background-color: #343a40;
        }

        .navbar-brand {
            color: #ffffff;
        }

        .navbar-brand h2 {
            margin: 0;
            font-size: 1.5rem;
        }

        .navbar-nav .nav-link {
            color: #ffffff;
        }

        .navbar-nav .nav-link:hover {
            color: #d1d1d1;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .container {
            margin-top: 20px;
        }

        .table-wrapper {
            max-width: 90%;
            margin: 0 auto;
            overflow-x: auto;
        }

        .table {
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 75%;
            margin-left: 10%;
            margin-top: 20px;
        }

        .table th, .table td {
            text-align: center;
            padding: 12px;
        }

        .table thead {
            background-color: #808080;
            color: #ffffff;
        }

        .table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tbody tr:hover {
            background-color: #e9ecef;
        }

        footer {
            background-color: #343a40;
            color: #ffffff;
            padding: 10px 0;
            position: fixed;
            width: 100%;
            bottom: 0;
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
    <table class="table">
            <thead>
                <tr>
                    <th style="width: 10%;">Name</th>
                    <th style="width: 12.5%;">Email</th>
                    <th style="width: 10%;">Phone</th>
                    <th style="width: 15%;">Date of Birth</th>
                    <th style="width: 20%;">Address</th>
                    <th style="width: 20%;">Program</th>
                    <th style="width: 12.5%;">Submitted At</th>
                </tr>
            </thead>
            <tbody style="font-size: 12px;">
                <?php
                    $connection = new mysqli("localhost", "root", "", "form");

                    // Check connection
                    if ($connection->connect_error) {
                        die("Connection failed: " . $connection->connect_error);
                    }

                    $sql = "SELECT * FROM scout_applications";
                    $result = $connection->query($sql);

                    if (!$result) {
                        die("Invalid Query: " . $connection->error);
                    }

                    // Program ID to Name Mapping
                    $programs = [
                        1 => 'Outdoor Adventure',
                        2 => 'Community Service',
                        3 => 'Leadership Training',
                        4 => 'Environmental Education'
                    ];

                    while ($row = $result->fetch_assoc()) {
                        $program_name = $programs[$row['program']]; // Convert ID to Program Name
                        
                        echo '
                        <tr>
                            <td>' . $row['name'] . '</td>
                            <td>' . $row['email'] . '</td>
                            <td>' . $row['phone'] . '</td>
                            <td>' . $row['dob'] . '</td>
                            <td>' . $row['address'] . '</td>                        
                            <td>' . $program_name . '</td>                       
                            <td>' . $row['created_at'] . '</td>
                        </tr>
                        ';
                    }
                ?>

            </tbody>
        </table>
    </div>
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