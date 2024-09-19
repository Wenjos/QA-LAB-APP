<?php
  $page_title = 'Specific Gravity Fine Filter';
  $formPresa = ' ';
  $formPresaShow = 'show';
  require_once('../config/load.php');
?>

<?php 
  // Manejo de los formularios
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['specific-gravity-fine'])) {
        include('../database/specific-gravity.php');
    } 
  }
?>

<?php page_require_level(1); ?>
<?php include_once('../components/header.php');  ?>
<main id="main" class="main">

<div class="pagetitle">
  <h1>Specific Gravity Fine Filter</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="home.php">Home</a></li>
      <li class="breadcrumb-item">Forms</li>
      <li class="breadcrumb-item active">Specific Gravity Fine Filter</li>
    </ol>
  </nav>
</div><!-- End Page Title -->
<section class="section">
  <div class="row">

  <form class="row" action="specific-gravity-fine-filter.php" method="post">

  <div id="product_info"></div>

  <div class="col-md-4">
  <?php echo display_msg($msg); ?>
  </div>

    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Trial Information</h5>

          <!-- Multi Columns Form -->
          <div class="row g-3">
            <div class="col-md-6">
              <label for="Standard" class="form-label">Standard</label>
              <select id="Standard" class="form-select" name="Standard">
                <option value="ASTM-D854">ASTM-D854</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="TestMethod" class="form-label">Test Method</label>
              <input type="text" class="form-control" name="TestMethod" id="TestMethod">
            </div>
            <div class="col-md-6">
              <label for="Technician" class="form-label">Technician</label>
              <input type="text" class="form-control" name="Technician" id="Technician">
            </div>
            <div class="col-md-6">
              <label for="DateTesting" class="form-label">Date of Testing</label>
              <input type="date" class="form-control" name="DateTesting" id="DateTesting">
            </div>
            <div class="col-12">
              <label for="Comments" class="form-label">Comments</label>
              <textarea class="form-control" name="Comments" id="Comments" style="height: 100px;"></textarea>
            </div>
          </div><!-- End Multi Columns Form -->

        </div>
      </div>

    </div>

    <div class="col-lg-7">

    <div class="card">
            <div class="card-body">
              <h5 class="card-title">Testing Information</h5>
              <!-- Bordered Table -->
              <table class="table table-bordered" oninput="SGFINE()">
                <tbody>

                <?php
                $datos = array(
                  "A)Pycnometer Number :",
                  "B)Weight of Pycnometer(g): ",
                  "C)Weight of Dry Soil + Tare (g):",
                  "D)Weight of Dry Soil (g):",
                  "E)Weight of Saturated Surface Dry Soil in Air (g):",
                  "F)Temperature of Sample (°C) :",
                  "G)Weight of Pycnometer + Soil + Water (g):",
                  "H)Calibration Weight of Pycnometer at Desired Temperature (g):"
                );
                
                $id = array("PycnoNumber", "WeightPycno", "WeightDryTare", "WeightDry", "WeightSurfaceAir", "TempSample", "WeightPycnoWater", "CalibrationPycno");

                foreach ($datos as $indice => $dato) {
                  echo "<tr>";
                  echo "<th scope='row'>$dato</th>";
                  echo "<td><input type='text' style='border: none;' class='form-control' name='{$id[$indice]}' id='{$id[$indice]}'></td>";
                  echo "</tr>";
                }
                ?>

                </tbody>
              </table>
              <!-- End Bordered Table -->
            </div>
          </div>
    </div>

    
    <div class="col-lg-5">
      
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Results</h5>
        <!-- Bordered Table -->
        <table class="table table-bordered">
          <tbody>
            <tr>
              <th scope="col">Specific Gravity D/(H+E-G)=</th>
              <td><input type="text" style="border: none;" class="form-control" name="SpecificGravityOD" id="SpecificGravityOD"></td>
              <th scope="col">Specific Gravity (SSD) (E/(H+E-G)=</th>
              <td><input type="text" style="border: none;" class="form-control" name="SpecificGravitySSD" id="SpecificGravitySSD"></td>
            </tr>
            <tr>
              <th scope="col">Apparent Specific Gravity D/(H+E-G) =</th>
              <td><input type="text" style="border: none;" class="form-control" name="ApparentSpecificGravity" id="ApparentSpecificGravity"></td>
              <th scope="col">Percent of Absortion (E-D)/D*100</th>
              <td><input type="text" style="border: none;" class="form-control" name="PercentAbsortion" id="PercentAbsortion"></td>
            </tr>
          </tbody>
        </table>
        <!-- End Bordered Table -->
      </div>
    </div>

    <div class="col-lg-6">
      
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Actions</h5>
        <!-- Actions Buttons -->
        <div class="d-grid gap-2 mt-3">
          <button type="submit" class="btn btn-success" name="specific-gravity-fine">Save Essay</button>
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#disablebackdrop" data-first-visit="true">Launch</button>
        </div>
      
      </div>
    </div>
  
  </div>

  </div>

  </form>

  </div>
</section>

</main><!-- End #main -->

<div class="modal fade" id="disablebackdrop" tabindex="-1" data-bs-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hey! select an option</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <li>
                    <a href="specific-gravity-coarse-filter.php"
                        <span>Specific Gravity Coarse Filter</span>
                    </a>
                </li>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="../js/Specific-Gravity.js"></script>
<?php include_once('../components/footer.php');  ?>