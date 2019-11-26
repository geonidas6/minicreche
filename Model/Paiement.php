<?php
namespace Creche\Model;
/**
 * Created by PhpStorm.
 * User: geonidas
 * Date: 15/06/2019
 * Time: 10:02
 */




class Paiement extends Db
{
     public  $SOMME_A_APYER = 2000;

    /**
     * @return int
     */
    public function getSOMMEAAPYER()
    {
        return $this->SOMME_A_APYER;
    }

}