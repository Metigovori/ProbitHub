<?php
// register.php

// Include the necessary files and classes

use Admin\Lib\User;

require_once 'path/to/User.php'; // Replace 'path/to/User.php' with the path to your User class
require_once 'path/to/Session.php'; // Replace 'path/to/Session.php' with the path to your Session class

// Initialize the Session class
$session = new \Admin\Lib\Session();

// Check if the user is already logged in, if yes, redirect them to a dashboard or home page
if ($session->isSignedIn()) {
    header('Location: dashboard.php');
    exit;
}

// Function to validate and sanitize form inputs
function validateInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to handle user registration and add the user to the database
function registerUser($username, $email, $password)
{
    // ... (Your user registration code)
}

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = validateInput($_POST['username']);
    $email = validateInput($_POST['email']);
    $password = $_POST['password'];

    // Call the registerUser function to add the user to the database
    registerUser($username, $email, $password);

    // Perform user login after successful registration
    // Replace the following with your actual user retrieval logic
    $user = new User(); // Create a new instance of your User class
    $user->setId(1); // Set the user ID (replace 1 with the actual user ID from the database)
    $session->login($user);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Page Title - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Create Account</h3>
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group"><label class="small mb-1" for="inputFirstName">First Name</label><input class="form-control py-4" id="inputFirstName" type="text" placeholder="Enter first name" /></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"><label class="small mb-1" for="inputLastName">Last Name</label><input class="form-control py-4" id="inputLastName" type="text" placeholder="Enter last name" /></div>
                                            </div>
                                        </div>
                                        <div class="form-group"><label class="small mb-1" for="inputEmailAddress">Email</label><input class="form-control py-4" id="inputEmailAddress" type="email" aria-describedby="emailHelp" placeholder="Enter email address" /></div>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group"><label class="small mb-1" for="inputPassword">Password</label><input class="form-control py-4" id="inputPassword" type="password" placeholder="Enter password" /></div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group"><label class="small mb-1" for="inputConfirmPassword">Confirm Password</label><input class="form-control py-4" id="inputConfirmPassword" type="password" placeholder="Confirm password" /></div>
                                            </div>
                                        </div>
                                        <div class="form-group mt-4 mb-0"><a class="btn btn-primary btn-block" href="login.html">Create Account</a></div>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="small"><a href="register.html">Have an account? Go to login</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2019</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>