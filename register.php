<?php include "config.php"; ?>

<h2>Register</h2>

<form method="POST">
    <input type="text" name="name" placeholder="Full Name" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>

    <select name="role">
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select><br><br>

    <button name="register">Register</button>
</form>

<?php
if(isset($_POST['register'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $role = $_POST['role'];

    // Check if email already exists
    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if($check->num_rows > 0){
        echo "<p style='color:red;'>Email already exists!</p>";
    } else {
        $conn->query("INSERT INTO users(name,email,password,role) VALUES(
            '$name','$email','$pass','$role'
        )");

        echo "<p style='color:green;'>Registered Successfully!</p>";
        echo "<a href='index.php'>Login Now</a>";
    }
}
?>