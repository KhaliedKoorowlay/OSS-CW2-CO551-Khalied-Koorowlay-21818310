
<?php
  echo $message;
  echo template("templates/partials/header.php");
?>
<div class="login">
<form name="frmLogin" action="authenticate.php" method="post">
  <table>
    <tr>
      <td>
       Student ID:
      </td>
      <td>
      <input name="txtid" type="text" />
      </td>
    </tr>
    <tr>
      <td>
      Password:
      </td>
      <td>
      <input name="txtpwd" type="password" />
      </td>
    </tr>
  </table>
   <input type="submit" value="Login" name="btnlogin" class="submitButton"/>
</form>
</div>
