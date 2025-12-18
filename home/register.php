<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | [Hospital Name]</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <!-- Background Image -->
    <div class="bg-image"></div>

    <!-- Overlay for Background -->
    <div class="overlay"></div>

    <!-- Registration Form Container -->
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-lg-6 col-md-8">
                <div class="card shadow-lg">
                    <div class="card-body p-5">
                        <!-- Hospital Logo -->
                        <div class="text-center mb-4">
                            <img src="assets/images/logo/logo.png" alt="Hospital Logo" class="img-fluid">
                        </div>
                        <!-- Registration Form Title -->
                        <h2 class="text-center mb-4">Create Your Account</h2>
                        <!-- Display Feedback Messages -->
                        <?php
                        session_start();
                        if (isset($_SESSION['error'])):
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php 
                                    echo $_SESSION['error']; 
                                    unset($_SESSION['error']);
                                ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php 
                        endif;
                        if (isset($_SESSION['success'])):
                        ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php 
                                    echo $_SESSION['success']; 
                                    unset($_SESSION['success']);
                                ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <!-- Registration Form -->
                        <form action="register_handler.php" method="POST">
                            <div class="info">
                                <!-- Username -->
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                                </div>
                                <!-- Password -->
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                                </div>
                                <!-- Confirm Password -->
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required>
                                </div>
                                <!-- First Name -->
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-id-badge"></i></span>
                                    <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                                </div>
                                <!-- Last Name -->
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-id-badge"></i></span>
                                    <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                                </div>
                                <!-- Email -->
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                                </div>
                                <!-- Phone -->
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="text" name="phone" class="form-control" placeholder="Phone">
                                </div>
                                <!-- Address -->
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-home"></i></span>
                                    <textarea name="address" class="form-control" placeholder="Address"></textarea>
                                </div>
                                <!-- Role Selection -->
                                <div class="input-group mb-3">
                                    <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                    <select name="role_id" class="form-select" required>
                                        <option value="">Select Role</option>
                                        <option value="2">patient</option>
                                        <option value="3">Staff</option>
                                    </select>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="btn mb-3">
                                <button type="submit" class="btn btn-primary w-100">Register</button>
                            </div>
                            <!-- Signup Link -->
                            <div class="signup text-center">
                                <p>Already have an account?</p>
                                <a href="login.php">Login here</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Modal for Messages (Optional if using Bootstrap alerts above) -->
    <!-- If you prefer using a modal instead of alerts, uncomment the below and adjust the PHP accordingly -->
    <!--
    <script>
        <?php if (isset($_GET['message'])): ?>
            var message = "<?php echo htmlspecialchars($_GET['message'], ENT_QUOTES, 'UTF-8'); ?>";
            var messageModal = new bootstrap.Modal(document.getElementById('messageModal'), {});
            document.getElementById('messageContent').innerText = message;
            messageModal.show();
        <?php endif; ?>
    </script>
    -->
    
    <!-- Optional Modal Structure -->
    <!--
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="messageModalLabel">Notification</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="messageContent">
            <!-- Message content will be injected here -->
          <!-- </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    -->
</body>
</html>
