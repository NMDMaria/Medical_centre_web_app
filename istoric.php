<?php include_once 'data/header.php';

 if (session_status() != 2 || !isset($_SESSION['pacient']))
 {
   ?>
   <script type="text/javascript">
   window.location.href = './index.php';
   </script>
   <?php
 }

?>

<div class="container pt-5 pb-5">
  <div class="row card w-80 shadow">
    <div class="card-body">
      <h4 class="card-title">Istoric</h4>
      <?php
        include_once('./data/cdb.inc.php');
        include_once('./data/getReteta.php');

        $programari = getProgr($conn, $_SESSION['pacient']);
      ?>
      <ul class="list-group">
      <?php foreach($programari as $val):?>
        <li class="list-group-item"><a href = <?="./reteta.php?id_pacient=".$_SESSION['pacient']."&id_programare=".$val['id_programare']?>>Reteta din data <?= $val['data']?></a></li>
      <?php endforeach;?>
      </ul>

    </div>
  </div>
</div>


<?php include_once 'data/footer.php';?>
