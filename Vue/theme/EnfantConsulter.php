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
         <h1 class='h3 mb-2 text-gray-800'>Enfant</h1>
        
          <!-- DataTales Example -->
          <div class='card shadow mb-4'>
            <div class='card-header py-3'>
              <h6 class='m-0 font-weight-bold text-primary'>La liste des enfant</h6>
            </div>
            <div class='card-body'>
              <div class='table-responsive'>
                <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                  <thead>
                   <th>#</th>
                      <th>Nom</th>
                      <th>Prenom</th>
                      <th>Date de naissance</th>
                      <th>Date d'inscription</th>
                      <th>Action</th>
                  </thead>
                  <tfoot>
                  <tr>
                      <th>#</th>
                      <th>Nom</th>
                      <th>Prenom</th>
                      <th>Date de naissance</th>
                      <th>Date d'inscription</th>
                      <th>Action</th>
                    </tr>
                    </tfoot>
                     <tbody>";

if (count($list_enfant) > 0){
    $i =0;
    foreach ($list_enfant as  $key=>$value){
        $content .= " 
        <tr>
            <td>".$i++."</td>
            <td>".$list_enfant[$key]['firstname']."</td>
            <td>".$list_enfant[$key]['lastname']."</td>
            <td>".$list_enfant[$key]['datedenaissance']."</td>
            <td>".$list_enfant[$key]['date_inscription']."</td>
            <td>
                <a href='?cl=EnfantControlleur&mt=modifierForm&id=".$list_enfant[$key]['id_enfant']."' class='fa fa-w-2 fa-edit'></a>|
                <a href='?cl=EnfantControlleur&mt=delete&id=".$list_enfant[$key]['id_enfant']."' class='fa fa-w-2 fa-trash'></a>|
                <a href='?TuteurenfantConsulter&id=".$list_enfant[$key]['id_enfant']."' class='fa fa-w-2 fa-users'></a>
            </td>
         </tr>
 
 
 ";
    }

}


$content .="  </tbody>
                </table>
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


