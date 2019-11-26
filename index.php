<?php
session_start();
require_once "Vue/theme/vendor/custom_msg_js.php";
require_once "Controlleur/VarDump.php";
require_once "Model/Db.php";
require_once "Controlleur/PaiementCotrolleur.php";
require_once "Controlleur/PresenceControlleur.php";
require_once "Controlleur/TuteurenfantControlleur.php";
require_once "Controlleur/EmploierControlleur.php";
require_once "Controlleur/TuteurControlleur.php";
require_once "Controlleur/EnfantControlleur.php";
require_once "Controlleur/RootControlleur.php";

require_once "Model/Paiement.php";
require_once "Model/Presence.php";
require_once "Model/Tuteurenfant.php";
require_once "Model/Enfant.php";
require_once "Model/Tuteur.php";
require_once "Model/Emploier.php";
require_once "Model/Utils.php";


/*
 * Set error reporting to the max level.
 */
error_reporting(E_ALL);

//ini_set('display_errors','stderr');

/*
 * Set UTC timezone.
 */

$lib_controller = (isset($_REQUEST['cl'])) ? ($_REQUEST['cl']) : 'Acceuil';
$action = (isset($_REQUEST['mt'])) ? $_REQUEST['mt'] : '';

if ((!isset($_REQUEST['cl'] )) && (!isset($_REQUEST['mt']))){
    $homeControlleur = new \Creche\Controlleur\RootControlleur();
    $homeControlleur->Root();
    exit;
}






if ($lib_controller != '') {
    $lib_controller =  "creche\\Controlleur\\".$lib_controller;
    //var_dump($lib_controller,class_exists("Luxuria\\Controlleur\\".$lib_controller));exit;
    if(class_exists(($lib_controller))){
        $controller = new $lib_controller();
        if (method_exists($controller,$action)){

            $controller->$action();
        } else {
            echo "Adresse action  incorrecte.";
        }
    } else {
        echo "Adresse root incorrecte.";
    }
}
?>