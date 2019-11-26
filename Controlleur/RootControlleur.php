<?php
namespace Creche\Controlleur;
use Creche\Model\Emploier;
use Creche\Model\Paiement;
use Creche\Model\Utils;





/**
 * Created by PhpStorm.
 * User: geonidas
 * Date: 10/06/2019
 * Time: 18:03
 */
class RootControlleur
{

    var $Parentenfant;
    var $EnfantControlleur;
    var $TutueurControlleur;
    var $EmploierControlleur;
    var $PresenceControlleur;
    var $PaiementControlleur;



    var $vue = __DIR__ . "/../Vue/theme/";

    /**
     * RootControlleur constructor.
     * @param $HotelControlleur
     */
    public function __construct()
    {
        $this->EmploierControlleur = new EmploierControlleur();
        $this->TutueurControlleur = new TuteurControlleur();
        $this->EnfantControlleur = new EnfantControlleur();
        $this->Parentenfant = new TuteurenfantControlleur();
        $this->PresenceControlleur = new PresenceControlleur();
        $this->PaiementControlleur = new PaiementCotrolleur();


    }

    /**
     *Acceuil
     */
    function Root()
    {
        $rootname = (isset(array_keys($_REQUEST)[0])) ? array_keys($_REQUEST)[0]: "";
        $vars['root'] = $rootname;

        //les controls sur es roots
        if ($rootname == "Admin") {
            /* $vars['liste_hotel'] = $this->HotelControlleur->indexAction();
            $vars['liste_chambre'] = $this->ChambreControlleur->indexAction();
            $vars['liste_client'] = $this->ClientControlleur->indexAction();
            $vars['liste_reservation'] = $this->Reservation->indexAction();
           foreach ($vars['liste_hotel'] as $key=>$value){

                //var_dump("<pre>",$vars['liste_hotel'][$key]['tel_hotel'],"</pre>");
            }exit;*/
        } elseif ($rootname == "") {
            $rootname = "login";
            echo Utils::render($this->vue . "$rootname.php", $vars);
            exit;
        } elseif ($rootname == "register") {
            $rootname = "register";
            echo Utils::render($this->vue . "$rootname.php", $vars);
            exit;
        }elseif ($rootname == "forgetpwd") {
            $rootname = "forgetpwd";
            echo Utils::render($this->vue . "$rootname.php", $vars);
            exit;
        }elseif ($rootname == "Acceuil") {
            $vars['liste_Emploier'] = $this->EmploierControlleur->indexAction();
            $vars['liste_Enfant'] = $this->EnfantControlleur->indexAction();
            $vars['liste_Parent'] = $this->TutueurControlleur->indexAction();
            $vars['liste_nbrpaiement'] = $this->PaiementControlleur->nbrpaiementencours();
            $vars['listEnfantByDateInscription'] = $this->EnfantControlleur->listEnfantByDateInscription();

            $rootname = "Acceuil";
            echo Utils::render($this->vue . "$rootname.php", $vars);
            exit;
        }elseif ($rootname == "TuteurConsulter") {
            $vars['list_parent'] = $this->TutueurControlleur->indexAction();
            $rootname = "TuteurConsulter";
            echo Utils::render($this->vue . "$rootname.php", $vars);
            exit;
        }elseif ($rootname == "EnfantConsulter") {
            $vars['list_enfant'] = $this->EnfantControlleur->indexAction();
            $rootname = "EnfantConsulter";
            echo Utils::render($this->vue . "$rootname.php", $vars);
            exit;
        }elseif ($rootname == "EmploierConsulter") {
            $vars['list_emploier'] = $this->EmploierControlleur->indexAction();
            $rootname = "EmploierConsulter";
            echo Utils::render($this->vue . "$rootname.php", $vars);
            exit;
        }elseif ($rootname == "EmploierConsulter") {
            $vars['list_parentenfant'] = $this->Parentenfant->indexAction();
            $rootname = "ParentEnfantConsulter";
            echo Utils::render($this->vue . "$rootname.php", $vars);
            exit;
        }elseif ($rootname == "ParentenfantFormAdd") {
            $vars['list_enfant'] = $this->EnfantControlleur->indexAction();
            $rootname = "ParentenfantFormAdd";
            echo Utils::render($this->vue . "$rootname.php", $vars);
            exit;
        }elseif ($rootname == "TuteurenfantConsulter") {
            $vars['list_parentenfant'] = $this->Parentenfant->indexAction();
            $rootname = "TuteurenfantConsulter";
            echo Utils::render($this->vue . "$rootname.php", $vars);
            exit;
        }elseif ($rootname == "TuteurenfantByParentConsulter") {
            $vars['list_parentenfant'] = $this->Parentenfant->indexAction(true);
            $rootname = "TuteurenfantByParentConsulter";
            echo Utils::render($this->vue . "$rootname.php", $vars);
            exit;
        }elseif ($rootname == "ControlPresnce") {
            $vars['list_presence'] = $this->PresenceControlleur->listpresence();
            $vars['list_abscence'] = $this->PresenceControlleur->listabscence();
            $rootname = "ControlPresnce";
            echo Utils::render($this->vue . "$rootname.php", $vars);
            exit;
        }elseif ($rootname == "PaiementAdd") {
            $_SESSION['firstload'] = true;
            $vars['list_enfant'] = $this->PaiementControlleur->listEnfant();
            $vars['that_day']  = date('Y-m-d');
            $vars['SOMME_A_APYER']  = $this->PaiementControlleur->getSommeAPayer();
            $vars['previous_mmonth'] = date('Y-m-d',mktime(0, 0, 0, date("m")-1,   date("d"),   date("Y")));

            $rootname = "PaiementAdd";
            echo Utils::render($this->vue . "$rootname.php", $vars);
            exit;
        }elseif ($rootname == "PaiementConsulter") {
            $vars['list_Paiement'] = $this->PaiementControlleur->indexAction();
            $rootname = "PaiementConsulter";
            echo Utils::render($this->vue . "$rootname.php", $vars);
            exit;
        }elseif ($rootname == "ListePaiementEncours") {
            $vars['list_Paiement'] = $this->PaiementControlleur->ListePaiementEncours();
            $rootname = "ListePaiementEncours";
            echo Utils::render($this->vue . "$rootname.php", $vars);
            exit;
        }


        echo Utils::render($this->vue . "$rootname.php", $vars);


    }

}