<?php
include_once 'cdb.inc.php';
if (session_status()!=2) session_start();

function getDoc($conn)
{
  $sql = "select id_angajat, domeniu, concat('Dr. ', nume, ' ', prenume) as 'nume' from angajati where angajat_type='Personal_medical';";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../calendar.php?error=wrong';
    </script>
    <?php
    exit();
  }
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
  mysqli_stmt_close($stmt);
  return $rows;
}

function makeProgr($conn, $id_pacient, $id_doctor)
{
  if ($_COOKIE['progr_Start'] && $_COOKIE['progr_End'])
  {
    $split = explode("T", $_COOKIE['progr_Start']);
    $data = $split[0];
    $split = $split[1];
    $split = explode("+", $split);
    $ora =  $split[0];
    $ora = mysqli_real_escape_string($conn, $ora);

    $split = explode("T", $_COOKIE['progr_End']);
    $oraf = explode('+', $split[1])[0];
    $oraf = mysqli_real_escape_string($conn, $ora);

    $sql = "insert into programari(id_pacient, data, tip, status, ora, id_doctor, ora_sfarsit) values (?, ?, 'Normal', 'Astepare', ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql))
    {
      ?>
      <script type="text/javascript">
      window.location.href = '../programare.php?error=wrong';
      </script>
      <?php
      exit();
    }

    mysqli_stmt_bind_param($stmt, "issis", $id_pacient, $data, $ora, $id_doctor, $oraf);

    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    return 1;
  }
  return 0;
}

function getProgrPac($conn, $id_pacient)
{
  $sql = "select p.id_programare, p.data, p.ora, p.ora_sfarsit, p.id_doctor, concat(d.nume,' ',d.prenume) as nume_doc from programari p left join angajati d on (id_angajat = id_doctor) where lower(trim(status)) != 'anulata' and id_pacient = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../calendar.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $id_pacient);
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

  mysqli_stmt_close($stmt);
  return $rows;
}

function getProgrDoc($conn, $id_doctor)
{
  $sql = "select p.id_programare, p.data, p.ora, p.ora_sfarsit, p.id_doctor, concat(d.nume,' ',d.prenume) as 'nume_pac' from programari p left join pacienti d on (d.id_pacient = p.id_pacient) where lower(trim(status)) != 'anulata' and id_doctor = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../calendar.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $id_doctor);
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

  mysqli_stmt_close($stmt);
  return $rows;
}

function getProgrDocSelect($conn, $id_doctor, $id_pacient)
{
  $sql = "select id_programare, data, ora, ora_sfarsit, id_pacient from programari where id_doctor = ? and id_pacient != ?";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../calendar.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "ii", $id_doctor, $id_pacient);
  mysqli_stmt_execute($stmt);

  $result = mysqli_stmt_get_result($stmt);
  $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

  mysqli_stmt_close($stmt);
  return $rows;
}

function getPId($conn, $id_pacient, $id_doctor)
{
  if ($_COOKIE['progr_Start'] && $_COOKIE['progr_End'])
  {
    $split = explode("T", $_COOKIE['progr_Start']);
    $data = $split[0];
    $split = $split[1];
    $split = explode("+", $split);
    $ora =  $split[0];
    $sql = "select id_programre from programari where id_pacient = ? and id_doctor = ? and data = ? and ora = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql))
    {
      ?>
      <script type="text/javascript">
      window.location.href = '../programare.php?error=wrong';
      </script>
      <?php
      exit();
    }

    mysqli_stmt_bind_param($stmt, "iiss", $id_pacient, $id_doctor, $data, $ora);

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if ($row = mysqli_fetch_assoc($result))
    {
      mysqli_stmt_close($stmt);
      return $row['id_programare'];
    }
    mysqli_stmt_close($stmt);
  }

  return -1;
}

$docs = getDoc($conn); // lista de doctori
if (isset($_SESSION['pacient'])) // apelat de un pacient
  $prog = getProgrPac($conn, $_SESSION['pacient']); // pune porgramari pacient
else if (isset($_SESSION['doctor']))
  $prog = getProgrDoc($conn, $_SESSION['doctor']); // pune programari doctor
if (isset($_GET['submit']))
  $progr_doc = getProgrDocSelect($conn, $_GET['doc'], $_SESSION['pacient']); // daca se incearca programarea
  // la un doctor se pune și progr pacient și progr doctorolui respectiv (+ sa nu se intercaleze)
