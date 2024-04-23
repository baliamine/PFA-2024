<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Created</title>
    <style>
        /* Your CSS styles */
    </style>
</head>
<body>
<?php
require('../connexion.php'); // Include your connection script

// Initialize variables
$name = isset($_POST['name']) ? $_POST['name'] : '';
$birth = isset($_POST['birth']) ? $_POST['birth'] : '';
$cin = isset($_POST['cin']) ? $_POST['cin'] : '';
$phone = isset($_POST['phone']) ? $_POST['phone'] : '';
$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
$state = isset($_POST['state']) ? $_POST['state'] : 'Tunis';
$pwd = isset($_POST['pwd']) ? $_POST['pwd'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';

// Check if user already exists
$stmt = $conn->prepare("SELECT * FROM user WHERE email=:email");
$stmt->execute(['email' => $email]);
$rowCount = $stmt->rowCount();

if ($rowCount > 0) {
    ?>
    <div class="container">
        <div class="center-text">
            <h1>User exists</h1>
            <a href="sign_up.html" class="button">Go back</a><br>
            <img src="sad.svg" alt="Image" class="image">
        </div>
    </div>
    <?php
} else {
    // Insert new user
    $stmt = $conn->prepare("INSERT INTO user (email, name, birth, phone, gender, state, pwd, cin) 
                            VALUES (:email, :name, :birth, :phone, :gender, :state, :pwd, :cin)");
    $success = $stmt->execute([
        'email' => $email,
        'name' => $name,
        'birth' => $birth,
        'phone' => $phone,
        'gender' => $gender,
        'state' => $state,
        'pwd' => $pwd,
        'cin' => $cin
    ]);

    if ($success) {
        ?>
        <div class="container">
            <div class="center-text">
                <h1>Welcome</h1>
                <a href="sign_in.html" class="button">Sign in</a><br>
                <img src="happy.svg" alt="Image" class="image">
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="container">
            <div class="center-text">
                <h1>Registration failed</h1>
                <a href="sign_up.html" class="button">Go back</a><br>
                <img src="sad.svg" alt="Image" class="image">
            </div>
        </div>
        <?php
    }
}
?>
</body>
</html>
