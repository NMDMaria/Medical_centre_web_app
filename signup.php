<?php include_once 'data/header.php';
if (session_status() != 2) session_start();
if (isset($_SESSION['login']))
{
  ?>
  <script type="text/javascript">
  window.location.href = './profile.php';
  </script>
  <?php
  exit();
}
?>

<div class="container pt-5 pb-5">
    <div class="row card w-80 shadow">
        <div class="card-body">
            <h4 class="card-title">Înregistrează-te acum!</h4>
            <?php
                if (isset($_GET['error']))
                {
                  $err = $_GET['error'];
                  $msg = '';
                  if ($err == 'emptyfield')
                    $msg = "Un câmp nu a fost completat.";
                  if ($err == 'notvalidusername')
                    $msg = "Username invalid.";
                  if ($err == 'notvalidmail')
                    $msg = 'Email invalid.';
                  if ($err == 'missmatchpassword')
                    $msg = 'Parolele nu se potrivesc.';
                  if ($err == 'userexists')
                    $msg = 'Nume de utilizator deja folosit. Încercați altul sau conectați-vă.';
                  if ($err == 'captcha')
                    $msg = 'Captcha nu a fost validat. Încercați iar.';
                  if ($err == 'wrong')
                    $msg = 'Ceva a mers prost :(. Încercați iar.';
                  if ($msg !== '')
                    echo '</br><h6 class="text-danger">'.$msg.'</h6></br>';
                }
            ?>
            <div class = "form-check">
            <form action="data/signup.inc.php" method="post">
                <label class="form-check-label" for="username"> <h6>Username</h6></label>
                <input class="form-control w-50" type="text" name="username" placeholder="Username"></br>
                <label class="form-check-label" for="mail"> <h6>Email</h6></label>
                <input class="form-control w-50" type="email" name="mail" placeholder="exemplu@email.ro"></br>
                <label class="form-check-label" for="pswrd"> <h6>Parola</h6></label>
                <input class="form-control w-50" type="password" name="pswr"></br>
                <label class="form-check-label" for="pswrdrep"> <h6>Repetare parola</h6></label>
                <input class="form-control w-50" type="password" name="pswrdrep"></br>
                <div class="h-captcha" data-sitekey="8dcda850-d58a-4505-b899-338f7cc261ac"></div></br></br>
                <button class="btn btn-outline-secondary" type="submit" name="submit">Înregistrare</button>
            </form>
            </div>
        </div>
    </div>
</div>


<?php include_once 'data/footer.php';?>
