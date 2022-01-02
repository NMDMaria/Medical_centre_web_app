<?php
if (session_status() != 2) session_start();

function emptyField($data, $pswrd)
{
  if (empty($data) || empty($pswrd))
    return true;
  return false;
}

function userConnect($conn, $data, $pswrd)
{
  $sql = "select password from users where email = ? or username = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../login.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ss", $data, $data); // binding parameter -> securizare

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($result))
  {
    if (password_verify($pswrd, $row['password']) == true) // verificare hasshed pass
    {
      $sql = "select id_user, admin from users where password = ? and (email = ? or username = ?);";
      $stmt = mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($stmt, $sql))
      {
        ?>
        <script type="text/javascript">
        window.location.href = '../login.php?error=wrong';
        </script>
        <?php
        exit();
      }

      mysqli_stmt_bind_param($stmt, "sss", $row['password'], $data, $data);

      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if ($row = mysqli_fetch_assoc($result))
      {
        $_SESSION['login'] = $row['id_user']; // marcare conectat in sesiune

        $sql2 = "select id_angajat from angajati where id_user = ?;"; // verificare daca e angajat
        $stmt2 = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt2, $sql2))
        {
          ?>
          <script type="text/javascript">
          window.location.href = '../login.php?error=wrong';
          </script>
          <?php
          exit();
        }

        mysqli_stmt_bind_param($stmt2, "i", $row['id_user']);

        mysqli_stmt_execute($stmt2);
        $result2 = mysqli_stmt_get_result($stmt2);

        if ($row2 = mysqli_fetch_assoc($result2))
          $_SESSION['doctor'] = $row2['id_angajat']; // marcare angajat/doctor
        mysqli_stmt_close($stmt2);

        if ($row['admin'] == 1) // marcare admin
          $_SESSION['admin'] = 1;


        $sql2 = "select id_pacient from pacienti where id_user = ?;"; // verificare pacient
        $stmt2 = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt2, $sql2))
        {
          ?>
          <script type="text/javascript">
          window.location.href = '../login.php?error=wrong';
          </script>
          <?php
          exit();
        }

        mysqli_stmt_bind_param($stmt2, "i", $row['id_user']);

        mysqli_stmt_execute($stmt2);
        $result2 = mysqli_stmt_get_result($stmt2);

        if ($row2 = mysqli_fetch_assoc($result2)) // marcare pacient
            $_SESSION['pacient'] = $row2['id_pacient'];
        mysqli_stmt_close($stmt2);

        $udonline = "update users set last_online = SYSDATE() where id_user = ?;"; // update last online
        $stmtud = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmtud, $udonline))
        {
          header("location: ../login.php?error=wrong");
          exit();
        }

        mysqli_stmt_bind_param($stmtud, "i", $row['id_user']);

        mysqli_stmt_execute($stmtud);

        mysqli_stmt_close($stmt);
        mysqli_stmt_close($stmtud);

        return true;
      }

      mysqli_stmt_close($stmt);
      return false;
    }
  }
  mysqli_stmt_close($stmt);
  return false;
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
  if (isset($_POST["submit"])) // intra doar daca formul a fost incarcat si afisat altfel iese
  {
    $data = $_POST["data"];
    $pswrd = $_POST["pswr"];

    require_once 'cdb.inc.php'; // conectare db

    if (emptyField($data, $pswrd) !== false) //este un field necompletat
    {
      ?>
      <script type="text/javascript">
      window.location.href = '../login.php?error=emptyfield';
      </script>
      <?php
      exit();
    }
    if (userConnect($conn, $data, $pswrd) == false) // nu se poate face conectarea
    {
      ?>
      <script type="text/javascript">
      window.location.href = '../login.php?error=usernotexists';
      </script>
      <?php
      exit();
    }
    else // totul a mers ok redirecitonare
    {
      ?>
      <script type="text/javascript">
      window.location.href = '../profile.php';
      </script>
      <?php
      exit();
    }
  }
  else // cineva a incercat sa intre pe aceasta pagina prost...
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../index.php';
    </script>
    <?php
    exit();
  }
}
else {
  ?>
  <script type="text/javascript">
  window.location.href = '../login.php?error=captcha';
  </script>
  <?php
  exit();
}
