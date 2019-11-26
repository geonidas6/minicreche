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
            <h1 class='h3 mb-0 text-gray-800'>Lomé Crèche<sup>2</sup></h1>
            ";
if ($list_historique_detail['regler'] = false){
    $content .= " <a href='#' class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm'><i class='fas fa-smile fa-sm text-white-50'></i> REGLEE</a>
";

}else{
    $content .= " <a href='#' class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm'><i class='fas fa-thumbs-down fa-sm text-white-50'></i> ENCOURS DE REGLEMENT</a>
";

}
$content .= " </div>

          <!-- Content Row -->
         <h1 class='h3 mb-2 text-gray-800'></h1>
        
          <!-- DataTales Example -->
          <div class='card shadow mb-4'>
            <div class='card-header py-3'>
              <h6 class='m-0 font-weight-bold text-primary'>DERNIER PAIEMENT POUR LE : ".$list_historique_detail['date_debut']." à ".$list_historique_detail['date_fin']."</h6>
            </div>
            <div class='card-body'>
              <div class='table-responsive'>
                <table class='table table-bordered' width='100%' cellspacing='0'>
                   <tbody>
                  <tr>
                    <th style='text-align: center;text-decoration: underline;'>Somme a payer:</th> <td>".$list_paiement_detail['somme_a_payer']." FRANCS CFA</td>
                    </tr>
                    <tr>
                      <th style='text-align: center;text-decoration: underline;'>Montant regler:</th> <td>".$montant_regler." FRANCS CFA</td>
                       </tr>
                    <tr>
                      <th style='text-align: center;text-decoration: underline;'>Reter a payer:</th><td>".$list_paiement_detail['reste_a_payer']." FRANCS CFA</td>
                       </tr>
                    <tr>
                      <th style='text-align: center;text-decoration: underline;'>Date paiement:</th> <td>".$list_paiement_detail['date_paiement']."</td>
                       </tr>
                  
                    </tbody>
                </table>
              </div>
            </div>
          </div>
      <!-- End of Main Content -->

";


$content .= " </div>

          <!-- Content Row -->
         <h1 class='h3 mb-2 text-gray-800'></h1>
        
          <!-- DataTales Example -->
          <div class='card shadow mb-4'>
            <div class='card-header py-3'>
              <h6 class='m-0 font-weight-bold text-primary'>RESTE A PAYER :".$list_paiement_detail['reste_a_payer']." FRANCS CFA</h6>
            </div>
            <div class='card-body'>
            <h6><mark>Regler en même temps</mark></h6>
               <form method='post' action='?cl=PaiementCotrolleur&mt=addOledaction' style='margin-left: 25%;margin-right: 25%'>
                          <input type='hidden' class='form-control' value='".$list_historique_detail['date_debut']."' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-sm' name='data[date_debut]'>
                          <input type='hidden' class='form-control' value='".$list_historique_detail['date_fin']."' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-sm' name='data[date_fin]'>
                          <input type='hidden' class='form-control' value='".$list_paiement_detail['id_enfant']."' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-sm' name='data[id_enfant]'>
                          <input type='hidden' class='form-control' value='".$list_paiement_detail['numero_paiement']."' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-sm' name='data[numero_paiement]'>
                          <input type='hidden' class='form-control'value='".$list_paiement_detail['reste_a_payer']."' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-sm' name='data[reste_a_payer]'>
                         <div class='input-group input-group-sm mb-3'>
                              <div class='input-group-prepend'>
                                <span class='input-group-text' id='inputGroup-sizing-sm'><i class='fa fa-dollar'></i> $</span>
                              </div>
                              <input type='number' class='form-control' aria-label='Sizing example input' aria-describedby='inputGroup-sizing-sm' name='data[montant_regler]'>
                        </div>
                        
                         
                        <button type='submit' id='' class='btn btn-primary'><i class='fa fa-w-2 fa-plus'></i> Payer</button>
                       
                    </form>
            </div>
          </div>
      <!-- End of Main Content -->

";




echo $content;

require_once "acceuil_footer.php";


