<?php include_once 'data/header.php'; ?>


<div class="container pt-5 pb-5">
  <div class="row card w-80 shadow">
    <div class="card-body">
      <h4 class="card-title">Dashboard</h4></br>
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
          if ($err == 'wrong')
            $msg = 'Ceva a mers prost :(. Încercați iar.';
          if ($msg !== '')
            echo '</br><h6 class="text-danger">'.$msg.'</h6></br>';
        }
        if (isset($_GET['success']))
        {
          echo '</br><h6 class="text-danger">Operațiune efectuată cu succes.</h6></br>';
        }
      ?>
      <div class="container pb-5">
        <div class="card-deck">
          <div class="row card shadow">
            <div class="card-body">
              <p> <a class="btn btn-outline-secondary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Validare cereri </a></p>
              <div class="collapse" id="collapseExample">
                <div class="card card-body">
                  <?php
                  include_once 'data/admin.inc.php';
                  if (!empty($data)):?>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Tip</th>
                          <th>Id utilizator</th>
                          <th>Validare</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($data as $row):?>
                        <tr><td><?php if($row['type'] == 'create') echo 'Solicitare creare cont de medic'?></td><td><?php echo $row['id_user']?></td>
                            <td>
                            <form action='data/admin.inc.php' method = 'post'>
                             <button name = "validating"  value = '<?=$row['id']?>' type="submit" class="btn btn-outline-secondary">Acceptare</button>
                            </form>
                            </td>
                        <?php endforeach;?>
                      </tbody>
                    </table>
                  <?php else: // empty table?>
                    <table class="table table-hover">
                    <thead>
                      <tr>
                        <th>Nu există cereri.</th>
                      </tr>
                    </thead>
                    </table>
                  <?php endif;?>

                </div>
              </div></br>
              <p> <a class="btn btn-outline-secondary" data-bs-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Creare nou admin </a></p>
              <div class="collapse" id="collapseExample2">
                <div class="card card-body">
                  <div class = "form-check">
                    <form action="data/newadmin.php" method="post">
                      <label class="form-check-label" for="username"> <h6>Username</h6></label>
                      <input class="form-control w-50" type="text" name="username" placeholder="Username"></br>
                      <label class="form-check-label" for="mail"> <h6>Email</h6></label>
                      <input class="form-control w-50" type="email" name="mail" placeholder="exemplu@email.ro"></br>
                      <label class="form-check-label" for="pswrd"> <h6>Parola</h6></label>
                      <input class="form-control w-50" type="password" name="pswr"></br>
                      <label class="form-check-label" for="pswrdrep"> <h6>Repetare parola</h6></label>
                      <input class="form-control w-50" type="password" name="pswrdrep"></br>
                      <button class="btn btn-outline-secondary" type="submit" name="submit">Înregistrare</button>
                  </form>
                  </div>
                </div>
              </div></br>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<?php include_once 'data/footer.php'; ?>
