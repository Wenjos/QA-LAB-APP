<?php
  $page_title = 'Muestra en preparación';
  $tracking_show = 'show';
  $class_tracking = ' ';
  $preparation = 'active';
  require_once('../config/load.php');
?>

<?php page_require_level(3); ?>
<?php include_once('../components/header.php');  ?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Muestra en preparación</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="home.php">Home</a></li>
      <li class="breadcrumb-item">Formularios</li>
      <li class="breadcrumb-item active">Muestra en preparación</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<div class="col-md-4"><?php echo display_msg($msg); ?></div>

<section class="section">
  <div class="row">

  <div class="col-lg-5">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">AÑADIR MUESTRA A LA PREPARACIÓN</h5>

        <!-- Multi Columns Form -->
        <form class="row g-3" method="post" action="../database/sample-tracking.php">
          <div class="col-md-12">
            <label for="Sname" class="form-label">Nombre de la muestra</label>
            <input type="text" class="form-control" name="Sname" id="Sname" autocomplete="off">
          </div>
          <div class="col-md-12">
            <label for="Snumber" class="form-label">Numero de muestra</label>
            <input type="text" class="form-control" name="Snumber" id="Snumber" autocomplete="off">
          </div>
          <div class="col-md-12">
            <label for="Ttype" class="form-label">Tipo de prueba</label>
            <select id="Ttype" class="form-select" name="Ttype">
              <option selected disabled>Elegir...</option>
              <option value="MC">MC</option>
              <option value="GS">GS</option>
              <option value="AL">AL</option>
              <option value="SP">SP</option>
              <option value="SG">SG</option>
              <option value="HY">HY</option>
              <option value="DHY">DHY</option>
              <option value="AR">AR</option>
              <option value="SND">SND</option>
              <option value="SCT">SCT</option>
              <option value="PH">PH</option>
              <option value="UCS">UCS</option>
              <option value="BTT">BTT</option>
              <option value="PLT">PLT</option>
              <option value="LAA">LAA</option>
            </select>
          </div>
          <div class="col-md-12">
            <label for="Technician" class="form-label">Técnico/a</label>
            <input type="text" class="form-control" name="Technician" id="Technician" autocomplete="off">
          </div>
          <div>
            <button type="submit" class="btn btn-success" name="test-preparation"><i class="bi bi-save me-1"></i> Guardar preparación</button>
          </div>
        </form><!-- End Multi Columns Form -->

      </div>
    </div>
  </div>

  <div class="col-lg-7">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">LISTA DE MUESTRAS EN PREPARACIÓN</h5>

        <?php $week = date('Y-m-d', strtotime('-7 days'));?>
        <?php $Seach = find_by_sql("SELECT * FROM test_preparation WHERE Start_Date >= '{$week}'");?>
        <!-- Bordered Table -->
        <table class="table table-bordered">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Nombre de la muestra</th>
              <th scope="col">Numero de muestra</th>
              <th scope="col">Tipo de prueba</th>
              <th scope="col">Técnico/a</th>
              <th scope="col">Fecha de inicio</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($Seach as $Seach):?>
              <tr>
                <td><?php echo count_id();?></td>
                <td><?php echo $Seach['Sample_Name']; ?></td>
                <td><?php echo $Seach['Sample_Number']; ?></td>
                <td><?php echo $Seach['Test_Type']; ?></td>
                <td><?php echo $Seach['Technician']; ?></td>
                <td><?php echo $Seach['Start_Date']; ?></td>
                <td>
                  <div class="btn-group" role="group" aria-label="Basic example">
                  <a class="btn btn-primary open-modal-btn" data-bs-toggle="modal" data-bs-target="#disablebackdrop" data-first-visit="true" data-sample-name="<?php echo $Seach['Sample_Name']; ?>"data-sample-number="<?php echo $Seach['Sample_Number']; ?>"data-test-type="<?php echo $Seach['Test_Type']; ?>"data-technician="<?php echo $Seach['Technician']; ?>"data-start-date="<?php echo $Seach['Start_Date']; ?>"><i class="bi bi-send me-1"></i></a>
                  <button type="button" class="btn btn-danger" onclick="modaldelete(<?php echo $Seach['id']; ?>)"><i class="bi bi-trash"></i></button>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <!-- End Bordered Table -->

      </div>
    </div>
  </div>
  
  <!-- Modal Update -->
  <div class="modal fade" id="disablebackdrop" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog">
      <div class="modal-content">

      <form method="post" action="../database/sample-tracking.php"><!-- Multi Columns Form -->
      
      <div class="modal-header">
        <h5 class="modal-title">¡Ey! Envia la muestra a realización</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="row g-3">
          <div class="col-md-12">
            <label for="Sname" class="form-label">Nombre de la muestra</label>
            <input type="text" class="form-control" name="Sname" id="Sname">
          </div>
          <div class="col-md-12">
            <label for="Snumber" class="form-label">Numero de muestra</label>
            <input type="text" class="form-control" name="Snumber" id="Snumber">
          </div>
          <div class="col-md-12">
            <label for="Ttype" class="form-label">Tipo de prueba</label>
            <select id="Ttype" class="form-select" name="Ttype">
              <option selected disabled>Elegir...</option>
              <option value="MC">MC</option>
              <option value="GS">GS</option>
              <option value="AL">AL</option>
              <option value="SP">SP</option>
              <option value="SG">SG</option>
              <option value="HY">HY</option>
              <option value="DHY">DHY</option>
              <option value="AR">AR</option>
              <option value="SND">SND</option>
              <option value="SCT">SCT</option>
              <option value="PH">PH</option>
              <option value="UCS">UCS</option>
              <option value="BTT">BTT</option>
              <option value="PLT">PLT</option>
              <option value="LAA">LAA</option>
            </select>
          </div>
          <div class="col-md-12">
            <label for="Technician" class="form-label">Técnico/a</label>
            <input type="text" class="form-control" name="Technician" id="Technician">
          </div>
        </div>
      </div>
            
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-success" name="send-realization"><i class="bi bi-save me-1"></i> Enviar a realización</button>
      </div>
    
    </form><!-- End Multi Columns Form -->

    </div>

  </div>
 </div>
 <!-- End Modal Update -->

  <!-- Modal Delete -->
  <div class="modal fade" id="ModalDelete" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content text-center">
        <div class="modal-header d-flex justify-content-center">
          <h5>¿Está seguro?</h5>
        </div>
        <div class="modal-body">
          <form id="deleteForm" method="post">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <button type="submit" class="btn btn-outline-danger" name="delete-preparation" onclick="Delete()">Sí</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- End Modal Delete -->

  </div>
