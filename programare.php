<?php include_once('data/header.php');
if (session_status() != 2) session_start();

if (isset($_SESSION['admin']))
{
  ?>
  <script type="text/javascript">
  window.location.href = './admin_homepage.php';
  </script>
  <?php
  exit();
  exit();
}

if (isset($_SESSION['doctor'])) // doctorii nu fac programari
{
  ?>
  <script type="text/javascript">
  window.location.href = './manage_programari.php';
  </script>
  <?php
  exit();
  exit();
}
?>

<div class="container pt-5 pb-5">
  <div class="row card w-80 shadow">
    <div class="card-body">
      <h4 class="card-title">Programare</h4>

				<?php if (!isset($_SESSION['login'])): // un guest a incercat sa intre?>
					<p class="card-text">Pentru a aceesa această pagină trebuie să vă conectați.</p></br>
					<a href="./login.php">Conectare la un cont deja existent.</a></br>
					<a href="./signup.php">Creare cont.</a></br>
				<?php else:
				include('data/getspecial.php'); // preluare date?>
        <?php if(!isset($_GET['submit'])): // inca nu a fost selectat un dcoctor?>
        <form action = "" method="get">
          <label class="form-check-label" for="doc"> <h6>Doctor și specializarea: </h6></label></br>
          <select name="doc">
            <?php foreach($docs as $doc): // afisare el baza de date in mod dinamic?>
              <option value=<?=$doc['id_angajat']?>><?=$doc['nume'].' - '.$doc['domeniu']?></option>
            <?php endforeach;?>
          </select></br></br>
          <button class="btn btn-outline-secondary" type="submit" value="true" name="submit">Mai departe</button>
        </form>
      <?php else: ?>
				<script>
        // cod calendar de la fullcalendar in javascript
					document.addEventListener('DOMContentLoaded', function() {
						var calendarEl = document.getElementById('calendar');
						var calendar = new FullCalendar.Calendar(calendarEl, {
							height: 800,
					    contentHeight: 780,
							nowIndicator: true,
						  selectable: true,
              defaultTimedEventDuration: '01:30',
							businessHours: {
							  daysOfWeek: [ 1, 2, 3, 4, 5, 6 ],
							  startTime: '08:00',
							  endTime: '20:00',
							},
							initialView: 'timeGridWeek',
              eventClick: function(info) { // la click se sterge programarea
                if (confirm("Doriți să ștergeți programarea? ") == true)
                {
                  $.ajax({ // pt apel functie php din js (programarea se sterge tot din php)
                      type: "POST",
                      async: false,
                      url: './data/test.php',
                      dataType: 'json',
                      data: {functionname: 'deleteProgr', arguments: [info.event.id]},
                      success: function(result){
                         console.log(result);
                         yourVariable = result.result;
                     }
                  });
                  location.reload();
                }
              },

							select: function(info) {// selectare interval pt programare
                document.cookie = "progr_Start="+info.startStr; // memorare in cookie
                document.cookie = "progr_End="+info.endStr;

					      console.log(info);
                // restrictii
                if (info.start.getHours() < 8 || info.end.getHours() > 18)
                  alert('Programarea nu este în timpul programului de lucru');
                else if(info.end.getTime() - info.start.getTime() > 7200000)
                  alert('Programare prea lungă.');
                else
                {
                  if (confirm("Confirmare programare: ") == true)
                  {
                    // verificare suprapuneri
										let b_fl = false;
										let checkEv = calendar.getEvents();
										for (let e of checkEv)
										{
											if (e.startStr === info.startStr || Math.abs(e.start.getTime() - info.start.getTime()) < 5400000 )
											{
												alert("Programările nu se pot suprapune.");
												b_fl = true;
												break;
											}
										}
										if (b_fl === false){
                      // nu se suprapune
                    	var yourVariable = 5;
	                    $.ajax({ // pt apel functie php din js
	                        type: "POST",
	                        async: false,
	                        url: './data/test.php',
	                        dataType: 'json',
	                        data: {functionname: 'makeProgr', arguments: [<?=$_SESSION['pacient']?>, <?=$_GET['doc']?>, info.startStr, info.endStr]},
	                        success: function(result){
	                           console.log(result);
	                           yourVariable = result.result;
	                       }
	                    });
	                    console.log(yourVariable);
                      // adaugare eveniment
	                    let k =
	                    {
	                      id: yourVariable,
	                      title: 'Programare ',
	                      start: info.startStr,
	                      end: info.endStr,
	                      color: '#ff8b52',
												overlap: false
	                    };

	                    calendar.addEvent(k);
	                    calendar.render();
	                    console.log(document.cookie);
	                    document.cookie = "progr_Start=";
	                    document.cookie = "progr_End=";

	                    location.reload();
	                  }
									}
                }
				      },


              events: [
								<?php foreach($prog as $event): // programarile preluate dinamic cu php din baza de date si transformate in evenimente?>
								{
									id: <?=$event['id_programare']?>,
                  title: 'Programare',
									start: "<?=$event['data'].'T'.$event['ora']?>",
                  end: "<?=$event['ora_sfarsit'] ? $event['data'].'T'.$event['ora_sfarsit'] : ''?>",
									color: 'orange'
								},
								<?php endforeach;?>

                <?php foreach($progr_doc as $event): // afiasare si programarile medicului ca se se vada cand e ocupat?>
								{
									id: <?=$event['id_programare']?>,
                  title: 'Doctorul este ocupat',
									start: "<?=$event['data'].'T'.$event['ora']?>",
									color: 'red'
								},
								<?php endforeach;?>

							]
						});


						calendar.render();
					});

				</script>
				<div id='calendar'></div>
      <?php endif;?>
		<?php endif;?>
</div>
</div>
</div>

<?php include_once('data/footer.php')?>
