<?php


namespace Soldy\PanteraPhp;



abstract class SqlAbstract 
{
    // @object
    private $sql;
    // @var {boolean}
    private $_loaded = false;
    // @var {string}
    private $_username = "";
    // @var {string}
    private $_password = "";
    // @var {string}
    private $_host = "";
    // @var {string}
    private $_database = "";
    // @var {integer}
    private $_try  = 0;
    // @var {integer}
    private $_try_max  = 0;
    /*
     * @param {string}
     * @protected
     */
    protected function query(string &$query) : array
    {
        $rows = [];
        $res = $this->sql->query($query);
        if ($this->sql->errno)
            error_log($this->sql->error, 0);
        if ($res == false)
            return [];
        while ($row = $res->fetch_assoc())
            $rows[] = $row;
        $this->sql->close();
        $this->connect();
        return $rows;
    }
    /*
     * @param {string}
     * @param {string}
     * @param {string}
     * @param {string}
     *
     */
    protected function config(string $user, string $password, string $host, string $db)
    {
        $this->_username = $user;
        $this->_password = $password;
        $this->_database = $db;
        $this->_host = $host;
    }
    /*
     *
     */
    protected function connect() : bool
    {
        $this->loaded=true;
        $this->sql = new \mysqli(
            $this->_host, 
            $this->_username, 
            $this->_password, 
            $this->_database
        );
        if ($this->sql->connect_errno){
            if($this->_try_max > $this->_try){
                $this->_try++;
                return $this->connect();
            }else{
                die('sql connection faild');
            }
        }else{
            $this->_try=0;
        }
    }
}

