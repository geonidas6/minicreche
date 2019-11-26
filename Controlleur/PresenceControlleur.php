<?php
/**
 * Created by PhpStorm.
 * User: geonidas
 * Date: 15/06/2019
 * Time: 10:08
 */

namespace Creche\Controlleur;


use Creche\Model\Enfant;
use Creche\Model\Presence;
use Creche\Model\Utils;

class PresenceControlleur
{

    var $vue = __DIR__ . "/../Vue/theme/";
    private $enfant;
    private $presence;

    /**
     * HotelControlleur constructor.
     */
    public function __construct()
    {
        $this->enfant = new Enfant();
        $this->presence = new Presence();
    }

    public function addArriveraction(){
        $id_enfant =  $_REQUEST['id_enfant'];
        if ($id_enfant != null){


            $data = [
                "date"=>date("Y-m-d"),
                "heur_arriver"=>date('Y-m-d H:m:s'),
                "id_enfant"=>$id_enfant,
            ];
            $table = "presence";
            $where =  "";
            $reponse = $this->enfant->_genereSql($data,$table,$where,'insert');
            if ($reponse == true){
                $_SESSION['message']['text'] = "Présence effectuer avec succès";
                $_SESSION['message']['type'] = "success";
                $_SESSION['message']['title'] = "Success";
            }else{
                $_SESSION['message']['text'] = "Le système à rencontrer un erreur veillez réssayer";
                $_SESSION['message']['type'] = "error";
                $_SESSION['message']['title'] = "Error";
            }
            header("Location: ?ControlPresnce");
        }
    }

    public function addDepartaction(){
        $id = $_REQUEST['id'];
        if ($id != null){

            $data = [
                "heur_depart"=>date('Y-m-d H:m:s'),
            ];
            $table = "presence";
            $where =  " WHERE id_presence = $id";
            $reponse = $this->enfant->_genereSql($data,$table,$where,'update');
            if ($reponse == true){
                $_SESSION['message']['text'] = "Départ effectuer avec succès";
                $_SESSION['message']['type'] = "success";
                $_SESSION['message']['title'] = "Success";
            }else{
                $_SESSION['message']['text'] = "Le système à rencontrer un erreur veillez réssayer";
                $_SESSION['message']['type'] = "error";
                $_SESSION['message']['title'] = "Error";
            }
            header("Location: ?ControlPresnce");
        }
    }

    function  indexAction(){

        $champs = ["firstname", "lastname","datedenaissance","date_inscription","id_presence","heur_arriver","heur_depart"];
        $table = "presence p, enfant e ";
        $where = " WHERE  p.id_enfant = e.id_enfant";
        $presence = $this->presence->_simpleSql($champs,$table,$where)->fetchAll();
        $vars['list_presence'] = $presence;
        echo Utils::render($this->vue ."ListePresence.php", $vars);
    }

    function  listabscence(){
        $date = date('Y-m-d');
        $champs = ["id_enfant","firstname", "lastname","datedenaissance","date_inscription"];
        $table = "enfant";
        $where = "  WHERE id_enfant NOT IN (SELECT id_enfant FROM  presence WHERE date =  '$date' )";
        $enfant = $this->presence->_simpleSql($champs,$table,$where)->fetchAll();
        return $enfant;
    }

    function  listpresence(){
        $date = date('Y-m-d');
        $champs = ["firstname", "lastname","datedenaissance","date_inscription","id_presence","heur_arriver","heur_depart"];
        $table = "presence p, enfant e ";
        $where = " WHERE  p.id_enfant = e.id_enfant and date = '$date'";
        $enfant = $this->presence->_simpleSql($champs,$table,$where)->fetchAll();
        return $enfant;
    }




    function delete(){
        $id  = $_REQUEST['id'];
        $data  = [];

        $table =  "presence";
        $where = "WHERE id_presence = $id";

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


        header("Location: ?ControlPresnce");


    }


}