<?php include_once 'data/header.php'; ?>


<div class="container pt-5 pb-5">
    <div class="row card w-80 shadow">
        <div class="card-body">
            <h4 class="card-title">Logare</h4>
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
              if ($err == 'usernotexists')
                $msg = 'Utilizatorul nu există. Verificați datele și încercați iar sau înregistrați-vă.';
              if ($err == 'captcha')
                $msg = 'Captcha nu a fost validat. Încercați iar.';
              if ($err == 'wrong')
                $msg = 'Ceva a mers prost :(. Încercați iar.';
              if ($msg !== '')
                echo '</br><h6 class="text-danger">'.$msg.'</h6></br>';
            }
            ?>
            <div class="form-check">
            <form action="data/login.inc.php" method="post">
                <label class="form-check-label" for="data"> <h6>Username/email</h6></label>
                <input class="form-control w-50" type="text" name="data" placeholder="Username/email"></br>
                <label class="form-check-label" for="password"> <h6>Parola</h6></label>
                <input class="form-control w-50" type="password" name="pswr"></br>
                <div class="h-captcha" data-sitekey="8dcda850-d58a-4505-b899-338f7cc261ac"></div></br></br>
                <button class="btn btn-outline-secondary" type="submit" name="submit">Login</button>
            </form>
            </br><a href="./signup.php">Încă nu ai cont? Înregistrează-te acum.</a></br>
          </div>
        </div>
    </div>
</div>


<?php include_once 'data/footer.php';?>
