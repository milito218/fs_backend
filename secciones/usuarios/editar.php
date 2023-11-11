<?php
    include("../../db/db.php");

    if(isset($_GET['txtID'])){

        $txtID=(isset($_GET['txtID'])?$_GET['txtID']:"");

        $sentencia=$conect->prepare("SELECT * FROM tbl_usuarios WHERE id=:id");
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();
        
        $registro=$sentencia->fetch(PDO::FETCH_LAZY);
        
        $usuario=$registro["usuario"];
        $password=$registro["password"];
        $correo=$registro["correo"];

        
    }

    if($_POST) {
        $txtID=(isset($_POST['txtID'])?$_POST['txtID']:"");
        $usuario=(isset($_POST["usuario"])?$_POST["usuario"]:"");
        $password=(isset($_POST["password"])?$_POST["password"]:"");
        $correo=(isset($_POST["correo"])?$_POST["correo"]:"");

        $sentencia=$conect->prepare("UPDATE tbl_usuarios SET 
                                    usuario=:usuario,
                                    password=:password,
                                    correo=:correo
                                    WHERE id=:id
                                    ");

        $sentencia->bindParam(":usuario",$usuario);
        $sentencia->bindParam(":password",$password);
        $sentencia->bindParam(":correo",$correo);
        $sentencia->bindParam(":id",$txtID);

        $sentencia->execute();

        header("Location:index.php");

    }
        
?>

<?php include("../../templates/header.php")?>

<div class="card">
    <div class="card-header">
        Datos del usuario
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
              <label for="usuario" class="form-label">Nombre del usuario</label>
              <input type="text"
              value="<?php echo $usuario; ?>"
                class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Nombre del usuario">
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">Contraseña</label>
              <input type="password"
              value="<?php echo $password; ?>"
                class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Escriba su contraseña">
            </div>

            <div class="mb-3">
              <label for="correo" class="form-label">Correo</label>
              <input type="email"
              value="<?php echo $correo; ?>"
                class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Escriba su correo aquí">
              
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
     </form>
    </div>
</div>

<?php include("../../templates/footer.php")?>