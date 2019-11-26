<?php
$Sidebar = "
 <!-- Sidebar -->
    <ul class='navbar-nav bg-gradient-primary sidebar sidebar-dark accordion' id='accordionSidebar'>

      <!-- Sidebar - Brand -->
      <a class='sidebar-brand d-flex align-items-center justify-content-center' href='?Acceuil'>
        <div class='sidebar-brand-icon rotate-n-15'>
          <i class='fas fa-laugh-wink'></i>
        </div>
        <div class='sidebar-brand-text mx-3'>Lomé Crèche<sup>2</sup></div>
      </a>

      <!-- Divider -->
      <hr class='sidebar-divider my-0'>

      <!-- Nav Item - Dashboard -->
      <li class='nav-item active'>
        <a class='nav-link' href='?Acceuil'>
          <i class='fas fa-fw fa-tachometer-alt'></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class='sidebar-divider'>

      <!-- Heading -->
      <div class='sidebar-heading'>
        Interface
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class='nav-item'>
        <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#collapseTwo' aria-expanded='true' aria-controls='collapseTwo'>
          <i class='fas fa-fw fa-user'></i>
          <span>Parents</span>
        </a>
        <div id='collapseTwo' class='collapse' aria-labelledby='headingTwo' data-parent='#accordionSidebar'>
          <div class='bg-white py-2 collapse-inner rounded'>
            <h6 class='collapse-header'>Parametrer les parents:</h6>
            <a class='collapse-item' href='?TuteurFormAdd'>Formulaire d'ajout</a>
            <a class='collapse-item' href='?TuteurConsulter'>Liste</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class='nav-item'>
        <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#collapseUtilities' aria-expanded='true' aria-controls='collapseUtilities'>
          <i class='fas fa-fw fa-user'></i>
          <span>Enfants</span>
        </a>
        <div id='collapseUtilities' class='collapse' aria-labelledby='headingUtilities' data-parent='#accordionSidebar'>
          <div class='bg-white py-2 collapse-inner rounded'>
            <h6 class='collapse-header'>Parametrer les enfants:</h6>
            <a class='collapse-item' href='?EnfantFormAdd'>Formulaire d'ajout</a>
            <a class='collapse-item' href='?EnfantConsulter'>Liste</a>
          </div>
        </div>
      </li>";
if ($_SESSION['user_creche']['email'] == "admin@admin.com"){
    $Sidebar .= "
    
     <!-- Nav Item - Emploier Collapse Menu -->
      <li class='nav-item'>
        <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#collapseEmploier' aria-expanded='true' aria-controls='collapseEmploier'>
          <i class='fas fa-fw fa-user'></i>
          <span>Employer</span>
        </a>
        <div id='collapseEmploier' class='collapse' aria-labelledby='headingUtilities' data-parent='#accordionSidebar'>
          <div class='bg-white py-2 collapse-inner rounded'>
            <h6 class='collapse-header'>Parametrer les emplyer:</h6>
            <a class='collapse-item' href='?EmploierFormAdd'>Formulaire d'ajout</a>
            <a class='collapse-item' href='?EmploierConsulter'>Liste</a>
          </div>
        </div>
      </li>

    ";
}

$Sidebar .= " <!-- Divider -->
      <hr class='sidebar-divider'>

      <!-- Heading -->
      <div class='sidebar-heading'>
        Parametre
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class='nav-item'>
        <a class='nav-link collapsed' href='#' data-toggle='collapse' data-target='#collapsePages' aria-expanded='true' aria-controls='collapsePages'>
          <i class='fas fa-fw fa-folder'></i>
          <span>Gestions</span>
        </a>
        <div id='collapsePages' class='collapse' aria-labelledby='headingPages' data-parent='#accordionSidebar'>
          <div class='bg-white py-2 collapse-inner rounded'>
            <h6 class='collapse-header'>lien parents enfants:</h6>
            <a class='collapse-item' href='?ParentenfantFormAdd'>Lien parents enfants</a>
            <div class='collapse-divider'></div>
            <h6 class='collapse-header'>Control & Sécurité:</h6>
            <a class='collapse-item' href='?ControlPresnce'>Control de présence</a>
            <a class='collapse-item' href='?cl=PresenceControlleur&mt=indexAction'>Liste de présence</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Charts -->
      <li class='nav-item'>
        <a class='nav-link' href='?PaiementAdd'>
          <i class='fa fa-dollar-sign fa-2x text-gray-300'></i>
          <span>Paiement</span></a>
      </li>

      <!-- Nav Item - Tables -->
      <li class='nav-item'>
        <a class='nav-link' href='?PaiementConsulter'>
          <i class='fas fa-fw fa-table'></i>
          <span>Consulter les paiement</span></a>
      </li>

      <!-- Divider -->
      <hr class='sidebar-divider d-none d-md-block'>

      <!-- Sidebar Toggler (Sidebar) -->
      <div class='text-center d-none d-md-inline'>
        <button class='rounded-circle border-0' id='sidebarToggle'></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

";

echo $Sidebar;
