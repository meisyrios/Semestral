<?php
class Conecta{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "datos";

    private $cnn;
    public function conectarDB(){
        $this->cnn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if($this->cnn->connect_error){
            die("Conexion failed: " . $this->cnn->connect_error);
        } else {
            echo "Conexion exitosa";
            return $this->cnn;
        }
    }

    public function cerrar(){
        $this->cnn->close();
    }
}
?>
