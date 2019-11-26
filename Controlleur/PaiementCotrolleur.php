<?php
/**
 * Created by PhpStorm.
 * User: geonidas
 * Date: 15/06/2019
 * Time: 10:09
 */

namespace Creche\Controlleur;


use Creche\Model\Paiement;
use Creche\Model\Utils;

class PaiementCotrolleur
{

    var $vue = __DIR__ . "/../Vue/theme/";
    private $paiement;

    /**
     * HotelControlleur constructor.
     */
    public function __construct()
    {
        $this->paiement = new Paiement();

    }

    function getSommeAPayer(){
        return $this->paiement->SOMME_A_APYER;
    }

    public function addNewPaiementaction(){
        $data = $_REQUEST['data'];
       $firstload = ((isset($_SESSION['firstload']) && $_SESSION['firstload'] == true) )?true:false;
        if (($data != null) && ($firstload == true)){

            $montant_regler = $data['montant_regler'];
            $id_enfant = $data['id_enfant'];
            $reste_a_payer = $this->paiement->SOMME_A_APYER - $montant_regler;
            $numero_paiement = md5(date("Y-m-d H:m:s").$this->paiement->SOMME_A_APYER.$reste_a_payer);
            if ($reste_a_payer < 0){
                //message montant saisie supérieur au montant à payer

                $_SESSION['message']['text'] = "Montant saisie supérieur au montant à payer,Réssayer!!";
                $_SESSION['message']['type'] = "danger";
                $_SESSION['message']['title'] = "Error";
                unset($_SESSION['firstload']);
                header("Location: ?PaiementAdd");
                exit;
            }

            $data = [
                "montant_regler"=>$montant_regler,
                "date_paiement"=>date("Y-m-d"),
                "somme_a_payer"=>$this->paiement->SOMME_A_APYER ,
                "reste_a_payer"=>$reste_a_payer,
                "id_enfant"=>$id_enfant,
                "numero_paiement"=>$numero_paiement,

            ];
            $table = "paiement";
            $where =  "";
            $reponse = $this->paiement->_genereSql($data,$table,$where,'insert');

            //recuperer le id de ce paiement
            $data = [
                "date_debut"=>date('Y-m-d',mktime(0, 0, 0, date("m")-1,   date("d"),   date("Y"))),
                "date_fin"=> date('Y-m-d'),
                "regler"=>false ,
                "numero_paiement"=>$numero_paiement,

            ];
            $table = "historique";
            $where =  "";
            $historique_reponse = $this->paiement->_genereSql($data,$table,$where,'insert');



            if ($reponse == true){

                $_SESSION['message']['text'] = "Paiement effectuer avec succès";
                $_SESSION['message']['type'] = "success";
                $_SESSION['message']['title'] = "Success";


                $champs = ["id_enfant","firstname", "lastname","datedenaissance","date_inscription"];
                $table = "enfant";
                $where = " WHERE id_enfant = $id_enfant";
                $enfant = $this->paiement->_champsMultiples($champs,$table,$where);
                //generer la facture
                $vars['data'] = [
                    "date_debut"=>date('Y-m-d',mktime(0, 0, 0, date("m")-1,   date("d"),   date("Y"))),
                    "date_fin"=> date('Y-m-d'),
                    "regler"=>false ,
                    "montant_regler"=>$montant_regler,
                    "date_paiement"=>date("Y-m-d H:m:s"),
                    "somme_a_payer"=>$this->paiement->SOMME_A_APYER ,
                    "reste_a_payer"=>$reste_a_payer,
                    "enfant"=>$enfant,
                    "numero_paiement"=>$numero_paiement,

                ];

                //vd($_REQUEST['data']);exit;
                unset($_SESSION['firstload']);
                echo Utils::render($this->vue . "facture_paiement.php", $vars);
                exit;



            }else{
                $_SESSION['message']['text'] = "Le système à rencontrer un erreur veillez réssayer";
                $_SESSION['message']['type'] = "error";
                $_SESSION['message']['title'] = "Error";
                header("Location: ?PaiementAdd");
                exit;

            }


        }else{
            unset($_SESSION['firstload']);
            header("Location: ?PaiementAdd");
            exit;
        }
    }



    function  indexAction(){
        $champs = ["id_paiement","date_paiement", "somme_a_payer","montant_regler","reste_a_payer","numero_paiement","p.id_enfant","firstname", "lastname","datedenaissance","date_inscription"];
        $table = "paiement p ";
        $where = " LEFT JOIN  enfant e ON p.id_enfant = e.id_enfant";
        $enfant = $this->paiement->_champsMultiples($champs,$table,$where);
        return $enfant;
    }

    function  nbrpaiementencours(){
        $champs = ["id_historique"];
        $table = "historique";
        $where = " WHERE regler = false ";
        $enfant = $this->paiement->_champsMultiples($champs,$table,$where);
        return $enfant;
    }

