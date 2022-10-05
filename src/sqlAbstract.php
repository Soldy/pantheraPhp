<?php

namespace Soldy\PanteraPhp;

use Soldy\PantheraPhp\SqlSecurity;

abstract class SqlAbstract
{
    use SqlSecurity;

    // @var {object}
    private $sql;
    // @var {boolean}
    private $loaded = false;
    // @var {string}
    private $username = "";
    // @var {string}
    private $password = "";
    // @var {string}
    private $host = "";
    // @var {string}
    private $database = "";
    // @var {integer}
    private $try  = 0;
    // @var {integer}
    private $try_max  = 0;
     /* Simple query
     * @param {string} //way call if procedure, select if function
     * @param {string} // transcript name
     * @param {array} variables
     * @protected
     * @return {array} sql result
     *
     */
    private function query(string $way, string &$name, array &$vars): array
    {
        $values = $this->securities($vars); // never trust any one ...
        $sql .= $way;
        $sql .= ' `';
        $sql .= $name;
        $sql .= '`(';
        for ($i = 0; count($values) > $i; $i++) {
            if ($i > 0) {
                 $sql .= ', ';
            }
            $sql .= '?';
        }
        $sql .= ')';
        $stmt = $this->sql->prepare($sql);
        $stmt->bind_param(...$values);
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $this->sql->close();
        $this->connect();
        return $rows;
    }
    /*
     * @param {string}
     * @param {string}
     * @param {string}
     * @param {string}
     * @protected
     * @return {void}
     *
     */
    protected function config(string $user, string $password, string $host, string $db)
    {
        $this->username = $user;
        $this->password = $password;
        $this->database = $db;
        $this->host = $host;
    }
    /*
     * @protected
     * @return {bool}
     *
     */
    protected function connect(): bool
    {
        $this->loaded = true;
        $this->sql = new \mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->database
        );
        if ($this->sql->connect_errno) {
            if ($this->try_max > $this->_try) {
                $this->try++;
                return $this->connect();
            } else {
                die('sql connection faild');
            }
        } else {
            $this->try = 0;
        }
    }
}
