<?php
namespace Creche\Model;
/**
 * Created by PhpStorm.
 * User: geonidas
 * Date: 11/06/2019
 * Time: 14:08
 */



class Db
{
    private static $_instance;
    var $_connection;
    var $total_defaut;
    var $chp_gpe = '';
    private $DB_host = "localhost";
    private $DB_user_name = "root";
    private $DB_user_password = "";
    private $DB_driver = "mysql";
    private $DB_database = "creche";
    public static function init()
    {
        try {
            if (is_null(self::$_instance) || empty(self::$_instance)) {
                self::$_instance = new self();
                return self::$_instance;
            }else{
                return self::$_instance;
            }
        } catch (Exception $e) {
            return self::class;
        }
    }

    function __construct()
    {
        try {
            if (is_null($this->_connection) || empty($this->_connection)) {
                $this->_connection = new \PDO($this->DB_driver.':host='.$this->DB_host.';dbname='.$this->DB_database, $this->DB_user_name, $this->DB_user_password,array(
                    \PDO::ATTR_PERSISTENT => true));
            }
        } catch (Exception $e) {
            $this->_connection = $e;
        }
    }

    public function connect()
    {
        return $this->_connection ? $this->_connection : null;
    }


    /**
     * Pour retrouver la valeur d'un champ unique
     * @param $libelle
     * @param $table
     * @param $where
     * @return mixed
     */
    public function _champUnique($libelle, $table, $where)
    {
        $sql = "SELECT DISTINCT $libelle FROM $table $where";
        $res = $this->_connection->query($sql) or die('Champ Unique-' . $sql . print_r($this->bd_conn->errorInfo()[2], true));
        while ($liste = $res->fetch()) {
            return $liste[$libelle];
        }
    }


    /**
     *  Genere une requete sql du type
     *  insert - update - delete
     * @param $data
     * @param $table
     * @param string $where
     * @param string $type
     * @return bool
     */
    function _genereSql($data, $table, $where = '', $type = 'insert')
    {
        if ($type == 'insert') {
            foreach ($data as $champ => $valeur) {
                $tab_chps[] = $champ;
                $tab_val[] = $valeur;
            }
            $chaine_chps = Utils::_tableauToChaine($tab_chps, ', ');
            $chaine_vals = Utils::_tableauToChaine($tab_val, ', ', '"');
            $sql = "INSERT INTO $table ($chaine_chps) VALUES ($chaine_vals)";
            $res = $this->_connection->query($sql);

            //var_dump($sql,$res,$this->_connection);exit;
            if ($res == false) {
                Utils::logFile("DB _generesql - ajout -$sql :".$this->_connection->errorInfo()[2]);
                return false;
            }
            return true;
        }
        if ($type == 'update') {
            $taille = count($data); // pr placer la virgule de separation quand necessaire
            $i = 0;
            $sql_ = '';
            foreach ($data as $champ => $valeur) {
                $sql_ .= " $champ= \"$valeur\" ";
                if ($i < $taille - 1) {
                    $sql_ .= ", ";
                }
                $i++;
            }

            $sql = " UPDATE $table SET $sql_ $where ";
            $res = $this->_connection->query($sql);
            if ($res == false) {
                Utils::logFile("DB _generesql - update - $sql :".$this->_connection->errorInfo()[2]);
                return false;
            }
            return true;
        }
        if ($type == 'delete') {
            $sql = " DELETE FROM $table $where ";

           // var_dump($sql);exit;
            $res = $this->_connection->query($sql);
            if ($res == false) {
                Utils::logFile("DB _generesql - delete -$sql :".$this->_connection->errorInfo()[2]);
                return false;
            }
            return true;
        }
    }



