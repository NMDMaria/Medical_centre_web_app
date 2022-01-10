<?php

function getProgr($conn, $id_pacient)
{
  $sql = "select distinct p.id_programare, p.data from programari p join proceduri_medicale pm on (p.id_programare = pm.id_programare) join diagnostice d on (d.id_programare = pm.id_programare) where p.id_pacient = ?;";
  $stmt = mysqli_stmt_init($conn);

  if (!mysqli_stmt_prepare($stmt, $sql))
  {
    ?>
    <script type="text/javascript">
    window.location.href = '../istoric.php?error=wrong';
    </script>
    <?php
    exit();
  }

  mysqli_stmt_bind_param($stmt, "i", $id_pacient);

  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
  return $row;

  mysqli_stmt_close($stmt);
}
