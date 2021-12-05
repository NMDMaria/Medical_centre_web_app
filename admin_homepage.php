<?php include_once 'data/header.php'; ?>
<div class="container pt-5 pb-5">
    <div class="row card w-80 shadow">
        <div class="card-body">
            <h4 class="card-title">Dashboard</h4>
            <div class="container pb-5">
            <div class="card-deck">
            <div class="row card w-50 shadow">
                <div class="card-body">
                  <p> <a class="btn btn-outline-secondary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                    Validare cereri </a></p>
                      <div class="collapse" id="collapseExample">
                        <div class="card card-body">
                          <?php include_once 'data/admin.inc.php';
                            if (!empty($data)):?>
                              <table class="table table-hover">
                              <thead>
                                <tr>
                                  <th>Tip</th>
                                  <th>Id utilizator</th>
                                  <th>Validare</th>
                                </tr>
                              </thead>
                            <?php endif;?>
                            <tbody>
                            <?php
                              foreach($data as $row)
                              {
                                echo '<tr> <td>'.$row['type'].'</td> <td>'.$row['id_user'].'</td>';
                                echo '';
                              }
                            ?>
                              </tbody>
                            </table>
                        </div>
                      </div>
                </div>
            </div>
            </div>
          </div>
            </div>
          </div>
        </div>
    </div>
</div>
<?php include_once 'data/footer.php'; ?>
