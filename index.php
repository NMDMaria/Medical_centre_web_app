<!doctype html>
<html lang="en">
  <head>
     <?php include('data/functii.php');
            generate_head();?>
  </head>
  <body>
  <?php generate_page_upper();?>

    <!--
    Page data that isn't generated from php functions.
    !-->
  <div class="container pt-5 pb-5">
        <div class="row card w-80 shadow">
            <div class="card-body">
                <h4 class="card-title">Despre proiect</h4>
                <h6 class="card-subtitle mb-2 text-muted">"Activitățile unui centru medical"</h6>
                <p class="card-text">
                    În cadrul acestui site vor avea loc interacțiuni dintre clienți și un centru medical. Centrul medical întrunește <span style="color:#FF8360">clinici, cabinete medicale, centre de îngrijire urgentă</span> ce deservesc pacienții prin servicii de calitate și personal calificat.</br> Se remarcă diferite locații ale centrului, denumite sedii, în care pacienții pot primi îngrijire medicală în <span style="color:#FF8360">diverse domenii și specializări</span> spre exemplu: oftalmologie, chirurgie, medicină de familie etc. cât și <span style="color:#FF8360">laboratoare de analiză a probelor biologice.</span></br>Site-ul se va axa mult mai mult pe interacțiunea medic-pacient decât pe lucruri administrative.
                </p>
            </div>
        </div>

        <table style= "border:1px solid rgba(0,0,0,.125)" class="row mt-4 table shadow">
        <thead>
            <tr>
            <th>Tipuri de utilizatori</th>
            <th>Descriere mod utilizare al aplicației</th>
            </tr>
        </thead>
        <tbody>
            <tr>
            <td>Guest</td>
            <td><ul><li>Poate vedea postările de pe pagină.</li><li>Poate verifica rezultatul unor analize pe baza unui cod și a CNP-ului.</li><li>Pentru orice altă acțiune se cere logarea.</li></ul></td>
            </tr>
            <tr>
            <td>Utilizator de tip <span style="color:#FF8360">pacient</span></td>
            <td><ul><li>Opțiunile unui guest</li><li>Programare în funcție de medic, specialitate, zi, clinică, cât și opțiunea de reprogramare sau anulare</li><li>Acces la un calendar cu programări</li><li>Acces la istoricul analizelor personale</li><li>Acces la istoricul afecțiunilor și al internărilor</li><li>Acces la lista de tratamente recomandate în funcție de programarea avută</li><li>Notificări în cazul în care s-a întâmplat ceva cu o programare</li></ul></td>
            </tr>
            <tr>
            <td>Utilizator de tip <span style="color:#FF8360">medic</span></td>
            <td><ul><li>Opțiunile unui guest</li><li>Acces la istoricul analizelor, al afecțiunilor și al internărilor pacienților.</li><li>Poate adăuga un document în istoricul unui pacient (fișă de internare, diagnostic, rețetă,etc.)</li><li>Calendar cu programări</li><li>Abilitatea de a muta o programare a unui pacient(acesta fiind notificat)</li><li>Adăugare calificare (curs, studii etc.)</li><li>Schimbare cabinet</li><li>Schimbare sediu</li></ul></td>
            </tr>
            <tr>
            <td>Administrator</td>
            <td><ul><li>Modificarea listei de pacienti la care are acces un medic</li><li>Aprobare mutarea unui medic la alt sediu/cabinet</li><li>Aprobare calificare adăugată de medic</li><li>Ștergere cont</li><li>Adăugare sediu, departament</li></ul></td>
            </tr>
        </tbody>
        </table>

        
        <div class="row card w-80 shadow">
            <div class="card-body">
                <h4 class="card-title">Diagrama conceptuală</h4>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <p class="card-text"><span style="color:#FF8360">Specificații:</span></br>Relațiile administrator(utlizator)-angajat, medic(utilizator)-angajat și pacient(utilizator)-pacient sunt de One to One</br>Atributele nu sunt finalizate.</p>
                <a href="/images/schema1.jpg"><img class="img-fluid card-img-bottom" src="/images/schema1.jpg" alt="Card image cap"></a>
            </div>
        </div>

        <div class="row card mt-4 w-80 shadow">
            <div class="card-body">
                <h4 class="card-title">Diagrama Use-Case</h4>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <a class="d-flex justify-content-center" href="/images/d_use_case.png"><img style="height:50%;width:auto;" class="img-fluid card-img-bottom" src="/images/d_use_case.png" alt="Card image cap"></a>
            </div>
        </div>
  </div>

  </body>

  <?php generate_page_lower();?>
</html>