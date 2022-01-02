<?php
if (session_status() != 2) session_start();

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
  if (filter_var($mail, FILTER_VALIDATE_EMAIL)) // validare date
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
    ?>
    <script type="text/javascript">
    window.location.href = '../signup.php?error=wrong';
    </script>
    <?php
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

function createUser($conn, $username, $mail, $pswrd)
{
  $sql = "insert into users(username, email, password) values (?,?,?)";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../signup.php?error=wrong';
    </script>
    <?php
    exit();
  }

  $hash = password_hash($pswrd, PASSWORD_DEFAULT);
  mysqli_stmt_bind_param($stmt, "sss", $username, $mail, $hash);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);

  $_SESSION['signup'] = true;
  $_SESSION['username'] = $username;
  $_SESSION['email'] = $mail;

  // merge la completare profil
  ?>
  <script type="text/javascript">
  window.location.href = '../createprofile.php';
  </script>
  <?php
  exit();
}

$data = array(
            'secret' => "0x14B3DC6A83BB03A53255f4E3B5f09b79938a6e73",
            'response' => $_POST['h-captcha-response']
        );
$verify = curl_init();
curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
curl_setopt($verify, CURLOPT_POST, true);
curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($verify);
// var_dump($response);
$responseData = json_decode($response);
if($responseData->success)
{
  if (isset($_POST["submit"])) // intra doar daca vine din formular
  {
    require_once 'cdb.inc.php';

    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $mail = mysqli_real_escape_string($conn, $_POST["mail"]);
    $pswrd = mysqli_real_escape_string($conn, $_POST["pswr"]);
    $pswrdrep = mysqli_real_escape_string($conn, $_POST["pswrdrep"]);


    if (emptyField($username, $mail, $pswrd, $pswrdrep) !== false)
    {
      ?>
      <script type="text/javascript">
      window.location.href = '../signup.php?error=emptyfield';
      </script>
      <?php
      exit();
    }

    if (validUsername($username) !== true)
    {
      ?>
      <script type="text/javascript">
      window.location.href = '../signup.php?error=notvalidusername';
      </script>
      <?php
      exit();
    }

    if (validEmail($mail) !== true)
    {
      ?>
      <script type="text/javascript">
      window.location.href = '../signup.php?error=notvalidmail';
      </script>
      <?php
      exit();
    }

    if (checkPass($pswrd, $pswrdrep) !== true)
    {
      ?>
      <script type="text/javascript">
      window.location.href = '../signup.php?error=missmatchpassword';
      </script>
      <?php
      exit();
    }

    if (userExists($conn, $username, $mail) !== false)
    {
      ?>
      <script type="text/javascript">
      window.location.href = '../signup.php?error=userexists';
      </script>
      <?php
      exit();
    }

    // a trecut toate validarile
    createUser($conn, $username, $mail, $pswrd);
  }
  else
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../signup.php';
    </script>
    <?php
    exit();
  }
}
else {
  ?>
  <script type="text/javascript">
  window.location.href = '../signup.php?error=captcha';
  </script>
  <?php
  exit();
}
