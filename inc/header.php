<?php
session_start();

use Admin\Models\Session;

require_once("./admin/vendor/autoload.php");
require_once "./admin/autoloader.php";

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $user = \Admin\Models\User::find($userId);
    $isSignedIn = true;
} else {
    $isSignedIn = false;
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../styles/index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="../admin/js/scripts.js"></script>


</head>

<body>
    <div class="main">
        <div class="gradient"></div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light pb-3">
        <div class="container">

            <button class="navbar-toggler sidebar-button d-block" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <a class="navbar-brand" href="/">
                <img src="./assets/Probit-Hub.png" alt="Logo" class="logo">
            </a>


            <div class="ml-auto d-flex align-items-center">
                <div class="mr-3">
                    <?php if ($isSignedIn) { ?>
                        <a href="/create.php?user_id=<?php echo $_SESSION['user_id']; ?>" class="btn btn-light text-dark border-dark rounded-pill mt-3 me-2">Create Post</a>
                        <a href="/logout.php" class="btn btn-dark text-light rounded-pill mt-3">Sign Out</a>
                        <a href="profile.php">
                            <img src="uploads/<?php echo $user->photo; ?>" alt="Profile Photo" class="img-fluid rounded-circle mt-2 ms-3" style="max-width: 50px;">
                        </a>
                    <?php } else { ?>
                        <a href="/login.php" class="btn btn-dark text-light rounded-pill mt-3">Sign In</a>
                    <?php } ?>
                </div>




            </div>
        </div>
    </nav>


    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Categories</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <?php

            use Admin\Models\Category;

            $categories = Category::all();

            echo '<a href="?category_id=" class="sidebar-item d-block mb-3 border-bottom">All Categories</a>';

            foreach ($categories as $category) {
                echo '<a href="?category_id=' . $category->id . '" class="sidebar-item d-block mb-3">' . $category->name . '</a>';
            }
            ?>
        </div>
    </div>