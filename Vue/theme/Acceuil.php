<?php
/**
 * Created by PhpStorm.
 * User: geonidas
 * Date: 15/06/2019
 * Time: 11:34
 */

require_once "acceuil_head.php";
require_once "acceuil_sidebar.php";

echo "
  <!-- Main Content -->
       <div id='content-wrapper' class='d-flex flex-column'>

      <!-- Main Content -->
      <div id='content'>
      


";



require_once "top_nav_bar.php";

$content = "
   
<!-- Begin Page Content -->
        <div class='container-fluid'>
          <!-- Page Heading -->
          <div class='d-sm-flex align-items-center justify-content-between mb-4'>
            <h1 class='h3 mb-0 text-gray-800'>Dashboard</h1>
            <a href='#' class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm'><i class='fas fa-download fa-sm text-white-50'></i> Generate Report</a>
          </div>

          <!-- Content Row -->
          <div class='row'>

            <!-- Earnings (Monthly) Card Example -->
            <div class='col-xl-3 col-md-6 mb-4'>
              <div class='card border-left-primary shadow h-100 py-2'>
                <div class='card-body'>
                  <div class='row no-gutters align-items-center'>
                    <div class='col mr-2'>
                      <div class='text-xs font-weight-bold text-primary text-uppercase mb-1'>Emploier</div>
                      <div class='h5 mb-0 font-weight-bold text-gray-800'>".count($liste_Emploier)."</div>
					  <small><a href='?EmploierConsulter'>Afficher</a></small>
                    </div>
                    <div class='col-auto'>
                      <i class='fas fa-user fa-2x text-gray-300'></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class='col-xl-3 col-md-6 mb-4'>
              <div class='card border-left-success shadow h-100 py-2'>
                <div class='card-body'>
                  <div class='row no-gutters align-items-center'>
                    <div class='col mr-2'>
                      <div class='text-xs font-weight-bold text-success text-uppercase mb-1'>PAIEMENT ENCOURS</div>
                      <div class='h5 mb-0 font-weight-bold text-gray-800'>".count($liste_nbrpaiement)."</div>
                      <small><a href='?ListePaiementEncours'>Afficher</a></small>
                    </div>
                    <div class='col-auto'>
                      <i class='fas fa-dollar-sign fa-2x text-gray-300'></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

           

            <!-- Pending Requests Card Example -->
            <div class='col-xl-3 col-md-6 mb-4'>
              <div class='card border-left-warning shadow h-100 py-2'>
                <div class='card-body'>
                  <div class='row no-gutters align-items-center'>
                    <div class='col mr-2'>
                      <div class='text-xs font-weight-bold text-warning text-uppercase mb-1'>Enfants</div>
                      <div class='h5 mb-0 font-weight-bold text-gray-800'>".count($liste_Enfant)."</div>
					  <small><a href='?EnfantConsulter'>Afficher</a></small>
                    </div>
                    <div class='col-auto'>
                      <i class='fas fa-user fa-2x text-gray-300'></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
             
            <!-- Pending Requests Card Example -->
            <div class='col-xl-3 col-md-6 mb-4'>
              <div class='card border-left-warning shadow h-100 py-2'>
                <div class='card-body'>
                  <div class='row no-gutters align-items-center'>
                    <div class='col mr-2'>
                      <div class='text-xs font-weight-bold text-warning text-uppercase mb-1'>Parents</div>
                      <div class='h5 mb-0 font-weight-bold text-gray-800'>".count($liste_Parent)."</div>
					  <small><a href='?TuteurConsulter'>Afficher</a></small>
                    </div>
                    <div class='col-auto'>
                      <i class='fas fa-user fa-2x text-gray-300'></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
             </div>
          <!-- Content Row -->

          <div class='container-fluid'>
          <div class='row'>

            <!-- Area Chart -->
            <div class='col-xl-12 col-lg-12'>
              <div class='card shadow mb-12'>
                <!-- Card Header - Dropdown -->
                <div class='card-header py-3 d-flex flex-row align-items-center justify-content-between'>
                  <h6 class='m-0 font-weight-bold text-primary'>Nombre d'inscription par jour</h6>
                  <div class='dropdown no-arrow'>
                    <a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                      <i class='fas fa-ellipsis-v fa-sm fa-fw text-gray-400'></i>
                    </a>
                    <div class='dropdown-menu dropdown-menu-right shadow animated--fade-in' aria-labelledby='dropdownMenuLink'>
                      <div class='dropdown-header'>Dropdown Header:</div>
                      <a class='dropdown-item' href='#'>Action</a>
                      <a class='dropdown-item' href='#'>Another action</a>
                      <div class='dropdown-divider'></div>
                      <a class='dropdown-item' href='#'>Something else here</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class='card-body'>
                  <div class='chart-area'>
                    <canvas id='myAreaChart'></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>

         

        
        <!-- /.container-fluid -->

      </div>
      </div>
      <!-- End of Main Content -->

