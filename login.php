<?php

use Admin\Models\User;

include "inc/header.php";

$session = new \Admin\Models\Session();
if ($session->isSignedIn()) {
    header("Location: index.php");
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
    <title>Login - Your Website</title>
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">

                        <?php
                        if (isset($_POST['login'])) {
                            $username = $_POST['username'];
                            $password = $_POST['password'];

                            $user = new \Admin\Models\User();
                            $user = $user->verifyUser($username, $password);
                            if ($user) {
                                $session->login($user);
                                $_SESSION['user_id'] = $user->id;
                                $_SESSION['username'] = $user->username;
                                $_SESSION['email'] = $user->email;
                                $_SESSION['role'] = $user->role;
                                $_SESSION['photo'] = $user->photo;

                                header("Location: index.php");
                            } else {
                                $session->message("Your email or password is incorrent");
                            }
                        } else {
                            $email = "";
                            $password = "";
                            $session->message();
                        }

                        if (isset($_POST['register'])) {
                            $user = new User();
                            $user->username = $_POST['username'];
                            $user->email = $_POST['email'];
                            $user->password = $_POST['password'];
                            $user->save();
                        }




                        ?>
                        <div class="col-lg-5 d-flex justify-content-center">
                            <div class="wrapper">
                                <div class="card-switch">
                                    <label class="switch">
                                        <input class="toggle" type="checkbox">
                                        <span class="slider"></span>
                                        <span class="card-side"></span>
                                        <div class="flip-card__inner">
                                            <div class="flip-card__front">
                                                <div class="title">Log in</div>
                                                <form action="" class="flip-card__form" method="post">
                                                    <input type="text" placeholder="Username" name="username" class="flip-card__input">
                                                    <input type="password" placeholder="Password" name="password" class="flip-card__input">
                                                    <button class="flip-card__btn" name="login">Let's go!</button>
                                                </form>
                                            </div>
                                            <div class="flip-card__back">
                                                <div class="title">Sign up</div>
                                                <form action="" class="flip-card__form" method="post">
                                                    <input type="name" placeholder="Username" class="flip-card__input" name="username">
                                                    <input type="email" placeholder="Email" name="email" class="flip-card__input">
                                                    <input type="password" placeholder="Password" name="password" class="flip-card__input">
                                                    <button class="flip-card__btn" name="register">Confirm!</button>
                                                </form>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website <?php echo date("Y"); ?></div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="./admin/js/scripts.js"></script>
</body>

</html>