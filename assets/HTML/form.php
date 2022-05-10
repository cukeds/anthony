<?php if (!isset($_SESSION)) {
session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
$_SESSION['postdata'] = $_POST;
unset($_POST);
header("Location: ".$_SERVER['REQUEST_URI']);
exit;
}

if (@$_SESSION['postdata']){
$_POST=$_SESSION['postdata'];
unset($_SESSION['postdata']);
}
?>

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
      <button class="header-button" type="button">Login</button>
      <button class="header-button" type="button">Register</button>
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
                <label for="fname">Your First Name</label>
                <input type="text" class="form-control" name="fname" placeholder="Enter your name"></input>
            </div>
            <div class="form-group">
                <label for="lname">Your Last Name</label>
                <input type="text" class="form-control" name="lname" placeholder="Enter your last name"></input>
            </div>
            <div class="form-group">
                <label for="sage">Your Age</label>
                <input type="text" class="form-control" name="sage" pattern="[0-9]{1,3}$" placeholder="Enter your age"></input>
            </div>
            <div class="form-group">
                <label for="sors">Student or Staff?</label>
                <select class="form-control" name="sors" id="sors">
                  <option value=1>Staff</option>
                  <option selected value=0>Student</option>
                </select>
            </div>
            <div class="form-group">
              <label for="syear">School Year</label>
              <select class="form-control" name="syear" id="syear">
                <option selected value="">None</option>
                <option value="freshman">Freshman</option>
                <option value="Sophomore">Sophomore</option>
                <option value="Junior">Junior</option>
                <option value="Senior">Senior</option>
                <option value="Graduated">Graduate Student</option>
              </select>
            </div>
            <div class="form-group">
                <label for="awork">Area of Work</label>
                <input type="text" class="form-control" name="awork" placeholder="Enter your area of work"></input>
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
              <button type="submit" value="Submit" name="Submit" class="btn btn-primary">Submit</button>
            </div>
          </form>

          <?php
          if($_POST){
            $target_dir = "../images";
            $target_file = $target_dir . basename($_FILES["pphoto"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            // Check if image file is a actual image or fake image
            if(isset($_POST["submit"])) {
              $check = getimagesize($_FILES["pphoto"]["tmp_name"]);
              if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
              } else {
                echo "File is not an image.";
                $uploadOk = 0;
              }
            }



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
            $sql = "INSERT INTO owners(first_name, last_name, age, isstaff, school_year, area_of_work) VALUES('$first_name', '$last_name', '$age', '$isstaff', '$school_year', '$area_of_work')";
            $conn->query($sql);
            $sql = "INSERT INTO pets(name, type, age, breed, sex, photo) VALUES('$name', '$type', '$pet_age', '$breed', '$sex', '$photo')";
            $conn->query($sql);
            $sql = "INSERT INTO ownership VALUES((SELECT owner_id FROM owners ORDER BY owner_id DESC LIMIT 1), (SELECT pet_id FROM pets ORDER BY pet_id DESC LIMIT 1));";
            $conn->query($sql);

          }
          ?>

<script src="../scripts/form.js"></script>
</body>



<?php CloseCon($conn); ?>
</html>