";




$content_footer = "

<footer class='sticky-footer bg-white'>
        <div class='container my-auto'>
          <div class='copyright text-center my-auto'>
            <span>Copyright &copy; Your Website 2019</span>
          </div>
        </div>
      </footer>
";


echo $content;
echo $content_footer;

require_once "acceuil_footer.php";
//listEnfantByDateInscription
$anne = "";
$nbr = "";
foreach ($listEnfantByDateInscription as $key=>$value){
    $anne .= ",'".$listEnfantByDateInscription[$key]['date_inscription']."'";
    $nbr .= ",".$listEnfantByDateInscription[$key]['Count(id_enfant)'].",";

}
$anne .=",,,";
$nbr .=",kk";
$anne = str_replace(",,,", "", $anne);
//echo $anne;exit;
$nbr = str_replace(",,", ",", $nbr);
$nbr = str_replace(",kk", "", $nbr);


echo "
<script type='text/javascript' >



var ctx = document.getElementById('myAreaChart');
var myLineChart = new Chart(ctx, {
  type: 'line',
  data: {
    labels: [".$anne."],
    datasets: [{
      label: 'Enfant',
      lineTension: 0.3,
      backgroundColor: 'rgba(78, 115, 223, 0.05)',
      borderColor: 'rgba(78, 115, 223, 1)',
      pointRadius: 3,
      pointBackgroundColor: 'rgba(78, 115, 223, 1)',
      pointBorderColor: 'rgba(78, 115, 223, 1)',
      pointHoverRadius: 3,
      pointHoverBackgroundColor: 'rgba(78, 115, 223, 1)',
      pointHoverBorderColor: 'rgba(78, 115, 223, 1)',
      pointHitRadius: 10,
      pointBorderWidth: 2,
      data: [".$nbr."],
    }],
  },
  options: {
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: 10,
        right: 25,
        top: 25,
        bottom: 0
      }
    },
    scales: {
      xAxes: [{
        time: {
          unit: 'date'
        },
        gridLines: {
          display: false,
          drawBorder: false
        },
        ticks: {
          maxTicksLimit: 7
        }
      }],
      yAxes: [{
        ticks: {
          maxTicksLimit: 5,
          padding: 10,
          // Include a dollar sign in the ticks
          callback: function(value, index, values) {
            return number_format(value)+'Enfant';
          }
        },
        gridLines: {
          color: 'rgb(234, 236, 244)',
          zeroLineColor: 'rgb(234, 236, 244)',
          drawBorder: false,
          borderDash: [2],
          zeroLineBorderDash: [2]
        }
      }],
    },
    legend: {
      display: false
    },
    tooltips: {
      backgroundColor: 'rgb(255,255,255)',
      bodyFontColor: '#858796',
      titleMarginBottom: 10,
      titleFontColor: '#6e707e',
      titleFontSize: 14,
      borderColor: '#dddfeb',
      borderWidth: 1,
      xPadding: 15,
      yPadding: 15,
      displayColors: false,
      intersect: false,
      mode: 'index',
      caretPadding: 10,
      callbacks: {
        label: function(tooltipItem, chart) {
          var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
          return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
        }
      }
    }
  }
});


</script>

";