</section>

</main><!-- End #main -->

<script>
    // JavaScript para manejar la apertura del modal y la actualización de los datos
    document.addEventListener('DOMContentLoaded', function () {
        var modalTriggerButtons = document.querySelectorAll('.open-modal-btn');
        var modalForm = document.querySelector('#disablebackdrop form');

        modalTriggerButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                // Obtén los datos de la fila correspondiente
                var sampleName = button.getAttribute('data-sample-name');
                var sampleNumber = button.getAttribute('data-sample-number');
                var testType = button.getAttribute('data-test-type');
                var technician = button.getAttribute('data-technician');
                var startDate = button.getAttribute('data-start-date');

                // Actualiza los valores en el formulario dentro del modal
                if (modalForm) {
                    modalForm.querySelector('#Sname').value = sampleName;
                    modalForm.querySelector('#Snumber').value = sampleNumber;
                    modalForm.querySelector('#Ttype').value = testType;
                    modalForm.querySelector('#Technician').value = technician;
                    // Puedes seguir actualizando otros campos según sea necesario
                }
            });
        });
    });
    
    var selectedId; // Variable para almacenar el ID

    function modaldelete(id) {
      // Almacena el ID
      selectedId = id;
  
      // Utiliza el método modal() de Bootstrap para mostrar el modal
      $('#ModalDelete').modal('show');
    }
    
    function Delete() {
      // Verifica si se ha guardado un ID
      if (selectedId !== undefined) {
        // Concatena el ID al final de la URL en el atributo 'action' del formulario
        document.getElementById("deleteForm").action = "../database/sample-tracking.php?id=" + selectedId;

        // Envía el formulario
        document.getElementById("deleteForm").submit();
      } else {
        console.log('No se ha seleccionado ningún ID para eliminar.');
      }
    }
</script>

<?php include_once('../components/footer.php');  ?>