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

$content_entete = "
   
<!-- Begin Page Content -->
        <div class='container-fluid'>
          <!-- Page Heading -->
          <div class='d-sm-flex align-items-center justify-content-between mb-4'>
            <h1 class='h3 mb-0 text-gray-800'>Dashboard</h1>
            <a href='#' class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm'><i class='fas fa-download fa-sm text-white-50'></i> Generate Report</a>
          </div>

          <!-- Content Row -->
         <h1 class='h3 mb-2 text-gray-800'>Enfant</h1>";




$content_presence ="  
  <!-- DataTales Example -->
  <div class='card shadow mb-4'>
            <div class='card-header py-3'>
              <h6 class='m-0 font-weight-bold text-primary'>La liste des enfants présent aujoud'huit</h6>
            </div>
            <div class='card-body'>
              <div class='table-responsive'>
                <table class='table table-bordered' id='dataTablepresence' width='100%' cellspacing='0'>
                  <thead>
                   <th>#</th>
                      <th>Nom</th>
                      <th>Prenom</th>
                      <th>Date de naissance</th>
                      <th>Date d'inscription</th>
                       <th>Heur Arriver</th>
                      <th>Heur Depart</th>
                      <th>Action Depart</th>
                  </thead>
                  <tfoot>
                  <tr>
                      <th>#</th>
                      <th>Nom</th>
                      <th>Prenom</th>
                      <th>Date de naissance</th>
                      <th>Date d'inscription</th>
                      <th>Heur Arriver</th>
                      <th>Heur Depart</th>
                      <th>Action Depart</th>
                    </tr>
                    </tfoot>
                     <tbody>";

if (count($list_presence) > 0){
    $i =0;
    foreach ($list_presence as  $key=>$value){
        $content_presence .= " 
        <tr>
            <td>".$i++."</td>
            <td>".$list_presence[$key]['firstname']."</td>
            <td>".$list_presence[$key]['lastname']."</td>
            <td>".$list_presence[$key]['datedenaissance']."</td>
            <td>".$list_presence[$key]['date_inscription']."</td>
            <td>".$list_presence[$key]['heur_arriver']."</td>
            <td>".$list_presence[$key]['heur_depart']."</td>
            <td>";
            if($list_presence[$key]['heur_depart'] == "0000-00-00 00:00:00"){
                $content_presence .=" <a href='?cl=PresenceControlleur&mt=addDepartaction&id=".$list_presence[$key]['id_presence']."' class='fa fa-w-2 fa-minus'></a>";
            }else{
                $content_presence .="<a class='fa fa-w-2 fa-check label-success'></a>";
            }
           $content_presence .=" </td>
         </tr>
 
 
 ";
    }

}


$content_presence .="  </tbody>
                </table>
              </div>
            </div>";





        $content_abscent ="  
  <!-- DataTales Example -->
  <div class='card shadow mb-4'>
            <div class='card-header py-3'>
              <h6 class='m-0 font-weight-bold text-primary'>La liste des enfants</h6>
            </div>
            <div class='card-body'>
              <div class='table-responsive'>
                <table class='table table-bordered' id='dataTableabscence' width='100%' cellspacing='0'>
                  <thead>
                   <th>#</th>
                      <th>Nom</th>
                      <th>Prenom</th>
                      <th>Date de naissance</th>
                      <th>Date d'inscription</th>
                      <th>Action Arriver</th>
                  </thead>
                  <tfoot>
                  <tr>
                      <th>#</th>
                      <th>Nom</th>
                      <th>Prenom</th>
                      <th>Date de naissance</th>
                      <th>Date d'inscription</th>
                      <th>Action Arriver</th>
                    </tr>
                    </tfoot>
                     <tbody>";

if (count($list_abscence) > 0){
    $i =0;
    foreach ($list_abscence as  $key=>$value){
        $content_abscent .= " 
        <tr>
            <td>".$i++."</td>
            <td>".$list_abscence[$key]['firstname']."</td>
            <td>".$list_abscence[$key]['lastname']."</td>
            <td>".$list_abscence[$key]['datedenaissance']."</td>
            <td>".$list_abscence[$key]['date_inscription']."</td>
            <td>
                <a href='?cl=PresenceControlleur&mt=addArriveraction&id_enfant=".$list_abscence[$key]['id_enfant']."' class='fa fa-w-2 fa-plus'></a>
            </td>
         </tr>
 
 
 ";
    }

}


$content_abscent .="  </tbody>
                </table>
              </div>
            </div>";




         $content_finentet =" </div>
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


echo $content_entete;
echo $content_abscent;
echo $content_presence;
echo $content_finentet;
echo $content_footer;

require_once "acceuil_footer.php";

echo "
<script>

$(document).ready(function() {
  $('#dataTablepresence').DataTable();
  $('#dataTableabscence').DataTable();
});

</script>
";


