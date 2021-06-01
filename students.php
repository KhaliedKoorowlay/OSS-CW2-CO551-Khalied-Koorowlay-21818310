<?php

  include("_includes/config.inc");
  include('_includes/dbconnect.inc');
  include("_includes/functions.inc");


  //Executing deletion if the from is submitted
  if(isset($_POST['delete'])){
    $ids = array();
    $sql = "SELECT studentid FROM student";
    $result = mysqli_query($conn, $sql);
    $rowsNum = 0;
    while($row = mysqli_fetch_assoc($result)){
      $ids[] = $row['studentid'];
      $rowsNum++;
    }
    for ($i = 0; $i < $rowsNum; $i++){
      if(isset($_POST[$i])){
        $sql = "DELETE FROM student WHERE studentid = {$ids[$i]}";
        $result = mysqli_query($conn, $sql);
      }
    }
  }

  //Header and Navbar
  echo template("templates/partials/header.php");
  echo template("templates/partials/nav.php");

  //Table header
  $data['content'] = "
    <form action='students.php' method='post'>
    <table class='studentList'>
    <tr>
    <th>Picture</th>
    <th>Student ID</th>
    <th>Password</th>
    <th>Date of Birth</th>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Number and Street</th>
    <th>Town</th>
    <th>County</th>
    <th>Country</th>
    <th>Postcode</th>
    <th></th>
    </tr>";

  //Display table header
  echo template("templates/default.php", $data);

  //Table content
  $count = 0;
  $sql = "SELECT * FROM student";
  $result = mysqli_query($conn, $sql);
  while($row = mysqli_fetch_assoc($result)){
    $data['content'] = "<tr>
    <td><img src='getimage.php?id=" . $row['studentid']. "' height='100' width='100'</td>
    <td><center>" . $row['studentid'] . "</center></td>
    <td><center>" . $row['password'] . "</center></td>
    <td><center>" . $row['dob'] . "</center></td>
    <td><center>" . $row['firstname'] . "</center></td>
    <td><center>" . $row['lastname'] . "</center></td>
    <td><center>" . $row['house'] . "</center></td>
    <td><center>" . $row['town'] . "</center></td>
    <td><center>" . $row['county'] . "</center></td>
    <td><center>" . $row['country'] . "</center></td>
    <td><center>" . $row['postcode'] . "</center></td>
    <td><center><input type='checkbox' name = " . $count . " value='set'/></center></td>
    </tr>";
    //Display table content
    echo template("templates/default.php", $data);
    $count++;
  }

  //Delete button
  $data['content'] = "</table>
  <input type='submit' name='delete' value='Delete'class='submitButton'/>
  </form>";

  //Display table content and footer
  echo template("templates/default.php", $data);
  echo template("templates/partials/footer.php");
  mysqli_close($conn);
?>
