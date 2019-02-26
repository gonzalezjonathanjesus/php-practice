<?php
    class DBHandler {
        private $dbname;
        private $user;
        private $password;
        private $connection;

        function __construct($dbname, $user, $password) {
            $this->dbname = $dbname;
            $this->user = $user;
            $this->password = $password;

            $this->connect();
        }

        private function connect() {
            try {
                $mysql = new PDO('mysql:host=localhost;dbname=' . $this->dbname, $this->user, $this->password);
    
                if ($mysql) {
                    $this->connection = $mysql;
                    return 'Connected successfully';
                }
            } catch (PDOException $e) {
                return "¡Error!: " . $e->getMessage() . "<br/>";
                die();
            }
        }

        public function createTable($tableName, $arrayFields) {

            $query = 'CREATE TABLE IF NOT EXISTS '.$tableName.' (' . implode(", ", $arrayFields) . ')';
            
            try {
                $this->connection->exec($query);
                return true;

            } catch(PDOException $e) {
                echo 'Error <br>';
                return $e->getMessage();//Remove or change message in production code
            }
        }

        public function insertFiled($tableName, $arrayFields) {

            $fieldsArray = array();
            $valuesArray = array();

            foreach( $arrayFields as $field => $value) {
                if (gettype($value) == 'string') {
                    $value = "'".$value."'";
                }

                $fieldsArray[] = $field;
                $valuesArray[] = $value;
            }

            $fields = ' (' . implode(', ', $fieldsArray) .')';
            $values =' VALUES (' . implode(', ', $valuesArray) .')';

            $query = 'INSERT INTO ' .$tableName.$fields.$values;

            var_dump($query);
            
            try {
                $this->connection->exec($query);
                return true;
            } catch(PDOException $e) {
                echo 'Error <br>';
                return $e->getMessage();//Remove or change message in production code
            }
        }
    }
?>