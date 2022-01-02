<?php
include_once 'cdb.inc.php';
if (session_status() != 2) session_start();

if (!isset($_SESSION['login'])) // se incearca intrarea de catre un utilizator nelogat
{
  ?>
  <script type="text/javascript">
  window.location.href = '../index.php';
  </script>
  <?php
}

function update_columnAngajati($conn, $col_name, $value, $id_user)
{
  $sql = "update angajati set ? = ? where id_user = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../profile.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ssi", $col_name, $value, $id_user);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  mysqli_stmt_close($stmt);
}

function update_columnPacienti($conn, $col_name, $value, $id_user)
{
  $sql = "update pacienti set ".$col_name."= ? where id_user = ?;"; // imi permit sa fac asta pentru ca col_name nu e dat de client!!! deci nu poate sa accesze ceva dubios
  // cand face concatenarea, este apelat mai jos din if-uri cu string dat in cod!
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../profile.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "si", $value, $id_user);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  mysqli_stmt_close($stmt);
}


if (isset($_GET['edit']) && $_GET['edit'] == true) // user tries to edit form so redirect to the page
{
  ?>
  <script type="text/javascript">
  window.location.href = '../profile.php?edit=true';
  </script>
  <?php
}
else
if (isset($_GET['acc_edit']) && $_GET['acc_edit'] == true) // user sent data to update
{
  if (!isset($_GET['angajat_type'])) // not an amployer
  {
    $nume = mysqli_real_escape_string($conn, $_GET['nume']);
    $prenume = mysqli_real_escape_string($conn, $_GET['prenume']);
    $cnp = mysqli_real_escape_string($conn, $_GET['cnp']);
    $dob = mysqli_real_escape_string($conn, $_GET['dob']);
    $gen = mysqli_real_escape_string($conn, $_GET['gen']);
    $id_user = $_SESSION['login'];
    if (!empty($nume))
    {
      update_columnPacienti($conn, "nume", $nume, $id_user);
    }
    if (!empty($prenume))
    {
      update_columnPacienti($conn, "prenume", $prenume, $id_user);
    }
    include_once 'profile_handle.inc.php';
    if (!empty($cnp) && validateCnp($cnp) == true)
    {
      update_columnPacienti($conn, "cnp", $cnp, $id_user);
    }
    if (!empty($dob))
    {
      update_columnPacienti($conn, "data_nasterii", $dob, $id_user);
    }
    if (!empty($gen))
    {
      update_columnPacienti($conn, "gen", $gen, $id_user);
    }
    ?>
    <script type="text/javascript">
    window.location.href = '../profile.php';
    </script>
    <?php
  }
}
else // s-a intrat aici de unde nu trebuia deci trb iesit
{
  ?>
  <script type="text/javascript">
  window.location.href = '../index.php';
  </script>
  <?php
}
