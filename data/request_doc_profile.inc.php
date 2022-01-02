<?php
if (session_status() != 2) session_start();

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
  if (isset($_POST["submit"])) // intra doar daca vine din form
  {
    require_once 'cdb.inc.php';

    $username = $_SESSION['username']; // preluare date din sesiune

    // securizare pt inserare in baza de date
    $nume = mysqli_real_escape_string($conn, $_POST["nume"]);
    $prenume = mysqli_real_escape_string($conn, $_POST["prenume"]);
    $cnp = mysqli_real_escape_string($conn, $_POST["cnp"]);
    $dob = mysqli_real_escape_string($conn, $_POST["dob"]);
    $tel = mysqli_real_escape_string($conn, $_POST["nr_telefon"]);
    $dom = mysqli_real_escape_string($conn, $_POST["domeniu"]);
    $mail = mysqli_real_escape_string($conn, $_POST["email"]);

    require_once 'profile_handle.inc.php';

    if (emptyField($nume, $prenume, $cnp, $dob, $tel, $dom) !== false)
    {
      ?>
      <script type="text/javascript">
      window.location.href = '../doctorprofile.php?error=emptyfield';
      </script>
      <?php
      exit();
    }

    if (validateCNP($cnp) != true)
    {
      ?>
      <script type="text/javascript">
      window.location.href = '../doctorprofile.php?error=cnpnotvalid';
      </script>
      <?php
      exit();
    }

    $id_user = getUserid($conn, $username);
    $id = profileDExists($conn, $cnp);

    if ($id !== false)
    {
      aw_assocProfile($conn, $id_user, $id);
      ?>
      <script type="text/javascript">
      window.location.href = '../doctorprofile.php?succes=assoc';
      </script>
      <?php
      exit();
    }

    if (createDProfile($conn, $id_user, $nume, $prenume, $cnp, $dob, $tel, $dom, $mail) !== true)
    {
      ?>
      <script type="text/javascript">
      window.location.href = '../createprofile.php?error=wrong';
      </script>
      <?php
      exit();
    }
    else
    {
      ?>
      <script type="text/javascript">
      window.location.href = '../doctorprofile.php?succes=create';
      </script>
      <?php
      exit();
    }
  }
  else // nu s-a intrat prin formular
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../index.php';
    </script>
    <?php
    exit();
  }
}
else
{
  ?>
  <script type="text/javascript">
  window.location.href = '../doctorprofile.php?error=captcha';
  </script>
  <?php
  exit();
}