    function  ListePaiementEncours(){
        $champs = ["id_historique","date_debut", "date_fin","regler","numero_paiement"];
        $table = "historique";
        $where = " WHERE regler = false ";
        $enfant = $this->paiement->_champsMultiples($champs,$table,$where);
        return $enfant;
    }

    function  listEnfant(){
        $previours_month = date('Y-m-d',mktime(0, 0, 0, date("m")-1,   date("d"),   date("Y")));
        $that_day = date('Y-m-d');
        $champs = ["e.id_enfant as id_enfant","firstname", "lastname","datedenaissance","date_inscription"];
        $table = "  enfant e  ";
        $where = "  WHERE id_enfant NOT IN (SELECT p.id_enfant FROM paiement p WHERE  date_paiement > DATE ('$previours_month') )    ";
        $enfant = $this->paiement->_simpleSql($champs,$table,$where)->fetchAll();
        return $enfant;
    }

    function  historiquePaiement(){
        $champs = ["id_historique","date_debut", "date_fin","regler","numero_paiement"];
        $table = "historique";
        $where = "";
        $enfant = $this->paiement->_champsMultiples($champs,$table,$where);
        return $enfant;
    }

    function  DétailhistoriquePaiement(){
        $numero_paiement  = $_REQUEST['numero_paiement'];

        $champs = ["id_historique","date_debut", "date_fin","regler","numero_paiement"];
        $table = "historique";

        $where = " WHERE numero_paiement = '$numero_paiement'";
        $historique = $this->paiement->_champsMultiples($champs,$table,$where);

        $champs = ["id_paiement","date_paiement", "somme_a_payer","montant_regler","reste_a_payer","numero_paiement","id_enfant"];
        $table = "paiement";
        $where = " WHERE  numero_paiement = '$numero_paiement' ";
        $paiement = $this->paiement->_champsMultiples($champs,$table,$where);
        $sommetotalregler = 0;
        foreach ($paiement as $key=>$value){
            $sommetotalregler += $paiement[$key]['montant_regler'];
        }

        $vars['list_paiement_detail'] = $paiement[count($paiement)-1];
        $vars['list_historique_detail'] = $historique[0];
        $vars['montant_regler'] = $sommetotalregler;

        echo Utils::render($this->vue . "HistoriquePaiementConsulter.php", $vars);

    }




    function delete(){
        $id  = $_REQUEST['id'];
        $data  = [];

        $table =  "parent_enfant";
        $where = "WHERE id_enfant = $id";

        $this->paiement->_genereSql($data,$table,$where,'delete');

        $table =  "enfant";
        $where = "WHERE id_enfant = $id";

        $reponse = $this->paiement->_genereSql($data,$table,$where,'delete');

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

    function addOledaction(){
        $data = $_REQUEST['data'];

        if (($data != null)){

            $montant_regler = $data['montant_regler'];
            $id_enfant = $data['id_enfant'];
            $reste_a_payer = $data['reste_a_payer'];
            $numero_paiement = $data['numero_paiement'];
            $id_paiement = $data['id_paiement'];
            $reste_a_payer = $reste_a_payer - $montant_regler;

            if ($reste_a_payer < 0){
                //message montant saisie supérieur au montant à payer

                $_SESSION['message']['text'] = "Montant saisie supérieur au montant à payer,Réssayer!!";
                $_SESSION['message']['type'] = "danger";
                $_SESSION['message']['title'] = "Error";
                header("Location: ?cl=PaiementCotrolleur&mt=DétailhistoriquePaiement&numero_paiement=$numero_paiement&id_paiement=$id_paiement&id_enfant=$id_enfant");

                exit;
            }

            $data = [
                "montant_regler"=>$montant_regler,
                "date_paiement"=>date("Y-m-d H:m:s"),
                "somme_a_payer"=>$this->paiement->SOMME_A_APYER ,
                "reste_a_payer"=>$reste_a_payer,
                "id_enfant"=>$id_enfant,
                "numero_paiement"=>$numero_paiement,

            ];
            $table = "paiement";
            $where =  "";
            $reponse = $this->paiement->_genereSql($data,$table,$where,'insert');


            if ($reste_a_payer == 0){
                $data = [
                    "regler"=>true ,

                ];
                $table = "historique";
                $where =  " WHERE numero_paiement = $numero_paiement";
               $res= $this->paiement->_genereSql($data,$table,$where,'update');

            }





            if ($reponse == true){

                $_SESSION['message']['text'] = "Paiement effectuer avec succès";
                $_SESSION['message']['type'] = "success";
                $_SESSION['message']['title'] = "Success";

            }else{
                $_SESSION['message']['text'] = "Le système à rencontrer un erreur veillez réssayer";
                $_SESSION['message']['type'] = "error";
                $_SESSION['message']['title'] = "Error";
                header("Location: ?PaiementAdd");
                exit;

            }
            header("Location: ?cl=PaiementCotrolleur&mt=DétailhistoriquePaiement&numero_paiement=$numero_paiement&id_paiement=$id_paiement&id_enfant=$id_enfant");


        }
    }



}