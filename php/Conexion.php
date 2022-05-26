<?php
    class Conexion{
      /**definimos variabbles de conexion */      
      private $host = "localhost";
      private $user = "root";
      private $pass = "";
      private $dbname ="cluster";

      private $dbh;
      private $error;
      private $stmt;
/**
 * constructoe de la clase conexion
 */
      public function __construct(){        
        $dsn = 'mysql:host='.$this->host . ';dbname='. $this->dbname;
        $options = array(
            PDO::ATTR_PERSISTENT    =>true,
            PDO::ATTR_ERRMODE       =>PDO::ERRMODE_EXCEPTION
        );
        try{
          $this->dbh = new PDO($dsn, $this->user, $this->pass,$options);          
        }catch(PDOEception $e){
          $this->error = $e-> getMessage();
        }
      }
/**
 * metodo para preparar qwerys 
 */
      public function query($query){
        $this->stmt = $this->dbh->prepare($query);
      }

      public function bind($param, $value, $type = null){
        if(is_null($type)){
          switch(true){
            case is_int($value):
                $type = PDO::PARAM_INT;
                break;
            case is_bool($value):
                $type = PDO::PARAM_BOOL;
                break;
            case is_null($value):
                $type = PDO::PARAM_NULL;
                break;
                default: 
                $type = PDO::PARAM_STR;
          }
        }
        $this->stmt->bindValue($param,$value,$type);
      }
/**
 * Metodo interno para ejecutar el query
 */
      public function execute(){
        return $this->stmt->execute();
      }
      public function lastInsertId(){
        $this->dbh->lastInsertId();
      }
      /**Metodo para mandar llamar el resultado de la ejecucion del query */
      public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
      }      
    }
?>