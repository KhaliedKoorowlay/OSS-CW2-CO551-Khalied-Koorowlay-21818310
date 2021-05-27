<?php

  include("_includes/dbconnect.inc");
  include "_includes/passwordLib.php";
  require_once 'vendor/autoload.php';

  $faker = Faker\Factory::create();

  for($i = 0;$i < 5; $i++){
    $studentid = $faker ->numberBetween(10000000, 99999999);
    $password = password_hash($faker ->password, PASSWORD_DEFAULT);
    $dob = $faker ->date($format = 'Y-m-d', $max = '-20 years');
    $firstName = $faker ->firstName($gender = 'male'|'female');
    $lastName = $faker ->lastName;
    $address = $faker ->buildingNumber . " " . $faker->streetName;
    $town = $faker ->city;
    $county = $faker ->state;
    $country = $faker ->country;
    $postcode = $faker ->postcode;

    $sql = "INSERT INTO `student` (`studentid`, `password`, `dob`, `firstname`, `lastname`, `house`, `town`, `county`, `country`, `postcode`)
            VALUES('$studentid', '$password','$dob','$firstName','$lastName','$address','$town','$county','$country','$postcode');";

    $result = mysqli_query($conn, $sql);
  }
 ?>
