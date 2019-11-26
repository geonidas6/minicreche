<?php
namespace Creche\Model;
/**
 * Created by PhpStorm.
 * User: geonidas
 * Date: 11/06/2019
 * Time: 14:58
 */




class Utils
{
    /**
     * Transforme en chaine de caracteres
     * les elements d'un taleau ; on peut utiliser un
     * separateurpour concatener les valeurs
     */
    public static function _tableauToChaine($tableau_, $separateur = ' ', $encadreur = null)
    {
        $tailletab = sizeof($tableau_);
        $tableau = array($tableau_);
        $tableau = $tableau[0];
        if ($tailletab > 0) {
            $chaine = ($encadreur == null) ? $tableau[0] : "$encadreur" . $tableau[0] . "$encadreur";
            for ($k = 1; $k < ($tailletab); $k++) {
                if ($encadreur == null) {
                    $chaine .= $separateur . $tableau[$k];
                } else {
                    $chaine .= $separateur . $encadreur . $tableau[$k] . $encadreur;
                }
            }

            return $chaine;
        } else {
            return false;
        }

    }

    /**
     * Met a jour le fichier log en parametre
     * @param $message
     * @param string $file
     */
    public static function logFile($message, $file ='log.txt')
    {
            $fp = fopen($file, "a+");

        $message = date('m/d/Y H:i:s') . " : " . $message;
        fwrite($fp, $message);
        fwrite($fp, "\n");
        fclose($fp);
        //var_dump($fp);exit;
    }


    /**
     * Cette fonction transmet les valeurs nécessaire à l'affichage d'une vue
     * @param $templateFile
     * @param null $_params_
     * @return string
     */
    public static function render($templateFile, $_params_ = null)
    {
        if (!is_file($templateFile))
            throw new \Exception("The template file '$templateFile' does not exist.");

        if (is_array($_params_))
            extract($_params_, EXTR_PREFIX_SAME, 'params');
        else
            $params = $_params_;
        ob_start();
        ob_implicit_flush(false);
        require_once($templateFile);
        //Helper::logFile("Render $templateFile-");
        return ob_get_clean();
    }

}