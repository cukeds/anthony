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
    <link rel="stylesheet" href="../CSS/login.css">
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

    <form action="login.php" method="post">
      <div class="form-group">
        <label for="user" class="tbc"> Username </label>
        <input type="text" class="form-control tbh" name="user" placeholder="Enter Username"></input>
      </div>

      <div class="form-group tbh">
        <label for="pass"> Password </label>
        <input type="text" class="form-control tbh" name="pass" placeholder="Enter Password"></input>
      </div>

      <div class="form-group tbh">
        <button type="submit" value="Submit" name="Submit" class="btn btn-primary">Login</button>
      </div>
    </form>


    <?php
      if($_POST){
        $user = $_POST["user"];
        $password = $_POST["pass"];
        $sql =  "SELECT password, owner_id FROM users WHERE username = '$user'";

        $info = array();
        $result = $conn->query($sql);
        while($row = $result->fetch_assoc()){
          $info[] = $row;
        }
        if(count($info) > 0){
          if(password_verify($password, $info[0]["password"])){

            $cookie_name = "owner_id";
            $cookie_value = $info[0]["owner_id"];
            setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
            echo '<script>document.location.reload()</script>';
          }
        }
      }


    ?>

<script src="../scripts/cookies.js"></script>
<script src="../scripts/login.js"></script>

<?php if(isset($_COOKIE['owner_id'])){
  $sql = "SELECT username AS user FROM users WHERE owner_id = '$_COOKIE[owner_id]'";
  $result = $conn->query($sql);
  $result = json_encode($result->fetch_assoc());
  echo "<script type='text/javascript'>cookie($_COOKIE[owner_id], $result);</script>";
}

  CloseCon($conn);
?>
</body>
</html>
