<?php

namespace Soldy\PanteraPhp;

use Soldy\PantheraPhp\SqlInterface;
use Soldy\PantheraPhp\SqlAbstract;

class Sql extends SqlAbstract implement SqlInterface
{
    /* this funcion call the functions on the sql
     *
     * @param {string}
     * @param {array} variables
     * @public
     * @return {mixed} always come back with the first line.
     *
     *
     */
    public function queryProcedure(string &$procedure, array &$var): mixed
    {
        return $this->query('CALL ', $procedure, $vars);
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
    public function queryFunction(string &$func, array &$vars): string|int
    {
        return $this->query('SELECT ', $procedure, $vars);
    }
    public function __construct(string &$user, string &$password, string &$host, string &$db)
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
