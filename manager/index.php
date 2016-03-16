<?php
include('../includes/sqlfunctions.inc.php');
include('./includes/adminconnection.inc.php');
?>

<?php
if(isset($_POST['username'])){
    $username = $_POST['username'];
}
if(isset($_POST['password'])){
    $password = $_POST['password'];
}

  if ((!isset($username)) || (!isset($password))) {
  //Visitor needs to enter a name and password
?>
    <h1>Please Log In</h1>
    <p>This page is secret.</p>
    <form method="POST" action="index.php">
    <p>Username: <input type="text" name="username"></p>
    <p>Password: <input type="password" name="password"></p>
    <p><input type="submit" name="submit" value="Log In"></p>
    </form>

<?php
  } else {
    // connect to mysql
    $mysql = dbConnect();
    if(!$mysql) {
      print "Cannot connect to database.";
      exit;
    }

    // query the database to see if there is a record which matches
    $query = "select count(*) from users where
              username = '"._mysql_real_escape_string($mysql, $username)."' and
              password = sha1('".$password."')";

    $result = _mysql_query($mysql, $query);
    if(!$result) {
      print "Cannot run query.";
      exit;
    }
    $row = _mysql_fetch_row($mysql, $result);
    $count = $row[0];

    if ($count > 0) {
      // visitor's name and password combination are correct
      print "<h1>Here it is!</h1><p>I bet you are glad you can see this secret page.</p>";
    } else {
      // visitor's name and password combination are not correct
      print "<h1>Go Away!</h1><p>You are not authorized to use this resource.</p>";
    }
  }
?>