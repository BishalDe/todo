<?php
$alert = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require 'partials/_database.php';
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $date = date("Y-m-d");
    $time = date("h:i:s");
    $exists = false;
    $alert = false;
    if (($cpassword == $password) && $exists == false && $username != '' && $password != '') {
        $sql="CREATE TABLE IF NOT EXISTS users (sno int(200) PRIMARY KEY AUTO_INCREMENT, user_name VARCHAR(50) NOT NULL, password VARCHAR(50) NOT NULL, date DATE, time TIME)";
        mysqli_query($conn, $sql);
        $sql = "INSERT INTO users (user_name,password,date,time) VALUES ('$username', '$password','$date','$time')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $alert = true;
        } else {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
           <strong>FAILED</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>';
        }
    } else {

        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>FAILED</strong><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
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
    <title>SignUp</title>
</head>

<body>
    <?php require 'partials/_nav.php'; ?>
    <?php
    if ($alert == true) {
        echo '<div class="alert alert-alert alert-dismissible fade show" role="alert">
                <strong>Successfull!</strong> SignUp completed...!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
    }
    ?>
    <div class="container">
        <h1 class="text-center">Welcome! To SignUp Page</h1>
        <form action="signup.php" method="post">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username">
                <div id="emailHelp" class="form-text">We'll never share your username with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="text" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword2" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="exampleInputPassword2" name="cpassword">
                <div id="emailHelp" class="form-text">Make Sure to enter your password correctly.</div>
            </div>
            <button type="submit" class="btn btn-primary">SignUp</button>
            <a href="index.php" class="btn btn-primary">Login</a>
            <button type="reset" class="btn btn-light">Reset Form</button>
        </form>
    </div>


</body>

</html>