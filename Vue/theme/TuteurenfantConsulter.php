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

if (count($list_parentenfant) > 0){
    $enfant_firstname = $list_parentenfant[0]['enfant_firstname'];
    $enfant_lastname = $list_parentenfant[0]['enfant_lastname'];
    $datedenaissance = $list_parentenfant[0]['datedenaissance'];
    $date_inscription = $list_parentenfant[0]['date_inscription'];


    $content = "
   
<!-- Begin Page Content -->
        <div class='container-fluid'>
          <!-- Page Heading -->
          <div class='d-sm-flex align-items-center justify-content-between mb-4'>
            <h1 class='h3 mb-0 text-gray-800'>Dashboard</h1>
            <a href='#' class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm'><i class='fas fa-download fa-sm text-white-50'></i> Generate Report</a>
          </div>

          <!-- Content Row -->
         <h1 class='h3 mb-2 text-gray-800'>".$enfant_firstname." ".$enfant_lastname." </h1>
        
          <!-- DataTales Example -->
          <div class='card shadow mb-4'>
            <div class='card-header py-3'>
              <h6 class='m-0 font-weight-bold text-primary'>La liste des parents de ".$enfant_firstname." ".$enfant_lastname." </h6>
            </div>
            <div class='card-body'>
              <div class='table-responsive'>
                <table class='table table-bordered' id='dataTable' width='100%' cellspacing='0'>
                  <thead>
                    <th>#</th>
                      <th>Nom</th>
                      <th>Prenom</th>        
                      <th>Email</th>        
                      <th>Action</th>
                  </thead>
                  <tfoot>
                  <tr>
                      <th>#</th>
                      <th>Nom</th>
                      <th>Prenom</th>        
                      <th>Email</th>        
                      <th>Action</th>
                    </tr>
                    </tfoot>
                     <tbody>";

    $content .="
                    <tr>
                        <th nowrap='' colspan='5' style='text-align: center; text-decoration: underline'> ENFANT-INFOS </th>
                    </tr>
                    <tr>
                        <th nowrap='' colspan='5' style='text-align: center;'> NOM-PRENOM   </th>
                    </tr>
                    <tr>
                        <td colspan='5'  style='text-align: center;'> ".$enfant_firstname." ".$enfant_lastname." </td>
                     </tr>
                    <tr>
                        <th colspan='5'  style='text-align: center;'>Date de naissance |  Date d'insciption</th>
                    </tr>
                    <tr>   
                        <td colspan='5'  style='text-align: center;'>".$datedenaissance." | ".$date_inscription." </td>
                    </tr>
                    <tr>
                        <th nowrap='' colspan='5' style='text-align: center; text-decoration: underline'> PARENTS-INFOS </th>
                    </tr>
                    
            ";

    if (count($list_parentenfant) > 0){
        $i =0;
        foreach ($list_parentenfant as  $key=>$value){
            $content .= " 
        <tr>
            <td>".$i++."</td>
            <td>".$list_parentenfant[$key]['parent_firstname']."</td>
            <td >".$list_parentenfant[$key]['parent_lastname']."</td>
            <td >".$list_parentenfant[$key]['parent_email']."</td>
            <td>
               
                <a href='?cl=TuteurenfantControlleur&mt=delete&id=".$list_parentenfant[$key]['id_parent_enfant']."' class='fa fa-w-2 fa-trash'></a>
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

}else{
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
                  <h6 class='m-0 font-weight-bold text-primary'>Formulaire d'ajout d'enfant</h6>
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
                Cet enfant n'a pas encore de parent
                   </div>
              </div>
      </div>
      <!-- End of Main Content -->

";
}






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


