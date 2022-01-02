<?php
include_once 'cdb.inc.php';

if (!isset($_POST['submit'])) // se incearca intrarea si nu din formular
{
  ?>
  <script type="text/javascript">
  window.location.href = '../index.php';
  </script>
  <?php
  exit();
}


function emptyField($username, $mail, $pswrd, $pswrdrep)
{
  if (empty($username) || empty($mail) || empty($pswrd) || empty($pswrdrep))
    return true;
  return false;
}

function validUsername($username)
{
  if (preg_match("/^[a-zA-Z0-9]*$/", $username))
    return true;
  return false;
}

function validEmail($mail)
{
  if (filter_var($mail, FILTER_VALIDATE_EMAIL))
    return true;
  return false;
}

function checkPass($pswrd, $pswrdrep)
{
  if ($pswrd !== $pswrdrep)
    return false;
  return true;
}

function userExists($conn, $username, $mail)
{
  $sql = "select 1 from users where username = ? or email = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../signup.php?error=wrong");
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $username, $mail);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if (mysqli_fetch_assoc($result))
  {
    mysqli_stmt_close($stmt);
    return true;
  }

  mysqli_stmt_close($stmt);
  return false;

}

function createAdmin($conn, $username, $mail, $pswrd)
{
  $sql = "insert into users(username, email, password, admin) values (?,?,?, 1)";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    header("location: ../signup.php?error=wrong");
    exit();
  }

  $hash = password_hash($pswrd, PASSWORD_DEFAULT);
  mysqli_stmt_bind_param($stmt, "sss", $username, $mail, $hash);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}


if (isset($_POST["submit"])) // intra doar daca vine din formular
{
  $username = mysqli_real_escape_string($conn, $_POST["username"]);
  $mail = mysqli_real_escape_string($conn, $_POST["mail"]);
  $pswrd = mysqli_real_escape_string($conn, $_POST["pswr"]);
  $pswrdrep = mysqli_real_escape_string($conn, $_POST["pswrdrep"]);


  if (emptyField($username, $mail, $pswrd, $pswrdrep) !== false)
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../admin_homepage.php?error=emptyfield';
    </script>
    <?php
    exit();
  }

  if (validUsername($username) !== true)
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../admin_homepage.php?error=notvalidusername';
    </script>
    <?php
    exit();
  }

  if (validEmail($mail) !== true)
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../admin_homepage.php?error=notvalidmail';
    </script>
    <?php
    exit();
  }

  if (checkPass($pswrd, $pswrdrep) !== true)
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../admin_homepage.php?error=missmatchpassword';
    </script>
    <?php
    exit();
  }

  if (userExists($conn, $username, $mail) !== false)
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../admin_homepage.php?error=userexists';
    </script>
    <?php
    exit();
  }

  // a trecut toate validarile
  createAdmin($conn, $username, $mail, $pswrd);
  ?>
  <script type="text/javascript">
  window.location.href = '../admin_homepage.php?success=true';
  </script>
  <?php
  exit();
}
else
{
  header("location: ../admin_homepage.php");
  exit();
}
