<?php


namespace Soldy\PanteraPhp;

use Soldy\PantheraPhp\SqlAbstract;
use Soldy\PantheraPhp\SqlSecurity;


class Sql extends SqlAbstract 
{
    use SqlSecurity;
    /* this funcion call the functions on the sql
     *  
     * @param {string}
     * @param {array} variables
     * @public
     * @return {mixed} always come back with the first line. 
     * 
     *
     */
    public function queryProcedure(string $procedure, array $var_array ) 
    {
        // I use . because it's faster
        $sql = '`'. $procedure. '`('; 
        $sql.= $this->securities($var_array); 
        $sql.=')';
        // And its not a prepare syntax jet... because that not a live code
        // That should brake the solid o.
        return $this->query(
           'CALL '. $sql 
        );
    }
    /* this funcion call the functions on the sql
     *  
     * @param {string}
     * @param {array} variables
     * @public
     * @return {mixed} always come back with the first line. 
     * 
     *
     */
    public function queryFunction(string $func, array $var_array ) 
    {
        // I use . because it's faster
        $sql = '`'. $func. '`('; 
        $sql.= $this->securities($var_array); 
        $sql.=')';
        // And its not a prepare syntax jet... because that not a live code
        // That should brake the solid o.
        return $this->query(
           'SELECT '. $sql 
        )[0][$sql]; 
    }
    function __construct(string $user, string $password, string $host, string $db)
    {
         $this->config(
             $user,
             $password, 
             $host, 
             $db
         );
         $this->connect();

    }

}


