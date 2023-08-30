<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include "./inc/header.php";

use Admin\Models\User;


$userId = $_SESSION['user_id'];
$user = User::find($userId);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    if ($user) {
        $user->username = $_POST['username'];
        $user->email = $_POST['email'];
        $user->password = $_POST['password'];
        $user->role = $_POST['role'];


        $user->save();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload_photo'])) {
    $uploadDir = __DIR__ . '/uploads/';
    echo "Upload Directory: " . $uploadDir . "<br>";
    $uploadedFileName = $_FILES['photo']['name'];
    $uploadedFilePath = $uploadDir . $uploadedFileName;


    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0755, true);
        echo "Directory Created<br>";
    }

    chmod($uploadDir, 0755);


    if ($_FILES['photo']['error'] !== UPLOAD_ERR_OK) {
        echo "File upload error: " . $_FILES['photo']['error'];
        exit;
    }

    var_dump($uploadDir);
    if (move_uploaded_file($_FILES['photo']['tmp_name'], $uploadedFilePath)) {

        $user->photo = $uploadedFileName;
        $user->save();

        chmod($uploadedFilePath, 0644);
        header('Location: profile.php');
        exit;
    } else {
        $uploadError = "Error uploading photo.";
    }
}


?>


<div class="container mt-5">
    <div class="row pt-5">
        <div class="col-lg-6">
            <!-- Left Section -->
            <h3 class="mb-4 gradient-text">Update Profile</h3>
            <p class="position-relative">Update your profile</p>
        </div>
        <div class="col-lg-6">
            <!-- Right Section -->
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <img src="uploads/<?php echo $user->photo; ?>" alt="Profile Photo" class="img-fluid rounded-circle mb-3" style="max-width: 200px;">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="photo" class="form-label">Change Profile Photo:</label>
                                <input type="file" class="form-control" id="photo" name="photo">
                            </div>
                            <button type="submit" class="upload_button" name="upload_photo">Update Photo</button>
                        </form>
                    </div>
                    <hr>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $_SESSION['username']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $_SESSION['email']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" id="role" name="role">
                                <option value="prompt_writer">User</option>
                                <option value="admin_writer">Admin</option>
                            </select>
                        </div>

                        <button type="submit" class="upload_button mt-2" name="update_profile">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>