    /**
     * Cette fonction genere une liste
     *
     * @param $tchps_voulus
     * @param $table
     * @param string $where
     * @param string $chp_ord
     * @param string $ordre
     * @param int $deb
     * @param string $groupby
     * @param string $total
     * @param string $nbre_limit
     * @param string $Tretour
     * @return array|mixed
     * TODO Mieux gerer le cas d'un seule valeur trouvee
     */
    public function _champsMultiples($tchps_voulus, $table, $where = '', $chp_ord = '', $ordre = 'ASC',
                                     $deb = 0, $groupby = '', $total = 'N', $nbre_limit = 'defaut', $Tretour = 'array')
    {
        //$nbre = ($nbre_limit == 'defaut') ? $this->total_defaut : $total; //TODO: pourquoi $total=N pour cette partie
        if ($this->total_defaut == 0) {//on veut toutes les valeurs
            $nbre = false;
        } else {
            $nbre = ($nbre_limit == 'defaut') ? $this->total_defaut : 1000;
        }
        /**
         * TODO: definir un champ temoin id_table par defaut ou $tchps_voulus[0]
         * pour savoir s'il y a un resultat ou pas et savoir quel array retourner
         */
        if ($tchps_voulus == '*') {
            $sql = "SELECT * FROM $table ";
            $Tretour = 'assoc';
        } elseif (is_array($tchps_voulus)) {
            $leschps = Utils::_tableauToChaine($tchps_voulus, ', ');
            $sql = "SELECT DISTINCT $leschps FROM $table ";
        }
        if ($where) {
            $sql .= $where;
        }
        if ($groupby == '') {
            if ($this->chp_gpe != '') {
                $groupby = $this->chp_gpe;
            }
        }
        $sql .= ($groupby != '') ? " GROUP BY $groupby" : "";
        $sql .= ($chp_ord != '') ? " ORDER BY $chp_ord $ordre" : "";
        $sql .= ($nbre > 0) ? " LIMIT $deb , $nbre " : "";
        //echo "<br/> $table --".$sql;
        //exit;
        //if ($this->tab_param['DEBUG_MODE'] == 1) echo $sql;
        $res = $this->_connection->query($sql) or die('Champs multiples-' . $sql . print_r($this->_connection->errorInfo(), true));
        //TODO: replace tout le code du bas par fetchAll() et tester voir si le code existant est  fonctionnel
        if (($Tretour == 'array')) {
            $tab_valeurs = array();
            $k = 0;
            foreach ($res as $liste) {
                for ($i = 0; $i < (count($tchps_voulus)); $i++) {//extraction des chps voulus
                    if ($total == 'N') {
                        $tab_champ_courant = explode('.', $tchps_voulus[$i]);
                        $champ_courant = (count($tab_champ_courant) > 1) ? $tab_champ_courant [1] : $tab_champ_courant [0];
                        $tab_valeurs[$k][$champ_courant] = $liste[$champ_courant];
                    } else {
                        $champ_courant = $tchps_voulus[$i];
                        if (isset($liste[$champ_courant])) {
                            $tab_valeurs[$k][$champ_courant] = $liste[$champ_courant];
                        } else {
                            $tab_valeurs[$k]['total'] = $liste['total'];
                        }
                    }
                }
                $k++;
            }
        } else {
            $tab_valeurs = $this->_retourneAssoc($res);
        }

        return $tab_valeurs;
    }


    public function _simpleSql($tchps_voulus, $table, $where = '', $chp_ord = '', $ordre = 'ASC',
                                     $deb = 0, $groupby = '', $total = 'N', $nbre_limit = 'defaut', $Tretour = 'array')
    {
        //$nbre = ($nbre_limit == 'defaut') ? $this->total_defaut : $total; //TODO: pourquoi $total=N pour cette partie
        if ($this->total_defaut == 0) {//on veut toutes les valeurs
            $nbre = false;
        } else {
            $nbre = ($nbre_limit == 'defaut') ? $this->total_defaut : 1000;
        }
        /**
         * TODO: definir un champ temoin id_table par defaut ou $tchps_voulus[0]
         * pour savoir s'il y a un resultat ou pas et savoir quel array retourner
         */
        if ($tchps_voulus == '*') {
            $sql = "SELECT * FROM $table ";
            $Tretour = 'assoc';
        } elseif (is_array($tchps_voulus)) {
            $leschps = Utils::_tableauToChaine($tchps_voulus, ', ');
            $sql = "SELECT DISTINCT $leschps FROM $table ";
        }
        if ($where) {
            $sql .= $where;
        }
        if ($groupby == '') {
            if ($this->chp_gpe != '') {
                $groupby = $this->chp_gpe;
            }
        }
        $sql .= ($groupby != '') ? " GROUP BY $groupby" : "";
        $sql .= ($chp_ord != '') ? " ORDER BY $chp_ord $ordre" : "";
        $sql .= ($nbre > 0) ? " LIMIT $deb , $nbre " : "";
        //echo "<br/> $table --".$sql;
        //exit;
        //if ($this->tab_param['DEBUG_MODE'] == 1) echo $sql;
        $res = $this->_connection->query($sql) or die('Champs multiples-' . $sql . print_r($this->_connection->errorInfo(), true));


        return $res;
    }

    /**
     * @param $table
     * @param $champ
     */
    function _genereForm($table,$champ,$lien){
        $form = "
        <h1 align='center' style='text-decoration: underline ;'>Formulaire de modification de $table</h1>
                <form method='post' action='$lien' class='form'>";
        foreach ($champ as $key=>$value){
           // vd($champ[$key],$key);
            //$lien = $champ[$key]['lien'];


                $form .= "
              <div class='form-group' style='width: 100%;padding-right: 25%;padding-left: 35%;' >
                <label for='Nom'>".$champ[$key][0]."</label>
                <input type='".$champ[$key][2]."' class='form-control'  name='data[$key]' id='".$champ[$key][0]."' value='".$champ[$key][1]."' style='width: 63%;' required >
                <small id='".$champ[$key][0]."' class='form-text text-muted'>Entrer le ".$champ[$key][0]."</small>
              </div>
            " ;





        }

        $form .="
            <input id='Modifier' type='submit' value='Modifier' class='btn btn-primary' style='    padding-right: 0%;padding-left: 0%;margin-left: 41%;width: 71px;' >
        ";

        $form .=" </form>
            " ;
       // echo $form;
        //exit;
        return $form;
    }


}