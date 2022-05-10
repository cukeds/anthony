<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php

include("../php/dbconnect.php");
$conn = OpenCon();
// Update JSON STUDENTS
$sql = "SELECT @n := @n + 1 id, CONCAT(first_name, ' ', last_name) AS pet_owner, name AS pet_name, type AS pet_type, breed AS pet_breed, sex AS pet_sex, p.age AS pet_age, photo AS pet_image FROM owners AS o, pets AS p, ownership AS ow, (SELECT @n := -1) m WHERE p.pet_id = ow.pet_id AND ow.owner_id = o.owner_id AND o.owner_id IN (SELECT owner_id FROM owners WHERE isstaff IS FALSE)";
$result = $conn->query($sql);
$owner = array();
while($row = $result->fetch_assoc()){
  $owner[] = $row;

}
$fp = fopen('../json/students.json', 'w');
fwrite($fp, json_encode($owner));
fclose($fp);

$sql = "SELECT @n := @n + 1 id, CONCAT(first_name, ' ', last_name) AS pet_owner, name AS pet_name, type AS pet_type, breed AS pet_breed, sex AS pet_sex, p.age AS pet_age, photo AS pet_image FROM owners AS o, pets AS p, ownership AS ow, (SELECT @n := -1) m WHERE p.pet_id = ow.pet_id AND ow.owner_id = o.owner_id AND o.owner_id IN (SELECT owner_id FROM owners WHERE isstaff IS TRUE)";
$result = $conn->query($sql);
$owner = array();
while($row = $result->fetch_assoc()){
  $owner[] = $row;

}
$fp = fopen('../json/staffpets.json', 'w');
fwrite($fp, json_encode($owner));
fclose($fp);

?>
<head>
  <link rel="stylesheet" href="../CSS/pets.css">
  <title>STAC Pet Portal</title>
</head>

<body>



  <div id="header">
    <h1 class="header-text"> Pet </h1>
    <img id="paw" src="../images/Paw-print.svg" width="80px" height="80px" />
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


  <div class="search">
    <input autocomplete="off" type="text" id="search" placeholder="Search.." onkeyup="filter()">
    <div id="search_div">
      <div id="absolute_div">
      </div>
    </div>
  </div>

  <div>
    <select id="staff_or_student">
      <option value="staff"> Staff </option>
      <option selected value="student"> Student </option>
    </select>
  </div>
  <div id="list_of_owners">
    <table id="owners_table">
      <thead>
        <tr>
          <th>Owner</th>
          <th>Pet</th>
          <th>Type</th>
        </tr>
      </thead>
      <tbody>
      </tbody>

    </table>
  </div>

  <div id="pet">
    <h1 id="pet_name" class="pet_text">Pepper</h1>
    <div class="PetRow">
      <h2 class="pet_text"> Owner:</h2>
      <h2 id="pet_owner" class="pet_text">test </h2>
    </div>
    <div class="PetRow">
      <h2 class="pet_text"> Pet Type:</h2>
      <h2 id="pet_type" class="pet_text">test </h2>
    </div>
    <div class="PetRow">
      <h2 class="pet_text"> Breed:</h2>
      <h2 id="pet_breed" class="pet_text">test </h2>
    </div>
    <div class="PetRow">
      <h2 class="pet_text"> Sex:</h2>
      <h2 id="pet_sex" class="pet_text">test </h2>
    </div>
    <div class="PetRow">
      <h2 class="pet_text"> Age:</h2>
      <h2 id="pet_age" class="pet_text">test </h2>
    </div>
      <div id="pet_image" class="pet_text">
        <img id="p_image" src="../images/Pepper.jpg" width="350px" height="400px" />
      </div>

    </div>
    <script src="../scripts/cookies.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <script src="../scripts/pets.js"></script>


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
