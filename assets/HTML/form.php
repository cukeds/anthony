<!DOCTYPE html>
<html lang="en" dir="ltr">

<?php
include '../php/dbconnect.php';
$conn = OpenCon();
?>

<head>
  <link rel="stylesheet" href="../CSS/form.css">
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

  <h1>Submit your own pet!</h1>
        <p>Welcome to STAC Pet Portal. If you are here it means you wanna input your Pet
        into our database.</p>
        <p>Please submit your pet information as seen below. Thank you!</p>

        <form name="PetPortalForm" action="form.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="fname" class="tbc">Your First Name</label>
                <input type="text" class="form-control tbh" name="fname" placeholder="Enter your name"></input>
            </div>
            <div class="form-group">
                <label for="lname" class="tbc">Your Last Name</label>
                <input type="text" class="form-control tbh" name="lname" placeholder="Enter your last name"></input>
            </div>
            <div class="form-group">
                <label for="sage" class="tbc">Your Age</label>
                <input type="text" class="form-control tbh" name="sage" pattern="[0-9]{1,3}$" placeholder="Enter your age"></input>
            </div>
            <div class="form-group">
                <label for="sors" class="tbc">Student or Staff?</label>
                <select class="form-control tbh" name="sors" id="sors">
                  <option value=1>Staff</option>
                  <option selected value=0>Student</option>
                </select>
            </div>
            <div class="form-group">
              <label for="syear" class="tbc">School Year</label>
              <select class="form-control tbh" name="syear" id="syear">
                <option selected value="">None</option>
                <option value="Freshman">Freshman</option>
                <option value="Sophomore">Sophomore</option>
                <option value="Junior">Junior</option>
                <option value="Senior">Senior</option>
                <option value="Graduated">Graduate Student</option>
              </select>
            </div>
            <div class="form-group">
                <label for="awork" class="tbc">Area of Work</label>
                <input type="text" class="form-control tbh" name="awork" placeholder="Enter your area of work"></input>
            </div>
            <hr class="bar">
            <div class="form-group">
                <label for="pname">Pet's Name</label>
                <input type="text" class="form-control" name="pname" placeholder="Enter your pet's name"></input>
            </div>
            <div class="form-group">
                <label for="ptype">Type</label>
                <select class="form-control" name="ptype" id="ptype">
                  <option selected value="cat">Cat</option>
                  <option value="Dog">Dog</option>
                  <option value="Hamster">Hamster</option>
                  <option value="Bird">Bird</option>
                  <option value="Rabbit">Rabbit</option>
                  <option value="Fish">Fish</option>
                  <option value="Other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="page">Age</label>
                <input type="text" class="form-control" name="page" pattern="[0-9]{1,3}$" placeholder="Enter your pet's age"></input>
            </div>
            <div class="form-group">
                <label for="pbreed">Breed</label>
                <input type="text" class="form-control" name="pbreed" placeholder="Enter your pet's breed (potential dropdown)"></input>
            </div>
            <div class="form-group">
                <label for="psex">Sex</label>
                <select class="form-control" name="psex" id="psex">
                  <option selected value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
            </div>

            <div class="form-group">
                <label for="pphoto">Submit your pet's photo</label>
                <input class="form-control hidden" type="file" id="pphoto" name="pphoto">
            </div>
            <hr class="bar">
            <div class="form-group">
              <button type="reset" value="Clear Form" class="btn btn-primary">Clear Form</button>
              <button type="submit" value="Submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>

          <?php

          if(isset($_FILES['pphoto'])){
             $errors= array();
             $file_name = $_FILES['pphoto']['name'];
             $file_size =$_FILES['pphoto']['size'];
             $file_tmp =$_FILES['pphoto']['tmp_name'];
             $file_type=$_FILES['pphoto']['type'];
             $file_ext=strtolower(end(explode('.',$_FILES['pphoto']['name'])));

             $extensions= array("jpg");

             if(in_array($file_ext,$extensions)=== false){
                $errors[]="extension not allowed, please choose a JPG file.";
             }

             if($file_size > 209715200){
                $errors[]='File size must be less than 200 MB';
             }

             if(empty($errors)==true){
                move_uploaded_file($file_tmp,$_SERVER["DOCUMENT_ROOT"] . "assets/images/".$file_name);
             }else{
                print_r($errors);
             }
          }

          if($_POST){

            $first_name = $_POST["fname"];
            $last_name = $_POST["lname"];
            $age = $_POST["sage"];
            $isstaff = $_POST["sors"];
            $school_year = $_POST["syear"];
            $area_of_work = $_POST["awork"];
            $name = $_POST["pname"];
            $type = $_POST["ptype"];
            $pet_age = $_POST["page"];
            $breed = $_POST["pbreed"];
            $sex = $_POST["psex"];
            $photo = $_POST["pname"] . ".jpg";
            if(!isset($_COOKIE)){
              $sql = "INSERT INTO owners(first_name, last_name, age, isstaff, school_year, area_of_work) VALUES('$first_name', '$last_name', '$age', '$isstaff', '$school_year', '$area_of_work')";
              $conn->query($sql);
            }
            $sql = "INSERT INTO pets(name, type, age, breed, sex, photo) VALUES('$name', '$type', '$pet_age', '$breed', '$sex', '$photo')";
            $conn->query($sql);
            if(isset($_COOKIE)){
              $sql = "INSERT INTO ownership VALUES('$_COOKIE[owner_id]', (SELECT pet_id FROM pets ORDER BY pet_id DESC LIMIT 1));";
            }else{
              $sql = "INSERT INTO ownership VALUES((SELECT owner_id FROM owners ORDER BY owner_id DESC LIMIT 1), (SELECT pet_id FROM pets ORDER BY pet_id DESC LIMIT 1));";
            }
            $conn->query($sql);
          }
          ?>

</body>



<script src="../scripts/cookies.js"></script>
<script src="../scripts/form.js"></script>

<?php if(isset($_COOKIE['owner_id'])){
  $sql = "SELECT first_name AS fname, last_name AS lname, age AS sage, isstaff AS sors, school_year AS syear, area_of_work AS awork FROM owners WHERE owner_id = '$_COOKIE[owner_id]'";
  $result = $conn->query($sql);
  $result = json_encode($result->fetch_assoc());
  echo "<script type='text/javascript'>cookie($_COOKIE[owner_id], $result);</script>";
}
?>


<?php CloseCon($conn);

?>
</html>
