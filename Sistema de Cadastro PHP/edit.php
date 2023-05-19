<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Registro</title>
    <!-- script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!-- css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                <h1 class="text-center">
                    Sistema de Cadastro
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-5 mx-auto">
                <?php
                require_once 'model.php';
                $model = new Model();
                $id = $_REQUEST['id'];
                $row = $model->edit($id);
                if (isset($_POST['update'])) {
                    // Verifique se os campos name, email, whatsapp e address existem
                    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['whatsapp']) && isset($_POST['address'])) {
                        if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['whatsapp']) && !empty($_POST['address'])) {
                            $data['id'] = $id;
                            $data['name'] = $_POST['name'];
                            $data['email'] = $_POST['email'];
                            $data['whatsapp'] = $_POST['whatsapp'];
                            $data['address'] = $_POST['address'];

                            $update = $model->update($data);
                            if ($update) {
                                echo "<script>alert('Atualizado com sucesso!')</script>";
                                echo "<script>window.location.href='list.php'</script>";
                            } else {
                                echo "<script>alert('Falha ao atualizar!')</script>";
                                echo "<script>window.location.href='list.php'</script>";
                            }
                        } else {
                            echo "<script>alert('Erro! Preencha todos os campos.')</script>";
                            header("Location: edit.php?id=$id");
                            exit(); // Adicionei um exit() para interromper a execução do código após o redirecionamento
                        }
                    }
                }
                ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" value="<?php echo $row['name']; ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">E-mail</label>
                        <input type="text" name="email" value="<?php echo $row['email']; ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Whatsapp</label>
                        <input type="text" name="whatsapp" value="<?php echo $row['whatsapp']; ?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="">Endereço</label>
                        <textarea name="address" rows="3" class="form-control" required><?php echo $row['address']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="update" class="btn btn-primary">Atualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
