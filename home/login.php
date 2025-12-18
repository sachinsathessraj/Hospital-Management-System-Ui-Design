<!DOCTYPE html>
<html lang="en">

<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
  <link rel="stylesheet" href="login.css">
  <title>Login</title>
</head>

<body>
  <header class="showcase">
    <div class="showcase-content">
      <div class="showcase-top">
        <h1>LOGIN</h1>
      </div>
      <div class="formm">
      <form action="login_handler.php" method="POST">
          <div class="info">
            <!-- Add this inside the formm div, before the form -->
<?php
session_start();
if (isset($_SESSION['error'])) {
    echo '<div class="error">'.$_SESSION['error'].'</div>';
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo '<div class="success">'.$_SESSION['success'].'</div>';
    unset($_SESSION['success']);
}
?>

            <input type="text" class="email" id="username" name="username" placeholder="Username">
            <input class="email" type="password" placeholder="Password" id="password" name="password">
            <select class="form-control" id="role_id" name="role_id" required>
                        <option value="">Select Role</option>
                        <option value="2">Patient</option>
                        <option value="3">Staff</option>
                    </select>
          </div>
          <div class="btn">
          <button type="submit" class="btn btn-primary mb-2">Login</button>
          </div>
          <div class="help">
            <div>
              <input value="true" type="checkbox"><label>Remember me</label>
            </div>
          </div>
          <div class="signup">
            <p>New to User ?</p>
            <a href="register.php">Sign up now</a>
          </div>
        </form>
      </div>
    </div>
  </header>
  <script src="login.js"></script>
</body>

</html>