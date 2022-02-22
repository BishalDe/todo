<?php
$error = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  require 'partials/_database.php';

  $username = $_POST['username'];
  $password = $_POST['password'];

$sql = "SELECT * from users where user_name='$username' and password='$password'";
$result = mysqli_query($conn, $sql);
$num = mysqli_num_rows($result);
if ($num == 1) {

  session_start();
  $_SESSION['loggedin']=true;
  $_SESSION['username']=$username;
  header("Location: homepage.php");
} else {
  $error = true;
}
}
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  <title>Login</title>
</head>

<body>
  <?php
  require 'partials/_nav.php';
  ?>
  <?php
  if ($error == true) {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>FAILED...!</strong>Username & Password mismatch<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
  }

  ?>
  <div class="container">
    <h1 class="text-center">Welcome..! To Login Page</h1>
    <form action="index.php" method="post">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username">
        <div id="emailHelp" class="form-text">We'll never share your username with anyone else.</div>
      </div>
      <div class="mb-3">
        <label for="exampleInputPassword1" class="form-label">Password</label>
        <input type="text" class="form-control" id="exampleInputPassword1" name="password">
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
      <a href="signup.php" class="btn btn-dark">SignUp</a>
    </form>
  </div>
</body>

</html>