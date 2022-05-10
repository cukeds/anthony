<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <link rel="stylesheet" href="main.css">
  <title>STAC Pet Portal</title>
</head>

<body>



  <div id="header">
    <h1 class="header-text"> Pet </h1>
    <img id="paw" src="assets/images/Paw-print.svg" width="80px" height="80px"/>
    <h1 class="header-text"> Portal </h1>
    <div id="buttons">
      <button class="header-button" type="button">Login</button>
      <button class="header-button" type="button">Register</button>
    </div>
  </div>
  <hr>
  <!–– up to here is the header of the webpage, everything below here goes into a different div ––>


  <div id="left">

    <div class="search">
      <input type="text" placeholder="Search..">
    </div>

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
    <script src="main.js"></script>
</body>




</html>
