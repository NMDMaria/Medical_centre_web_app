<?php
include_once 'cdb.inc.php';
if (session_status() != 2)
  session_start();
session_unset();

$sql = "update stats set nr_sesiuni = nr_sesiuni + 1, nr_users_inreg = (select count(*) from users) where id = 1;";
$stmt = mysqli_stmt_init($conn);

mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_execute($stmt);


mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
<script type="text/javascript">
window.location.href = '../index.php';
</script>
<?php
