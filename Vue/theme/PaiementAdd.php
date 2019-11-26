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
          <div class='col-lg-12'>
            <!-- Dropdown Card Example -->
              <div class='card shadow mb-4'>
                <!-- Card Header - Dropdown -->
                <div class='card-header py-3 d-flex flex-row align-items-center justify-content-between'>
                  <h6 class='m-0 font-weight-bold text-primary'>Formulaire de paiement pour le mois de <strong class='label label-danger'> $previous_mmonth - $that_day </strong></h6>
                  <div class='dropdown no-arrow'>
                    <a class='dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                      <i class='fas fa-ellipsis-v fa-sm fa-fw text-gray-400'></i>
                    </a>
                    <div class='dropdown-menu dropdown-menu-right shadow animated--fade-in' aria-labelledby='dropdownMenuLink'>
                      <div class='dropdown-header'>Parametre:</div>
                      <a class='dropdown-item' href='#'>Consulter la liste des enfants</a>
                      <div class='dropdown-divider'></div>
                      <a class='dropdown-item' href='#'>Associer enfant à parent</a>
                    </div>
                  </div>
                </div>
                <!-- Card Body -->
                <div class='card-body'>
                <label class='alert alert-info'>SOMME A PAYER : $SOMME_A_APYER  FRANC CFA</label>
                    <form method='post' action='?cl=PaiementCotrolleur&mt=addNewPaiementaction' style='margin-left: 25%;margin-right: 25%'>
                    
                    
                    
                     <div class='input-group mb-3'>
                          <div class='input-group-prepend' >
                            <label class='input-group-text' for='inputGroupSelect01'><i class='fa fa-user'></i> Enfant</label>
                          </div>
                          <select  class='custom-select form-control'   name='data[id_enfant]' required>
                            <option selected>Choose...</option> ";
                                if (count($list_enfant) > 0){
                                    foreach ($list_enfant as $key=>$value){
                                        $content .= " <option value='".$list_enfant[$key]['id_enfant']."'>".$list_enfant[$key]['firstname']." ".$list_enfant[$key]['firstname']."</option>";
                                    }
                                }
                        $content .="
                          </select>
                     </div>
                    
                     
                    
                     <div class='input-group mb-3'>
                              <div class='input-group-append'>
                                <span class='input-group-text'>$</span>
                              </div>
                              <input type='number' class='form-control' aria-label='Amount (to the nearest dollar)' name='data[montant_regler]' required>
                              <div class='input-group-append'>
                                <span class='input-group-text'>.00</span>
                              </div>
                        </div>
                    
                        
                         
                        <button type='submit' id='' class='btn btn-primary'><i class='fa fa-w-2 fa-plus'></i> Payer</button>
                       
                    </form>
                </div>
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


