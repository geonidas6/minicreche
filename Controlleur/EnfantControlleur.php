<?php
/**
 * Created by PhpStorm.
 * User: geonidas
 * Date: 15/06/2019
 * Time: 10:09
 */

namespace Creche\Controlleur;


use Creche\Model\Enfant;
use Creche\Model\Utils;

class EnfantControlleur
{

    var $vue = __DIR__ . "/../Vue/theme/";
    private $enfant;

    /**
     * HotelControlleur constructor.
     */
    public function __construct()
    {
        $this->enfant = new Enfant();
    }

    public function addaction(){
        $data = $_REQUEST['data'];
        if ($data != null){
            $firstname = $data['firstname'];
            $lastname = $data['lastname'];
            $datedenaissance = $data['datedenaissance'];
            $date_inscription = $data['date_inscription'];
            $data = [
                "firstname"=>$firstname,
                "lastname"=>$lastname,
                "datedenaissance"=>$datedenaissance,
                "date_inscription"=>date("Y-m-d"),
            ];
            $table = "enfant";
            $where =  "";
            $reponse = $this->enfant->_genereSql($data,$table,$where,'insert');
            if ($reponse == true){
                $_SESSION['message']['text'] = "Ajout d\'enfant effectuer avec succès";
                $_SESSION['message']['type'] = "success";
                $_SESSION['message']['title'] = "Success";
            }else{
                $_SESSION['message']['text'] = "Le système à rencontrer un erreur veillez réssayer";
                $_SESSION['message']['type'] = "error";
                $_SESSION['message']['title'] = "Error";
            }
            header("Location: ?EnfantConsulter");
        }
    }

    function  indexAction(){
        $champs = ["id_enfant","firstname", "lastname","datedenaissance","date_inscription"];
        $table = "enfant";
        $where = "";
        $enfant = $this->enfant->_champsMultiples($champs,$table,$where);
        return $enfant;
    }

    function  listEnfantByDateInscription(){
        $champs = ["Count(id_enfant)","date_inscription"];
        $table = "enfant";
        $where = " ";
        $enfant = $this->enfant->_champsMultiples($champs,$table,$where,'date_inscription','ASC',0,'date_inscription');
        return $enfant;
    }




    function delete(){
        $id  = $_REQUEST['id'];
        $data  = [];

        $table =  "parent_enfant";
        $where = "WHERE id_enfant = $id";

       $this->enfant->_genereSql($data,$table,$where,'delete');

        $table =  "enfant";
        $where = "WHERE id_enfant = $id";

        $reponse = $this->enfant->_genereSql($data,$table,$where,'delete');

        if ($reponse == true){
            $_SESSION['message']['text'] = "supression de l\'enfant effectuer avec succès";
            $_SESSION['message']['type'] = "success";
            $_SESSION['message']['title'] = "Success";
        }else{
            $_SESSION['message']['text'] = "Le système à rencontrer un erreur veillez réssayer";
            $_SESSION['message']['type'] = "error";
            $_SESSION['message']['title'] = "Error";
        }


        header("Location: ?EnfantConsulter");


    }

    function updateAction(){
        $id = $_REQUEST['id'];
        $data = $_REQUEST['data'];
        if ($data != null){
            $firstname = $data['firstname'];
            $lastname = $data['lastname'];
            $datedenaissance = $data['datedenaissance'];
            $date_inscription = $data['date_inscription'];
            $data = [
                "firstname"=>$firstname,
                "lastname"=>$lastname,
                "datedenaissance"=>$datedenaissance,
            ];
            $table = "enfant";
            $where =  " WHERE id_enfant = '$id'";
            $reponse = $this->enfant->_genereSql($data,$table,$where,'update');
            if ($reponse == true){
                $_SESSION['message']['text'] = " Modification effectuer avec succès";
                $_SESSION['message']['type'] = "success";
                $_SESSION['message']['title'] = "Success";
            }else{
                $_SESSION['message']['text'] = "Le système à rencontrer un erreur veillez réssayer";
                $_SESSION['message']['type'] = "error";
                $_SESSION['message']['title'] = "Error";
            }
            header("Location: ?EnfantConsulter");
        }

    }

    function modifierForm(){
        $id = $_REQUEST['id'];
        $champs = ["id_enfant","firstname", "lastname","datedenaissance"];
        $table = "enfant";
        $where = " WHERE id_enfant = '$id'";

        $enfant = $this->enfant->_champsMultiples($champs,$table,$where);
        $lien ="?cl=EnfantControlleur&mt=updateAction&id=$id";
        $champs_form = [
            "firstname"=>["NOM",$enfant[0]['firstname'],"text"],
            "lastname"=>["PRENOM",$enfant[0]['lastname'],"text"],
            "datedenaissance"=>["DATE DE NAINSSANCE",$enfant[0]['datedenaissance'],"date"],
        ];


        $form = $this->enfant->_genereForm($table,$champs_form,$lien);

        $vars['form']  = $form;
        //var_dump($form);exit;
        echo Utils::render($this->vue . "updateform.php", $vars);

    }

}