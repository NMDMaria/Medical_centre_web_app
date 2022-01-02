<?php
  include_once 'cdb.inc.php';
  function getV($conn)
  {
    $sql = "select * from await_admin_validation where validated = 0;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql))
    {
      ?>
      <script type="text/javascript">
      window.location.href = '../admin_homepage.php?error=wrong';
      </script>
      <?php
      exit();
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result))
      $rows[] = $row;
    return $rows;

    mysqli_stmt_close($stmt);
  }

  function checkaccept($conn, $id)
  {
    $sql = "select * from await_admin_validation where id = ? and validated = 0;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql))
    {
      ?>
      <script type="text/javascript">
      window.location.href = '../admin_homepage.php?error=wrong';
      </script>
      <?php
      exit();
    }

    mysqli_stmt_bind_param($stmt, "i", $id);

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if($row['type'] == 'create')
    {
      $_SESSION['crprf'] = $row['id_user'];

      ?>
      <script type="text/javascript">
      window.location.href = '../completeprofile.php';
      </script>
      <?php
      exit();
    }
    else if ($row['type'] == 'assoc')
    {
      $sql = "update angajati set id_user = ? where id_angajat = ?;";
      $stmt = mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($stmt, $sql))
      {
        ?>
        <script type="text/javascript">
        window.location.href = '../admin_homepage.php?error=wrong';
        </script>
        <?php
        exit();
      }

      mysqli_stmt_bind_param($stmt, "ii", $row['id_user'], $row['id_angajat']);

      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);

      $sql = "update await_admin_validation set validated = 1 where id = ?;";
      $stmt = mysqli_stmt_init($conn);

      if (!mysqli_stmt_prepare($stmt, $sql))
      {
        ?>
        <script type="text/javascript">
        window.location.href = '../admin_homepage.php?error=wrong';
        </script>
        <?php
        exit();
      }

      mysqli_stmt_bind_param($stmt, "i", $id);
      mysqli_stmt_execute($stmt);
      mysqli_stmt_close($stmt);
    }


  }

  if (session_status() != 2) session_start();
  if (!isset($_SESSION['login']) || !isset($_SESSION['admin']) || $_SESSION['admin'] != 1)
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../index.php';
    </script>
    <?php
    exit();
  }
  $id_user = $_SESSION['login'];
  $data = getV($conn);

  if(isset($_POST['validating']))
  {
    $cerere_id = $_POST['validating'];
    checkaccept($conn, $cerere_id);
  }
