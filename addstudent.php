<?php
  include("_includes/functions.inc");
  include('_includes/dbconnect.inc');
  include "_includes/passwordLib.php";

  //Header and Navbar
  echo template("templates/partials/header.php");
  echo template("templates/partials/nav.php");

  //Input form
  $data['content']= "<h3>Add Student</h3>
  <form action='addstudent.php' method='post' enctype='multipart/form-data'>
    Student ID:
    <input type='text' name='studentid' placeholder='20000000' required><br/>
    Password:
    <input type='password' name='password' required><br/>
    DoB(YYYY-MM-DD):
    <input type='text' name='dob' placeholder='2000-01-01' required><br/>
    First Name:
    <input type='text' name='firstName' placeholder='John' required><br/>
    Last Name:
    <input type='text' name='lastName' placeholder='Smith' required><br/>
    Number and Street:
    <input type='text' name='numberAndStreet' placeholder='32A Bridge Street' required><br/>
    Town:
    <input type='text' name='town' placeholder='High Wycombe' required><br/>
    County:
    <input type='text' name='county' placeholder='Bucks' required><br/>
    Country:
    <input type='text' name='country' placeholder='UK' required><br/>
    Postcode:
    <input type='text' name='postcode' placeholder='HP11 2EL' required><br/>
    Picture:
    <input type='file' name='image' accept='image/jpeg' class='form-control' required/><br/>
    <input type='submit' name='submit' value='Submit' class='submitButton'/>
  </form>";

  //Display form and footer
  echo template("templates/default.php", $data);
  echo template("templates/partials/footer.php");


  //Upload to the sql database if the form has been submitted
  if(isset($_POST['submit'])){

    $id = $_POST['studentid'];
    $password = $_POST['password'];
    $dob = $_POST['dob'];
    $fName = $_POST['firstName'];
    $lName = $_POST['lastName'];
    $house = $_POST['numberAndStreet'];
    $town = $_POST['town'];
    $county = $_POST['county'];
    $country = $_POST['country'];
    $postcode = $_POST['postcode'];
    $image = $_FILES['image']['tmp_name'];
    $imagedata = addslashes(fread(fopen($image, "r"), filesize($image)));

    //Checking if the inputs are valid
    if(strlen($id) == 8 && strlen($password) >= 8){
      $password = password_hash($password, PASSWORD_DEFAULT);
      $sql = "INSERT INTO `student` (`studentid`, `password`, `dob`, `firstname`, `lastname`, `house`, `town`, `county`, `country`, `postcode`, `picture`)
                VALUES ('$id', '$password', '$dob', '$fName', '$lName', '$house', '$town', '$county', '$country', '$postcode', '$imagedata');";
      $result = mysqli_query($conn, $sql);
      if(!$result){
        echo "Error!";
      }
    }
    else{

      //Display fitting error messages
      if(strlen($id) != 8){
        echo "Invalid student ID";
      }
      if(strlen($password) < 8){
        echo "The provided password must be at least 8 characters long!";
      }
    }
  }
?>
