<?php
class Model{
    private $server = "localhost";//local hospedado o banco de dados
    private $username = "root";//username do seu banco de dados
    private $pass = ""; // Adicione a senha do banco de dados aqui
    private $database = "";//Nome da database
    private $conn;

   public function __construct(){
        try{
            $this->conn = new mysqli($this->server, $this->username, $this->pass, $this->database);
        }catch(Exception $e){
            echo "A conexão Falhou!".$e->getMessage();
        }
    }

    public function insert(){
        if (isset($_POST['submit'])){
            // Verifique se os campos name, email, whatsapp e address existem
            if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['whatsapp']) && isset($_POST['address'])){
                if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['whatsapp']) && !empty($_POST['address'])){
                    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                    $whatsapp = filter_input(INPUT_POST, 'whatsapp', FILTER_SANITIZE_STRING);
                    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);

                    $query = "INSERT INTO cadastros (name, email, whatsapp, address) VALUES ('$name', '$email', '$whatsapp', '$address')";
                    if ($this->conn->query($query)) {
                        echo "<script>alert('Dados inseridos com sucesso!')</script>";
                        echo "<script>window.location.href='index.php'</script>";
                    } else {
                        echo "<script>alert('Ocorreu um erro!')</script>";
                        echo "<script>window.location.href='index.php'</script>";
                    }
                } else {
                    echo "<script>alert('Preencha todos os campos!')</script>";
                    echo "<script>window.location.href='index.php'</script>";
                }
            } else {
                echo "<script>alert('Campos ausentes!')</script>";
                echo "<script>window.location.href='index.php'</script>";
            }
        }
    }

    public function fetch(){
        $data = array();
        $query = "SELECT * FROM cadastros";
        $sql = $this->conn->query($query);
        if($sql){
            while ($row = mysqli_fetch_assoc($sql)){
                $data[]=$row;
            }
        }
        return $data;
    }

    public function delete($id){
        $query = "DELETE FROM cadastros WHERE id = '$id'";
        if($sql = $this->conn->query($query)){
            return true;
        } else {
            return false;
        }
    }

    public function fetch_unico($id){
        $data = null;
        $query = "SELECT * FROM cadastros WHERE id = '$id'";
        $sql = $this->conn->query($query);
        if ($sql){
            while ($row = $sql->fetch_assoc()){
                $data = $row;
            }
        }
        return $data;
    }

    public function edit($id){
        $data = null;
        $query = "SELECT * FROM cadastros WHERE id = '$id'";
        $sql = $this->conn->query($query);
        if($sql){
            while ($row = $sql->fetch_assoc()) {
                $data = $row;
            }
            }
        }
        public function update($data){
            $query = "UPDATE cadastros SET name='$data[name]', email ='$data[email]',whatsapp='$data[whatsapp]', address='$data[address]' WHERE id='$data[id]'";
            if ($sql = $this->conn->query($query)) {
                return true;
            }else{ 
                return false;
            }
            }
        }
    ?>