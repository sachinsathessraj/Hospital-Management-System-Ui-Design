<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role_id'] != 1) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

 <header>
      <nav>
          
          <div class="toggle">
              <span class="first"></span>
              <span class="middle"></span>
              <span class="last"></span>
          </div>
          <div class="navigation-bar">
              <ul>
              <li class="active"><a href="index.html">Home<span class="underline"></span></a></li>
                  <li><a href="ecommerce/index.php">Product Panel<span class="underline"></span></a></li>
                  <li><a href="ecommerce/orders/index.php">Manage Orders<span class="underline"></span></a></li>
                  <li><a href="logout.php">logout<span class="underline"></span></a></li>
              </ul>
          </div>
      </nav>
      
      <div class="text">
          <h2>Welcome</h2>
          <h1>Admindashboard</h1>
          <div class="arrow">
              <span class="left"></span>
              <i class="fas fa-asterisk"></i>
              <span class="right"></span>
          </div>
          <div class="button" href="login.php"><button>Explore</button></div>
      </div>
      <svg class="svg-down" width="192" height="61" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 160.7 61.5" enable-background="new 0 0 160.7 61.5" xml:space="preserve"><path fill="currentColor" d="M80.3,61.5c0,0,22.1-2.7,43.1-5.4s41-5.4,36.6-5.4c-21.7,0-34.1-12.7-44.9-25.4S95.3,0,80.3,0c-15,0-24.1,12.7-34.9,25.4S22.3,50.8,0.6,50.8c-4.3,0-6.5,0,3.5,1.3S36.2,56.1,80.3,61.5z"></path></svg>
      <div class="arrow-down">
      </div>
  </header>
  <div class="about-us">
      <div class="text">
          <h2>Discover</h2>
          <h3>Our Story</h3>
          <div><i class="fas fa-asterisk"></i></div>
          <p>Gallery is a coffee roastery located on a busy corner site in Farringdon’s Exmouth Market. With glazed frontage on two sides of the building, overlooking the market and a bustling London intersection.</p>
          <div><a class="a-CTA" href="#">About Us</a></div>
      </div>
      <div class="image-container">
          <div class="image image1">
              <img src="images/img10.jpg" alt="Food Photo">
          </div>
          <div class="image image2">
              <img src="images/img6.jpg" alt="Food Photo">
          </div>
      </div>
  </div>
<body>


    <!-- Modal -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span id="messageContent"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        <?php if (isset($_GET['message'])): ?>
            var message = "<?php echo $_GET['message']; ?>";
            var messageModal = new bootstrap.Modal(document.getElementById('messageModal'), {});
            document.getElementById('messageContent').innerText = message;
            messageModal.show();
        <?php endif; ?>
    </script>
</body>
</html>
