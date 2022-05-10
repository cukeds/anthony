<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <link rel="stylesheet" href="main.css">
  <title>STAC Pet Portal</title>
</head>

<body>

  <?php
  include './assets/php/dbconnect.php';
  $conn = OpenCon();
  ?>

  <div id="header">
    <h1 class="header-text"> Pet </h1>
    <img id="paw" src="./assets/images/Paw-print.svg" width="80px" height="80px" />
    <h1 class="header-text"> Portal </h1>
    <div id="buttons">
      <button class="header-button tbh" type="button" id="login">Login</button>
      <button class="header-button tbh" type="button" id="register">Register</button>
      <?php
      if(isset($_COOKIE["owner_id"])){
        $sql = "SELECT first_name, last_name FROM owners WHERE owner_id = '$_COOKIE[owner_id]'";
        $result = $conn->query($sql);
        echo '<a class="header-name"> Hi ' . $result->fetch_assoc()["first_name"] . '</a>';
      }
        ?>
      <button class="header-button hidden" type="button" id="logout">Log Out</button>
    </div>
  </div>
  <hr>
  <!–– up to here is the header of the webpage, everything below here goes into a different div ––>


  <div id="left">

    <button id="students" class="left-button pets" type="button">Student Pets</button>
    <button id="staff" class="left-button pets" type="button">Staff Pets</button>
    <button id="submit" class="left-button" type="button">Submit your Pet!
      <img id="pawprint_btn" src="assets/images/Paw-print.svg" width="20px" height="20px" />
    </button>
  </div>

  <div id="pet">
    <h1 class="pet_text" >Pepper</h1>
    <div class="PetRow">
      <h2 class="pet_text"> Owner: Anthony Conroy (Senior) </h2>
      <h2 class="pet_text"> Pet Type: Dog </h2>
      <h2 class="pet_text"> Breed: Pomeranian </h2>
      <h2 class="pet_text"> Sex: Female </h2>
      <h2 class="pet_text"> Age: 2 </h2>
      <div id="pepper" class="pet_text">
        <img src="assets/images/Pepper.jpg" width="350px" height="400px" />
      </div>
    </div>
    </div>

    <script src="./assets/scripts/cookies.js"></script>
    <script src="main.js"></script>

    <?php if(isset($_COOKIE['owner_id'])){
      $sql = "SELECT first_name AS fname, last_name AS lname, age AS sage, isstaff AS sors, school_year AS syear, area_of_work AS awork FROM owners WHERE owner_id = '$_COOKIE[owner_id]'";
      $result = $conn->query($sql);
      $result = json_encode($result->fetch_assoc());
      echo "<script type='text/javascript'>cookie($_COOKIE[owner_id], $result);</script>";
    }

    CloseCon($conn);
    ?>
</body>




</html>
