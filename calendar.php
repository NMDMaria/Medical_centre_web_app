<?php include_once('data/header.php');
if (session_status() != 2) session_start();
?>

<div class="container pt-5 pb-5">
  <div class="row card w-80 shadow">
    <div class="card-body">
      <h4 class="card-title">Calendar programări</h4>
				<?php if (!isset($_SESSION['login'])):// se incearca intrare pe pagina de catre un guest?>
					<p class="card-text">Pentru a aceesa această pagină trebuie să vă conectați.</p></br>
					<a href="./login.php">Conectare la un cont deja existent.</a></br>
					<a href="./signup.php">Creare cont.</a></br>
				<?php else:
					if (isset($_SESSION['admin']))
					{
						header("location: ./admin_homepage.php");
						exit();
					}
		      include('data/getspecial.php');?>
				<script> // afisare calendar cu fullcalendar javascript
					document.addEventListener('DOMContentLoaded', function() {
						var calendarEl = document.getElementById('calendar');
						var calendar = new FullCalendar.Calendar(calendarEl, {
							height: 800,
					    contentHeight: 780,
							nowIndicator: true,
						  selectable: true,
							forceEventDuration: true,
							businessHours: {
							  daysOfWeek: [ 1, 2, 3, 4, 5, 6 ],
							  startTime: '08:00',
							  endTime: '20:00',
							},
							initialView: 'timeGridWeek',

              eventClick: function(info) { // stergere programare
                if (confirm("Doriți să ștergeți programarea? ") == true)
                {
                  $.ajax({ // pt apel functie php din js
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
                }
                location.reload();
              },

							events: [ // programarile propriu zise
								<?php foreach($prog as $event): // preluare date din php?>
								{
                  // afisare imbricata js cu php
									id: <?=$event['id_programare']?>,
									<?php if (!empty($event['id_doctor']) && isset($_SESSION['pacient'])):?>
										title: "<?= 'Programare Dr. '.$event['nume_doc']?>",
									<?php elseif (isset($_SESSION['doctor'])):?>
										title: "<?= 'Programare Dr. '.$event['nume_pac']?>",
									<?php endif;?>
									start: "<?=$event['data'].'T'.$event['ora']?>",
									<?php if (!empty($event['ora_sfarsit'])):?>
										end: "<?=$event['data'].'T'.$event['ora_sfarsit']?>",
									<?php endif;?>
									color: '#c9ac87'
								},
								<?php endforeach;?>
							]
						});

						calendar.render();
					});
				</script>
				<div id='calendar'></div>
		   <?php endif;?>
    </div>
  </div>
</div>

<?php include_once('data/footer.php')?>
