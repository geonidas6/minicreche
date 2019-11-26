<?php
/**
 * Created by PhpStorm.
 * User: geonidas
 * Date: 15/06/2019
 * Time: 11:34
 */

require_once "acceuil_head.php";


echo "
  <!-- Main Content -->
       <div id='content-wrapper' class='d-flex flex-column'>

      <!-- Main Content -->
      <div id='content'>
      


";





$content = "
   
<!-- Begin Page Content -->
        <div class='container-fluid'>
          <!-- Page Heading -->
          <div class='d-sm-flex align-items-center justify-content-between mb-4'>
            <h1 class='h3 mb-0 text-gray-800'>Lomé Crèche<sup>2</sup></h1>
          </div>

          <!-- Content Row -->
         <h1 class='h3 mb-2 text-gray-800'>PAIEMANT DE : ".$data['date_debut']." à ".$data['date_fin']."</h1>
        
          <!-- DataTales Example -->
          <div class='card shadow mb-4'>
            <div class='card-header py-3'>
              <h6 class='m-0 font-weight-bold text-primary'>NOM PRENOM : ".$data['enfant'][0]['firstname']." ".$data['enfant'][0]['lastname']."</h6>
            </div>
            <div class='card-body'>
              <div class='table-responsive'>
                <table class='table table-bordered' width='100%' cellspacing='0'>
                   <tbody>
                  <tr>
                    <th style='text-align: center;text-decoration: underline;'>Somme a payer:</th> <td>".$data['somme_a_payer']." FRANCS CFA</td>
                    </tr>
                    <tr>
                      <th style='text-align: center;text-decoration: underline;'>Montant regler:</th> <td>".$data['montant_regler']." FRANCS CFA</td>
                       </tr>
                    <tr>
                      <th style='text-align: center;text-decoration: underline;'>Reter a payer:</th><td>".$data['reste_a_payer']." FRANCS CFA</td>
                       </tr>
                    <tr>
                      <th style='text-align: center;text-decoration: underline;'>Date paiement:</th> <td>".$data['date_paiement']."</td>
                       </tr>
                  
                    </tbody>
                </table>
              </div>
            </div>
          </div>
      <!-- End of Main Content -->

";




echo $content;

require_once "acceuil_footer.php";

echo "
<script type='text/javascript'>
    $(function () {
        //Mettre la partie l'extension qz ici
        window.print();
        window.location.assign('?PaiementAdd');
    });
</script>

";
