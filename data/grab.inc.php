<?php
if (session_status() !=2 ) session_start();

if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1)
{
  ?>
  <script type="text/javascript">
  window.location.href = '../index.php';
  </script>
  <?php
}

include_once 'cdb.inc.php';

function grabTempAng($conn, $id_user)
{
  $sql = "select * from temp_ang where id_user = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../completeprofile.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $id_user);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($result))
  {
    mysqli_stmt_close($stmt);
    return $row;
  }

  mysqli_stmt_close($stmt);
}

function grabSlujbe($conn)
{
  $sql = "select * from slujbe;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../completeprofile.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_all($result, MYSQLI_ASSOC))
  {
    mysqli_stmt_close($stmt);
    return $row;
  }

  mysqli_stmt_close($stmt);
}

function grabSedii($conn)
{
  $sql = "select * from sedii;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../completeprofile.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_all($result, MYSQLI_ASSOC))
  {
    mysqli_stmt_close($stmt);
    return $row;
  }

  mysqli_stmt_close($stmt);
}

function isemp($val)
{
  if (empty($val))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../completeprofile.php?error=wrong';
    </script>
    <?php
    exit();
  }
}

if (isset($_POST['yes']) && $_POST['yes'])
{
  $nume = mysqli_real_escape_string($conn, $_POST['nume']);
  isemp($nume);
  $prenume = mysqli_real_escape_string($conn, $_POST['prenume']);
  isemp($prenume);
  $cnp = mysqli_real_escape_string($conn, $_POST['cnp']);
  isemp($cnp);
  $dob = mysqli_real_escape_string($conn, $_POST['dob']);
  isemp($dob);
  $doa = mysqli_real_escape_string($conn, $_POST['doa']);
  isemp($doa);
  $tel = mysqli_real_escape_string($conn, $_POST['nr_telefon']);
  isemp($tel);
  $mail = mysqli_real_escape_string($conn, $_POST['email']);
  isemp($mail);
  $sal = mysqli_real_escape_string($conn, $_POST['salariu']);
  isemp($sal);
  $bon = mysqli_real_escape_string($conn, $_POST['bonus']);
  if (!$bon) $bon = 0;
  $id_slj = mysqli_real_escape_string($conn, $_POST['slujba']);
  isemp($id_slj);
  $dom = mysqli_real_escape_string($conn, $_POST['domeniu']);
  isemp($dom);
  $id_sed = mysqli_real_escape_string($conn, $_POST['sediu']);
  isemp($id_sed);


  $sql = "insert into angajati(id_user, nume, prenume, cnp, data_nasterii, data_angajarii, nr_telefon, salariu, bonus, id_slujba, id_sediu, angajat_type, domeniu, email) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Personal_medical', ?, ?)";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../completeprofile.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ississiiisiss", $_SESSION['crprf'], $nume, $prenume, $cnp, $dob, $doa, $tel, $sal, $bon, $id_slj, $id_sed, $dom, $mail);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  mysqli_stmt_close($stmt);

  $sql = "delete from temp_ang where id_user = ?";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../completeprofile.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $_SESSION['crprf']);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  mysqli_stmt_close($stmt);

  $sql = "update await_admin_validation set validated = 1 where id_user = ?";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../completeprofile.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $_SESSION['crprf']);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  mysqli_stmt_close($stmt);

  ?>
  <script type="text/javascript">
  window.location.href = '../admin_homepage.php?success=true';
  </script>
  <?php
  exit();
}

if (isset($_POST['no']) && $_POST['no'])
{
  $sql = "delete from temp_ang where id_user = ?";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../completeprofile.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $_SESSION['crprf']);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  mysqli_stmt_close($stmt);

  $sql = "update await_admin_validation set validated = -1 where id_user = ?";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../completeprofile.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $_SESSION['crprf']);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  mysqli_stmt_close($stmt);

  ?>
  <script type="text/javascript">
  window.location.href = '../admin_homepage.php?success=true';
  </script>
  <?php
  exit();
}

?>
<script type="text/javascript">
window.location.href = '../index.php';
</script>
<?php
exit();
