<?php
  include_once 'cdb.inc.php';
  function getData($conn, $id_user, $type)
  {
    if ($type == 'pacienti')
    {
      $sql = "select * from pacienti where id_user = ?;";
      $stmt = mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($stmt, $sql))
      {
         ?>
    <script type="text/javascript">
    window.location.href = 'https://negrutmariadaniela.000webhostapp.com/profile.php?error=wrong';
    </script>
    <?php
        exit();
      }

      mysqli_stmt_bind_param($stmt, "i", $id_user);

      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if ($row = mysqli_fetch_assoc($result))
        return $row;
      mysqli_stmt_close($stmt);

    }
    if ($type == 'angajati')
    {
      $sql = 'SELECT a.nume "nume", a.prenume "prenume", a.cnp "cnp", a.data_nasterii "data_nasterii", a.data_angajarii "data_angajarii", a.nr_telefon "nr_telefon", a.salariu "salariu", a.bonus "bonus", a.angajat_type "angajat_type", a.domeniu "domeniu", a.email "email", sj.nume_slujba "slujba", s.denumire_sediu "sediu", a.cabinet_nr_camera "cabinet", a.id_sediu "id_sediu" from angajati a, sedii s, slujbe sj where a.id_sediu = s.id_sediu and sj.id_slujba = a.id_slujba and a.id_user = ?;';
      $stmt = mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($stmt, $sql))
      {
        ?>
    <script type="text/javascript">
    window.location.href = 'https://negrutmariadaniela.000webhostapp.com/profile.php?error=wrong';
    </script>
    <?php
        exit();
      }

      mysqli_stmt_bind_param($stmt, "i", $id_user);

      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);

      if ($row = mysqli_fetch_assoc($result))
        return $row;
      mysqli_stmt_close($stmt);
    }
  }

  function getColNames($conn, $table)
  {
    $pacienti = ['nume','prenume','cnp','gen','data_nasterii','CID'];
    $angajati = ['nume','prenume','cnp','data_nasterii','data_angajarii','nr_telefon','salariu','bonus','angajat_type','domeniu','email', 'slujba', 'sediu', 'cabinet', 'id_sediu'];

    if ($table == 'pacienti')
      return $pacienti;
    if ($table == 'angajati')
      return $angajati;
    return false;
  }
  function profile_type($conn, $id_user)
  {
    $sql = "select 1 from pacienti where id_user = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql))
    {
      ?>
    <script type="text/javascript">
    window.location.href = 'https://negrutmariadaniela.000webhostapp.com/profile.php?error=wrong';
    </script>
    <?php
      exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id_user);

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result))
      return 'pacienti';
    mysqli_stmt_close($stmt);

    $sql = "select 1 from angajati where id_user = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql))
    {
         ?>
    <script type="text/javascript">
    window.location.href = 'https://negrutmariadaniela.000webhostapp.com/profile.php?error=wrong';
    </script>
    <?php
      exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id_user);

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result))
      return 'angajati';
    mysqli_stmt_close($stmt);

    return false;
  }

  if (session_status() != 2) session_start();
  $id_user = $_SESSION['login'];
  if (isset($_SESSION['admin']) && $_SESSION['admin'] == 1)
  {
    ?>
    <script type="text/javascript">
    window.location.href = 'https://negrutmariadaniela.000webhostapp.com/admin_homepage.php';
    </script>
    <?php
    exit();
  }
  $result = [];
  $profile_type = profile_type($conn, $id_user);
  if ($profile_type == false)
  {
      ?>
    <script type="text/javascript">
    window.location.href = 'https://negrutmariadaniela.000webhostapp.com/profile.php?error=wrong';
    </script>
    <?php
      exit();
  }
  else
  {
    $cols = getColNames($conn, $profile_type);
    $data = getData($conn, $id_user, $profile_type);
    foreach ($cols as $col_name)
    {
      $result[$col_name] = $data[$col_name];
    }
    $result['type'] = $profile_type;
  }
