<?php
include_once 'cdb.inc.php';
if (session_status() != 2)
  session_start();
session_unset();
mysqli_close($conn);
?>
<script type="text/javascript">
window.location.href = '../index.php';
</script>
<?php
