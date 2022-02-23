<?php
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
$logedin= true;
}
else{
  $logedin= false;
}

echo '<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="homepage.php">BISHOP</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">';

if (!$logedin) {
  echo '
        <li class="nav-item ">
          <a class="btn btn-primary mx-3 my-2 active" href="index.php">Login</a>
        </li> 
        <li class="nav-item">
        <a class="btn btn-primary my-2" href="signup.php">Signup</a>
      </li>';
}


echo '</ul>
      <form class="d-flex">
        <input class="form-control me-2 my-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>';
      
if ($logedin) {
  echo '<li class="nav-item">
          <a class="btn btn-primary my-2" href="logout.php" >Logout</a>
        </li>';}
echo '
    </div>
  </div>
</nav>';

?>