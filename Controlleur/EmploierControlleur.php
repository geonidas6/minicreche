<?php
/**
 * Created by PhpStorm.
 * User: geonidas
 * Date: 15/06/2019
 * Time: 10:09
 */

namespace Creche\Controlleur;


use Creche\Model\Emploier;
use Creche\Model\Utils;

class EmploierControlleur
{

    var $vue = __DIR__ . "/../Vue/theme/";
    private $emploier;

    /**
     * HotelControlleur constructor.
     */
    public function __construct()
    {
        $this->emploier = new Emploier();
    }

    public function addaction(){
        $data = $_REQUEST['data'];
        if ($data != null){
            $firstname = $data['firstname'];
            $lastname = $data['lastname'];
            $email = $data['email'];
            $pwd = $data['pwd'];
            $pwd_cnf = $data['pwd_cnf'];

            if ($pwd != $pwd_cnf){
                $_SESSION['message']['text'] = "Mot de passe saisis ne conrespond pas réssayer!";
                $_SESSION['message']['type'] = "error";
                $_SESSION['message']['title'] = "Error";
                if (isset($_REQUEST['data']['admincreateemploier'])){
                    header("Location: ?EmploierFormAdd");
                    exit;
                }
                header("Location: ?register");
                exit;
            }



            $data = [
                "firstname"=>$firstname,
                "lastname"=>$lastname,
                "email"=>$email,
                "pwd"=>md5($pwd),
            ];
            $table = "emploier";
            $where =  "";
            $reponse = $this->emploier->_genereSql($data,$table,$where,'insert');
            if ($reponse == true){
                $_SESSION['message']['text'] = "Creation de compte effectuer avec succès";
                $_SESSION['message']['type'] = "success";
                $_SESSION['message']['title'] = "Success";
            }else{
                $_SESSION['message']['text'] = "Cet adresse email exite déja";
                $_SESSION['message']['type'] = "error";
                $_SESSION['message']['title'] = "Error";
            }
            if (isset($_REQUEST['data']['admincreateemploier'])){
                header("Location: ?EmploierConsulter");
                exit;
            }
            header("Location: ?login");
        }
    }

    function  indexAction(){
        $champs = ["firstname", "lastname", "email", "pwd","id_emploier"];
        $table = "emploier";
        $where = "";
        $emploier = $this->emploier->_champsMultiples($champs,$table,$where);
        return $emploier;
    }

    public function connexionAction(){
        $data = $_REQUEST['data'];
        if ($data != null) {
            $password = md5($data['pwd']);
            $email = $data['email'];
            $champs = ["firstname", "lastname", "email", "pwd", "id_emploier"];
            $table = "emploier";


            $where = "WHERE email = '$email' and pwd = '$password'";
            $resultat = $this->emploier->_champsMultiples($champs, $table, $where);


            if (count($resultat) > 0) {
                $_SESSION['message']['text'] = "Connexion effectuer avec succès";
                $_SESSION['message']['type'] = "success";
                $_SESSION['message']['title'] = "Success";

                $_SESSION['user_creche']['id_emploier'] = $resultat[0]['id_emploier'];
                $_SESSION['user_creche']['firstname'] = $resultat[0]['firstname'];
                $_SESSION['user_creche']['lastname'] = $resultat[0]['lastname'];
                $_SESSION['user_creche']['email'] = $resultat[0]['email'];

                header("Location: ?Acceuil");
                exit;
            } else {
                $_SESSION['message']['text'] = "Le système à rencontrer un erreur veillez réssayer,Email ou mot de passe incorect";
                $_SESSION['message']['type'] = "error";
                $_SESSION['message']['title'] = "Error";
            }
            header("Location: ?login");
        }
    }


    function  deconnexionAction(){
        $_SESSION['message']['text'] = "Déconnexion effectuer avec succès";
        $_SESSION['message']['type'] = "success";
        $_SESSION['message']['title'] = "Success";
        unset($_SESSION['user_creche']);
        header("Location: ?login");
    }

    function delete(){
        $id  = $_REQUEST['id'];
        $data  = [];
        $table =  "emploier";
        $where = "WHERE id_emploier = $id";

        $reponse = $this->emploier->_genereSql($data,$table,$where,'delete');

        if ($reponse == true){
            $_SESSION['message']['text'] = "supression effectuer avec succès";
            $_SESSION['message']['type'] = "success";
            $_SESSION['message']['title'] = "Success";
        }else{
            $_SESSION['message']['text'] = "Le système à rencontrer un erreur veillez réssayer";
            $_SESSION['message']['type'] = "error";
            $_SESSION['message']['title'] = "Error";
        }


        header("Location: ?EmploierConsulter");


    }

    function updateAction(){
        $data = $_REQUEST['data'];
        $id = $_REQUEST['id'];
        if ($data != null){
            $firstname = $data['firstname'];
            $lastname = $data['lastname'];
            $email = $data['email'];
            $pwd = $data['pwd'];
            $pwd_cnf = $data['pwd_cnf'];

            if ($pwd != $pwd_cnf){
                $_SESSION['message']['text'] = "Mot de passe saisis ne conrespond pas réssayer!";
                $_SESSION['message']['type'] = "error";
                $_SESSION['message']['title'] = "Error";

                header("Location: ?cl=EmploierControlleur&mt=modifierForm&id=$id");
                exit;
            }
            $data = [
                "firstname"=>$firstname,
                "lastname"=>$lastname,
                "email"=>$email,
                "pwd"=>md5($pwd),
            ];
            $table = "emploier";
            $where =  " WHERE id_emploier = '$id'";
            $reponse = $this->emploier->_genereSql($data,$table,$where,'update');
            if ($reponse == true){
                $_SESSION['message']['text'] = " Modification effectuer avec succès";
                $_SESSION['message']['type'] = "success";
                $_SESSION['message']['title'] = "Success";
            }else{
                $_SESSION['message']['text'] = "Le système à rencontrer un erreur veillez réssayer";
                $_SESSION['message']['type'] = "error";
                $_SESSION['message']['title'] = "Error";
            }
            header("Location: ?EmploierConsulter");
        }

    }

    function modifierForm(){
        $id = $_REQUEST['id'];
        $champs = ["firstname", "lastname", "email", "pwd","id_emploier"];
        $table = "emploier";
        $where = " WHERE id_emploier = '$id'";

        $emploier = $this->emploier->_champsMultiples($champs,$table,$where);
        $lien ="?cl=EmploierControlleur&mt=updateAction&id=$id";
        $champs_form = [
            "firstname"=>["NOM",$emploier[0]['firstname'],"text"],
            "lastname"=>["PRENOM",$emploier[0]['lastname'],"text"],
            "email"=>["EMAIL",$emploier[0]['email'],"text"],
            "pwd"=>["PASSWORD","","password"],
            "pwd_cnf"=>["PASSWORD","","password"],
        ];


        $form = $this->emploier->_genereForm($table,$champs_form,$lien);

        $vars['form']  = $form;

        //var_dump($form);exit;
        echo Utils::render($this->vue . "updateform.php", $vars);

    }

}