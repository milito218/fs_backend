<?php
    include("../../db/db.php");

    if(isset($_GET['txtID'])){

        $txtID=(isset($_GET['txtID'])?$_GET['txtID']:"");

        $sentencia=$conect->prepare("SELECT * FROM tbl_puestos WHERE id=:id");
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();
        $registro=$sentencia->fetch(PDO::FETCH_LAZY);
        $nombredelpuesto=$registro["nombredelpuesto"];

        
    }

    if($_POST) {
        $txtID=(isset($_POST['txtID'])?$_POST['txtID']:"");
        $nombredelpuesto=(isset($_POST["nombredelpuesto"])?$_POST["nombredelpuesto"]:"");
        $sentencia=$conect->prepare("UPDATE tbl_puestos 
                                     SET nombredelpuesto=:nombredelpuesto
                                     WHERE id=:id");
        $sentencia->bindParam(":nombredelpuesto",$nombredelpuesto);
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();
        header("Location:index.php");
    }

        
?>

<?php include("../../templates/header.php")?>



<div class="card">
    <div class="card-header">
        Datos del puesto
    </div>
    <div class="card-body">
        
    </div>
    <div class="card-footer text-muted">
        <form action="" method="post" enctype="multipart/form-data">


            <div class="mb-3">
              <label for="txtID" class="form-label">ID</label>
              <input type="text"
                value="<?php echo $txtID; ?>"
                class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="">
            </div>

            <div class="mb-3">
              <label for="nombredelpuesto" class="form-label">Nombre del puesto</label>
              <input type="text"
              value="<?php echo $nombredelpuesto; ?>"
                class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Nombre del puesto">
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
     </form>
    </div>
</div>

<?php include("../../templates/footer.php")?>