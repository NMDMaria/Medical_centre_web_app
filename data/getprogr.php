<?php

function getProgr($conn, $id_doctor)
{
  $sql = "SELECT p.id_programare, concat(pac.nume, ' ', pac.prenume) pacient FROM programari p join pacienti pac on (pac.id_pacient = p.id_pacient) WHERE lower(p.status) = 'asteptare' and p.id_doctor = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../manage_programari.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $id_doctor);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_all($result, MYSQLI_ASSOC))
  {
      mysqli_stmt_close($stmt);
      return $row;
  }
  mysqli_stmt_close($stmt);
}

function getIdFromProg($conn, $id_programare)
{
  $sql = "select id_pacient, data from programari where id_programare = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../manage_programari.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $id_programare);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($result))
  {
      mysqli_stmt_close($stmt);
      return $row;
  }
  mysqli_stmt_close($stmt);
}
