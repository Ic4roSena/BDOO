<?php
    include 'model.php';
    $model = new Model();
    $id = $_REQUEST['id'];
    $delete = $model->delete($id);

    if ($delete) {
        echo "<script>alert('Deletado com sucesso!')</script>";
        echo "<script>window.location.href='list.php'</script>";
    }
?>