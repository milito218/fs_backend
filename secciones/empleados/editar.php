<?php
    include("../../db/db.php");


    if(isset($_GET['txtID'])){

        $txtID=(isset($_GET['txtID'])?$_GET['txtID']:"");

        $sentencia=$conect->prepare("SELECT * FROM tbl_empleados WHERE id=:id");
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();
        $registro=$sentencia->fetch(PDO::FETCH_LAZY);

        
        $primernombre=$registro["primernombre"];
        $segundonombre=$registro["segundonombre"];
        $primerapellido=$registro["primerapellido"];
        $segundoapellido=$registro["segundoapellido"];
        
        $foto=$registro["foto"];
        $cv=$registro["cv"];

        $idpuesto=$registro["idpuesto"];
        $fechadeingreso=$registro["fechadeingreso"];

        $sentencia = $conect->prepare("SELECT * FROM `tbl_puestos`");
        $sentencia->execute();
        $lista_tbl_puestos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    }

    if($_POST) {
               
        $txtID=(isset($_POST['txtID'])?$_POST['txtID']:"");
        $primernombre=(isset($_POST["primernombre"])?$_POST["primernombre"]:"");
        $segundonombre=(isset($_POST["segundonombre"])?$_POST["segundonombre"]:"");
        $primerapellido=(isset($_POST["primerapellido"])?$_POST["primerapellido"]:"");
        $segundoapellido=(isset($_POST["segundoapellido"])?$_POST["segundoapellido"]:"");

        $idpuesto=(isset($_POST["idpuesto"])?$_POST["idpuesto"]:"");
        $fechadeingreso=(isset($_POST["fechadeingreso"])?$_POST["fechadeingreso"]:"");

        $sentencia=$conect->prepare("UPDATE tbl_empleados SET   
        
            primernombre=:primernombre,
            segundonombre=:segundonombre,
            primerapellido=:primerapellido,
            segundoapellido=:segundoapellido,
            idpuesto=:idpuesto,
            fechadeingreso=:fechadeingreso
        WHERE id=:id");
    
        $sentencia->bindParam(":primernombre",$primernombre);
        $sentencia->bindParam(":segundonombre",$segundonombre);
        $sentencia->bindParam(":primerapellido",$primerapellido);
        $sentencia->bindParam(":segundoapellido",$segundoapellido);
        $sentencia->bindParam(":idpuesto",$idpuesto);
        $sentencia->bindParam(":fechadeingreso",$fechadeingreso);
        $sentencia->bindParam(":id",$txtID);
        $sentencia->execute();
        
        $foto=(isset($_FILES["foto"]['name'])?$_FILES["foto"]['name']:"");
        
        $cv=(isset($_FILES["cv"]['name'])?$_FILES["cv"]['name']:"");
        
        // header("Location:index.php");
    }
?>

<?php include("../../templates/header.php")?>

<br/>

<div class="card">
    <div class="card-header">
        Datos del empleado
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
              <label for="primernombre" class="form-label">Primer nombre</label>
              <input type="text"
                value="<?php echo $primernombre; ?>"
                class="form-control" name="primernombre" id="primernombre" aria-describedby="helpId" placeholder="Primer nombre">
              
            </div>

            <div class="mb-3">
              <label for="segundonombre" class="form-label">Segundo Nombre</label>
              <input type="text"
                value="<?php echo $segundonombre; ?>"
                class="form-control" name="segundonombre" id="segundonombre" aria-describedby="helpId" placeholder="Segundo nombre">
            </div>

            <div class="mb-3">
              <label for="primerapellido" class="form-label">Primer apellido</label>
              <input type="text"
                value="<?php echo $primerapellido; ?>"
                class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="Primer apellido">
            </div>

            <div class="mb-3">
              <label for="segundoapellido" class="form-label">Segundo apellido</label>
              <input type="text"
                value="<?php echo $segundoapellido; ?>"
                class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="Segundo apellido">
            </div>

            <div class="mb-3">
              <label for="foto" class="form-label">Fotografía</label>
              <br/>
              <img width="100"
                            src="<?php echo $foto; ?>" 
                            class="rounded" alt=""/>
                            <br/> <br/>
                            
              <input type="file"
                class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Fotografía">
            </div>

            <div class="mb-3">
              <label for="cv" class="form-label">CV(PDF)</label>
              <br/>
              <a href="<?php echo $cv;?>"><?php echo $cv;?></a>
              <input type="file"
                class="form-control" name="cv" id="cv" aria-describedby="helpId" placeholder="CV(PDF)">
            </div>

            <div class="mb-3">
                <label for="idpuesto" class="form-label">Cargo:</label>
                "<?php echo $idpuesto; ?>"
                  <select class="form-select form-select-sm" name="idpuesto" id="idpuesto">
                    <?php foreach($lista_tbl_puestos as $registro_) { ?>
                      <option <?php echo ($idpuesto==$registro_['id'])?"selected":"";?> 
                            value="<?php echo $registro_['id'] ?>"> 
                            <?php echo $registro_['nombredelpuesto'] ?> 
                      </option>
                    <?php }?>
                  </select>
                  

            </div>

            <div class="mb-3">
              <label for="fechadeingreso" class="form-label">Fecha de ingreso</label>
              <input 
                value="<?php echo $fechadeingreso; ?>"        
                type="date" class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="emailHelpId" placeholder="Fecha de ingreso">
               
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
     </form>
    </div>
</div>

<?php include("../../templates/footer.php")?>