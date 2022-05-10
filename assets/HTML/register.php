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
<html>

  <?php
  include '../php/dbconnect.php';
  $conn = OpenCon();
  ?>
  <head>
    <link rel="stylesheet" href="../CSS/register.css">
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

    <form action="register.php" method="post">
      <div class="form-group">
        <label for="user"> Username </label>
        <input type="text" class="form-control" name="user" placeholder="Enter Username"></input>
      </div>

      <div class="form-group">
        <label for="pass"> Password </label>
        <input type="text" class="form-control" name="pass" placeholder="Enter Password"></input>
      </div>
      <div class="form-group">
          <label for="fname">First Name</label>
          <input type="text" class="form-control" name="fname" placeholder="Enter your name"></input>
      </div>
      <div class="form-group">
          <label for="lname">Last Name</label>
          <input type="text" class="form-control" name="lname" placeholder="Enter your last name"></input>
      </div>
      <div class="form-group">
          <label for="sage">Age</label>
          <input type="text" class="form-control" name="sage" pattern="[0-9]{1,3}$" placeholder="Enter your age"></input>
      </div>
      <div class="form-group">
          <label for="sors">Student or Staff?</label>
          <select class="form-control" name="sors" id="sors">
            <option value=1>Staff</option>
            <option selected value=0>Student</option>
          </select>
      </div>
      <div class="form-group"  id="syear">
        <label for="syear">School Year</label>
        <select class="form-control" name="syear">
          <option selected value="">None</option>
          <option value="Freshman">Freshman</option>
          <option value="Sophomore">Sophomore</option>
          <option value="Junior">Junior</option>
          <option value="Senior">Senior</option>
          <option value="Graduated">Graduate Student</option>
        </select>
      </div>
      <div class="form-group" id="awork">
          <label for="awork">Area of Work</label>
          <input type="text" class="form-control" name="awork" placeholder="Enter your area of work"></input>
      </div>

      <div class="form-group">
        <button type="submit" value="Submit" name="Submit" class="btn btn-primary">Register</button>
      </div>
    </form>


    <?php
      if($_POST){
        $user = $_POST["user"];
        $password = $_POST["pass"];
        $first_name = $_POST["fname"];
        $last_name = $_POST["lname"];
        $age = $_POST["sage"];
        $isstaff = $_POST["sors"];
        $school_year = $_POST["syear"];
        $area_of_work = $_POST["awork"];

        $pass = password_hash($password, PASSWORD_DEFAULT);
        $sql =  "INSERT INTO owners(first_name, last_name, age, isstaff, school_year, area_of_work) VALUES('$first_name', '$last_name', '$age', '$isstaff', '$school_year', '$area_of_work')";
        $conn->query($sql);
        $sql = "INSERT INTO users(username, password, owner_id) VALUES('$user', '$pass', (SELECT owner_id FROM owners ORDER BY owner_id DESC LIMIT 1))";
        $conn->query($sql);

      }

    ?>


<script src="../scripts/cookies.js"></script>
<script src="../scripts/register.js"></script>

<?php if(isset($_COOKIE['owner_id'])){
  $sql = "SELECT * FROM owners WHERE owner_id = '$_COOKIE[owner_id]'";
  $result = $conn->query($sql);
  $result = json_encode($result->fetch_assoc());
  echo "<script type='text/javascript'>cookie($_COOKIE[owner_id], $result);</script>";
}

CloseCon($conn);
?>
</body>
</html>
