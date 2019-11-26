<?php
/**
 * Created by PhpStorm.
 * User: geonidas
 * Date: 16/06/2019
 * Time: 08:52
 */

namespace Creche\Controlleur;


use Creche\Model\Tuteurenfant;

class TuteurenfantControlleur
{
    var $vue = __DIR__ . "/../Vue/";
    private $tuteurenfant;

    /**
     * HotelControlleur constructor.
     */
    public function __construct()
    {
        $this->tuteurenfant = new Tuteurenfant();
    }

    public function addaction(){
        $data = $_REQUEST['data'];
        if ($data != null){
            $id_parent = $data['id_parent'];
            $id_enfant = $data['id_enfant'];
            $data = [
                "id_parent"=>$id_parent,
                "id_enfant"=>$id_enfant,
            ];
            $table = "parent_enfant";
            $where =  "";
            $reponse = $this->tuteurenfant->_genereSql($data,$table,$where,'insert');
            if ($reponse == true){
                $_SESSION['message']['text'] = "Ajout de parent effectuer avec succès";
                $_SESSION['message']['type'] = "success";
                $_SESSION['message']['title'] = "Success";
            }else{
                $_SESSION['message']['text'] = "Le système à rencontrer un erreur veillez réssayer";
                $_SESSION['message']['type'] = "error";
                $_SESSION['message']['title'] = "Error";
            }
            header("Location: ?TuteurenfantConsulter&id=$id_enfant");
        }
    }

    function  indexAction($byparent = false){
        $id  = $_REQUEST['id'];


        if ($byparent == true){
            $champs = ["id_parent_enfant ", "p.firstname as parent_firstname", "p.lastname as parent_lastname", "p.email as parent_email", "e.firstname as enfant_firstname","e.lastname as enfant_lastname", "date_inscription", "datedenaissance"];
            $table = " parent_enfant pe";
            $where = "JOIN parent p ON pe.id_parent = p.id_parent  JOIN enfant e ON pe.id_enfant =  e.id_enfant and pe.id_parent = $id";

            $tuteurenfant = $this->tuteurenfant->_simpleSql($champs,$table,$where)->fetchAll();
            return $tuteurenfant;
        }


        $champs = ["id_parent_enfant ", "p.firstname as parent_firstname", "p.lastname as parent_lastname", "p.email as parent_email", "e.firstname as enfant_firstname","e.lastname as enfant_lastname", "date_inscription", "datedenaissance"];
        $table = " parent_enfant pe";
        $where = "JOIN parent p ON pe.id_parent = p.id_parent  JOIN enfant e ON pe.id_enfant =  e.id_enfant and pe.id_enfant = $id";
        $tuteurenfant = $this->tuteurenfant->_simpleSql($champs,$table,$where)->fetchAll();
        if (count($tuteurenfant) == 0){
            $_SESSION['message']['text'] = "Cet enfant n\'a pas encore de parent!!";
            $_SESSION['message']['type'] = "waring";
            $_SESSION['message']['title'] = "Success";
            header("Location: ?ParentenfantFormAdd");
            exit;
        }
        return $tuteurenfant;
    }

    function  formaddParentDisponibleList(){
        $id  = $_REQUEST['id'];
        $champs = ["p.firstname as parent_firstname","p.lastname as parent_lastname","p.id_parent as id_parent"];
        $table = "parent p";
        $where = " WHERE id_parent not in (SELECT id_parent FROM parent_enfant WHERE  id_enfant = $id )";
        $parent_enfant = $this->tuteurenfant->_simpleSql($champs,$table,$where)->fetchAll();

        $data['success']=true;
        $data['message']="Chargement de la liste des parents avec succès";
        $data['list_parent']=$parent_enfant;
        if (count($parent_enfant) == 0){
            $data['message']="Le système à rencontrer un erreur veillez réssayer, Aucun parent disponible pour cet enfant !!!";
            $data['success']=false;
        }
        //header('Content-type:application/json;charset=utf-8');
        echo json_encode($data);
    }




    function delete(){
        $id  = $_REQUEST['id'];
        $data  = [];
        $table =  "parent_enfant";
        $where = "WHERE id_parent_enfant = $id";

        $reponse = $this->tuteurenfant->_genereSql($data,$table,$where,'delete');

        if ($reponse == true){
            $_SESSION['message']['text'] = "supression de relation entre parent et enfant effectuer avec succès";
            $_SESSION['message']['type'] = "success";
            $_SESSION['message']['title'] = "Success";
        }else{
            $_SESSION['message']['text'] = "Le système à rencontrer un erreur veillez réssayer";
            $_SESSION['message']['type'] = "error";
            $_SESSION['message']['title'] = "Error";
        }


        header("Location: ?ParentenfantFormAdd");


    }



}