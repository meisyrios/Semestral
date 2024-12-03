<?php
class Conecta{
    private $servername = "172.30.158.22";
    private $username = "root";
    private $password = "fisc24*";
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
