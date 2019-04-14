<?php $__env->startSection('content'); ?>

<!-- Modal Ver Contacto -->
ch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="VerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Nuevo Contacto -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Agregar Contacto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
          <form method="post" enctype="multipart/form-data" action="<?php echo e(route('contacto.store')); ?>" onsubmit=" return validarFormulario()">
                <?php echo e(csrf_field()); ?>

            <div class="input-group col-md-12 mb-3">
              <div class="row">
                <div class="col">
                  <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre">
                </div>
                <div class="col">
                  <input type="text" name="ap" id="ap" class="form-control" placeholder="Ap. Paterno">
                </div>
                <div class="col">
                  <input type="text" name="am" id="am" class="form-control" placeholder="Ap. Materno">
                </div>
              </div>
            </div> 
            <hr>
            <div class="input-group col-md-10 mb-3">
              <div class="row">
                <div class="col">
                  <label>Fecha de Naciemiento</label>
                <input type="date" class="form-control"  name="fnac" id="fnac" value="" required>      
                </div>
                <div class="col">
                  <label>Alias</label>
                  <input type="text" name="alias" id="alias" class="form-control" placeholder="Alias">
                </div>
              </div>
            </div>
            <hr> 
            <div class="input-group col-md-10 mb-3">
               <span class="badge badge-primary">Agregue Varios Correos Separandolo Con Una Coma (,)</span>
                <div class="input-group-prepend">
                  <span class="input-group-text">Correo:</span>
                </div>
                <input type="text" class="form-control" placeholder="Correo" name="correo" value="">
            </div>
            <hr> 
            <div class="input-group col-md-10 mb-3">
                
                <h5>Telefonos</h5>
                <input type="hidden" class="form-control-inline" placeholder="#Telefono" name="tel[]"/>
                 <div>
                </div>
                <div class="button">
                    <button type="button" id="add_tel" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <hr> 
            <div class="input-group col-md-10 mb-3">
              <span class="badge badge-primary">Agregue Varias Direcciones Separandolo Con Una Coma (,)</span>
                <div class="input-group-prepend">
                    <span class="input-group-text">Dirección:</span>
                </div>
                <input type="text" class="form-control" placeholder="Dirección" name="direccion" value="">
            </div> 
             <div class="form-group">
              <label for="imagengal">Elija una foto de perfil</label>
              <input type="file" class="form-control" name="foto">
            </div>
          
        
          
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary"  data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" >Agregar</button>
      </div>
      </form>
    </div>
  </div>
</div>

<div class="container">
  <?php if(Session::has('message')): ?>

      <div class="alert alert-info"><button class="close" data-dismiss="alert" type="button">×</button><?php echo e(Session::get('message')); ?></div>
      <?php endif; ?>
    <div class="row">
    <h2>Lista de Contactos</h2>
    </div>
    <p>Escribe el nombre o correo de algún contacto en especifico:</p>  
    <div class="row">
        <div class="col-md-8">
            <input class="form-control mb-2 mt-2" id="myInput" type="text" placeholder="Buscar..">        
        </div>
        <div class="col-md-2 ml-0 mr-0">
            <button type="button" class="btn btn-primary mb-2 mt-2" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-user-plus"></i></button>    
        </div>
    </div>
    <table class="table">
          <thead class="thead-dark">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Imagen</th>
              <th scope="col">Nombre</th>
              <th scope="col">Apellidos</th>
              <th scope="col">Alias</th>
              <th scope="col">Acciones</th>
            </tr>
          </thead>
          <tbody id="myTable">
            <?php $__currentLoopData = $contactos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contacto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <th scope="row"><?php echo e($contacto->id); ?></th>
              <td>
                 <?php if(!empty($contacto->imagen)): ?>
                <img src="imgs/users/<?php echo e($contacto->imagen); ?>" width="70px" height="70px" ><br> 
                <?php else: ?>
                <img src="imgs/users/default.png" alt="contacto-img" class="img-fluid" width="70px" height="70px">
                <?php endif; ?>
              </td>
              <td><?php echo e($contacto->nombre); ?> </td>
              <td><?php echo e($contacto->apellido_p); ?> <?php echo e($contacto->apellido_m); ?></td>
              <td><?php echo e($contacto->alias); ?></td>
              <td>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#VerModal">
                <i class="far fa-eye"></i>
                </button>
                <a class="btn btn-sm btn-info" href="<?php echo e(route('contacto.edit',$contacto->id)); ?>"><i class="fas fa-edit"></i>
                  <a href="<?php echo e(route('elicontacto',$contacto->id)); ?>"><button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button></a>
              </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
        <?php echo e($contactos->links()); ?>

    </table>
</div>

<script>
$(document).ready(function() {
    $("#add_tel").click(function(){
        var contador = $("input[type='text']").length;

        $(this).before('<div class="row mb-1"><input type="text" class="form-control-inline" placeholder="Etiqueta Telefono" name="ettel[]" id="ettel_'+ contador +'" /><input type="text" class="form-control-inline" placeholder="#Telefono" name="tel[]" id="tel_'+ contador +'"  /><button type="button" class="delete_email btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button></div>');
    });

     
                

    $(document).on('click', '.delete_email', function(){
        $(this).parent().remove();
    });
});


$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});



function validarFormulario(){
 
    var txtNombre = document.getElementById('nombre').value;
    var txtAp = document.getElementById('ap').value;
    var txtAm = document.getElementById('am').value;
    var txtAlias = document.getElementById('alias').value;
    
    //Test campo obligatorio nombre
    if(txtNombre == null || txtNombre.length == 0 || /^\s+$/.test(txtNombre)){
      swal("Error!", "El campo nombre no puede ir vacío!", "error");
      return false;
    }

    //Test campo obligatorio Apellido P
    if(txtAp == null || txtAp.length == 0 || /^\s+$/.test(txtAp)){
      swal("Error!", "El campo apellido paterno no puede ir vacío!", "error");
      return false;
    }

    if(txtAm == null || txtAm.length == 0 || /^\s+$/.test(txtAm)){
      swal("Error!", "El campo apellido materno no puede ir vacío!", "error");
      return false;
    }

    if(txtAlias == null || txtAlias.length == 0 || /^\s+$/.test(txtAlias)){
      swal("Error!", "El campo alias no puede ir vacío!", "error");
      return false;
    }

     
 
   return true;
  }

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\triara\resources\views/indexContacto.blade.php ENDPATH**/ ?>