<?php
require '../databasereg.php';
$id = 0;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}
if (!empty($_POST)) {
    // keep track post values
    $id = $_POST['id'];
    // delete data
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql1 = "DELETE FROM alumnos_proyectos WHERE id_proyecto = ?";
    $q = $pdo->prepare($sql1);
    $q->execute(array($id));
    $sql = "DELETE FROM proyecto WHERE id_proy=?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    Database::disconnect();
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="styledelete.css">
</head>

<body>
    <div class="container">
        <div class="span10 offset1">
            <div class="row">
                <h3>Eliminar proyecto</h3>
            </div>

            <form class="form-horizontal" action="deletetec.php" method="post">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <p class="alert alert-error">¿ Estas seguro que quieres eliminar este proyecto ?</p>
                <div class="form-actions">
                    <button type="submit" class="btn btn-danger">Si</button>
                    <a class="btn" href="index.php">No</a>
                </div>
            </form>
        </div>
    </div> <!-- /container -->
</body>

</html>