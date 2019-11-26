<?php
/**
 * Created by PhpStorm.
 * User: geonidas
 * Date: 15/06/2019
 * Time: 10:09
 */

namespace Creche\Controlleur;


use Creche\Model\Tuteur;
use Creche\Model\Utils;

class TuteurControlleur
{

    var $vue = __DIR__ . "/../Vue/theme/";
    private $tuteur;

    /**
     * HotelControlleur constructor.
     */
    public function __construct()
    {
        $this->tuteur = new Tuteur();
    }

    public function addaction(){
        $data = $_REQUEST['data'];
        if ($data != null){
            $firstname = $data['firstname'];
            $lastname = $data['lastname'];
            $tel_parent = $data['tel_parent'];
            $email = $data['email'];
            $data = [
                "firstname"=>$firstname,
                "lastname"=>$lastname,
                "tel_parent"=>$tel_parent,
                "email"=>$email,
            ];
            $table = "parent";
            $where =  "";
            $reponse = $this->tuteur->_genereSql($data,$table,$where,'insert');
            if ($reponse == true){
                $_SESSION['message']['text'] = "Ajout de parent effectuer avec succès";
                $_SESSION['message']['type'] = "success";
                $_SESSION['message']['title'] = "Success";
            }else{
                $_SESSION['message']['text'] = "Le système à rencontrer un erreur veillez réssayer";
                $_SESSION['message']['type'] = "error";
                $_SESSION['message']['title'] = "Error";
            }
            header("Location: ?TuteurConsulter");
        }
    }

    function  indexAction(){
        $champs = ["id_parent","firstname", "lastname","tel_parent","email"];
        $table = "parent";
        $where = "";
        $tuteur = $this->tuteur->_champsMultiples($champs,$table,$where);
        //vd($tuteur);exit;
        return $tuteur;
    }




    function delete(){
        $id  = $_REQUEST['id'];
        $data  = [];

        $table =  "parent_enfant";
        $where = "WHERE id_parent = $id";

         $this->tuteur->_genereSql($data,$table,$where,'delete');



        $table =  "parent";
        $where = "WHERE id_parent = $id";

        $reponse = $this->tuteur->_genereSql($data,$table,$where,'delete');

        if ($reponse == true){
            $_SESSION['message']['text'] = "supression de parent effectuer avec succès";
            $_SESSION['message']['type'] = "success";
            $_SESSION['message']['title'] = "Success";
        }else{
            $_SESSION['message']['text'] = "Le système à rencontrer un erreur veillez réssayer";
            $_SESSION['message']['type'] = "error";
            $_SESSION['message']['title'] = "Error";
        }


        header("Location: ?TuteurConsulter");


    }

    function updateAction(){
        $id = $_REQUEST['id'];
        $data = $_REQUEST['data'];
        if ($data != null){
            $firstname = $data['firstname'];
            $lastname = $data['lastname'];
            $tel_parent = $data['tel_parent'];
            $email = $data['email'];
            $data = [
                "firstname"=>$firstname,
                "lastname"=>$lastname,
                "tel_parent"=>$tel_parent,
                "email"=>$email,
            ];
            $table = "parent";
            $where =  " WHERE id_parent = '$id'";
            $reponse = $this->tuteur->_genereSql($data,$table,$where,'update');
            if ($reponse == true){
                $_SESSION['message']['text'] = " Modification effectuer avec succès";
                $_SESSION['message']['type'] = "success";
                $_SESSION['message']['title'] = "Success";
            }else{
                $_SESSION['message']['text'] = "Le système à rencontrer un erreur veillez réssayer";
                $_SESSION['message']['type'] = "error";
                $_SESSION['message']['title'] = "Error";
            }
            header("Location: ?TuteurConsulter");
        }

    }

    function modifierForm(){
        $id = $_REQUEST['id'];
        $champs = ["id_parent","firstname", "lastname","tel_parent","email"];
        $table = "parent";
        $where = " WHERE id_parent = '$id'";

        $hotel = $this->tuteur->_champsMultiples($champs,$table,$where);
        $lien ="?cl=TuteurControlleur&mt=updateAction&id=$id";
        $champs_form = [
            "firstname"=>["NOM",$hotel[0]['firstname'],"text"],
            "lastname"=>["PRENOM",$hotel[0]['lastname'],"text"],
            "tel_parent"=>["TEL",$hotel[0]['tel_parent'],"tel"],
            "email"=>["EMAIL",$hotel[0]['email'],"email"],
        ];


        $form = $this->tuteur->_genereForm($table,$champs_form,$lien);

        $vars['form']  = $form;
        //var_dump($form);exit;
        echo Utils::render($this->vue . "updateform.php", $vars);

    }

}