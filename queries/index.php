<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
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

        $dbname = 'lamp';
        $user = 'root';
        $password = 'root';

        $mysql = new DBHandler($dbname, $user, $password);

        //var_dump($mysql);

        $arrayFields = [
            'id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
            'Nombre VARCHAR(60) NOT NULL',
            'Cantidad_Victoria INT(2)',
            'Cantidad_Derrota INT(2)'
        ];

        if ($mysql) {
            if ($mysql->createTable('Equipos', $arrayFields)) {
                echo 'Tabla creada exitosamente<br>';
            }
        }

        if ($mysql->insertFiled('Equipos', ['Nombre' => 'Saca Chispas', 'Cantidad_Victoria' => 0, 'Cantidad_Derrota' => 0])) {
            echo 'Campo insertado exitosamente<br>';
        }


        
    ?>
    
</body>
</html>