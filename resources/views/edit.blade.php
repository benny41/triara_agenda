@extends('layout')
 @section('content')
 <h1 class="text-center">Actualizar Datos</h1>
<hr>
@if (Session::has('message'))
      <div class="alert alert-info"><button class="close" data-dismiss="alert" type="button">×</button>{{ Session::get('message') }}</div>
 @endif
<div class="container edit-contact">
  <div class="row">
  <div class="col-md-2"></div>
  
  <div class="col-md-8">
<form method="post" enctype="multipart/form-data" action="{{route('contactoUpdate')}}" onsubmit=" return validarFormulario()">
                {{ csrf_field() }}
  <div class="row">
   <div class="col-md-4">
      <div class="form-group mb-2 mt-2">
        <input type="hidden" name="idContacto" value="{{$contacto->id}}">
        <input type="text" class="form-control" id="nombre" placeholder="Nombre: " value="{{$contacto->nombre}}" name="nombre">
      </div>   
   </div> 
   <div class="col-md-4  mb-2 mt-2">
      <div class="form-group">
        <input type="text" class="form-control" id="ap" placeholder="Ap. Paterno: " value="{{$contacto->apellido_p}}" name="ap">
      </div>   
   </div>
   <div class="col-md-4 mb-2 mt-2">
      <div class="form-group">
        <input type="text" class="form-control" id="am" placeholder="Ap. Materno:" value="{{$contacto->apellido_m}}" name="am">
      </div>   
   </div>  
  </div>
  
  <div class="form-group">
    <div class="row">
      <div class="col-md-6">
        <label>Fecha de Naciemiento</label>
        <input type="date" class="form-control"  name="fnac" id="fnac" value="{{$contacto->fnac}}" required>      
      </div>
      <div class="col-md-6">
        <label>Alias</label>
        <input type="text" name="alias" id="alias" class="form-control" placeholder="Alias" value="{{$contacto->alias}}">
      </div>
    </div>
  </div>
  <hr>
  <h4>Correos</h4>
  <div class="form-group">
    <div class="row">
    @foreach($correos as $correo)
    <a href="{{ route('elicorreo',$correo->id) }}" class="badge badge-danger ml-2 mr-2">{{$correo->correo}} x</a>
    @endforeach
    </div>
    <div class="row">
      <div class="col-md-5">
       <span class="badge badge-primary">Agregue Varias Direcciones Separandolo Con Una Coma (,)</span> 
      </div>
    </div>
    <div class="row input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">Correo:</span>
      </div>
      <input type="text" class="form-control" placeholder="Correo" name="correo" value="">
    </div>
  </div>
  <hr>
  <h4>Direcciones</h4>
  <div class="form-group">
    <div class="row">
    @foreach($dirs as $dir)
    <a href="{{ route('elidir',$dir->id) }}" class="badge badge-danger ml-2 mr-2">{{$dir->direccion}} x</a>
    @endforeach
    </div>
    <div class="row">
      <div class="col-md-5">
       <span class="badge badge-primary">Agregue Varias Direcciones Separandolo Con Una Coma (,)</span> 
      </div>
    </div>
    <div class="row input-group">
      <div class="input-group-prepend">
        <span class="input-group-text">Correo:</span>
      </div>
      <input type="text" class="form-control" placeholder="Correo" name="correo" value="">
    </div>
  </div>
  <hr>
  <h4>Telefonos</h4>
  <div class="form-group">

    <div class="row">
    @foreach($telefonos as $telefono)
    <a href="{{ route('elitel',$telefono->id) }}" class="badge badge-danger ml-2 mr-2">{{$telefono->etiqueta}}: {{$telefono->telefono}} x</a>
    @endforeach
    </div>
    <div class="row input-group">
    <input type="hidden" class="form-control-inline" placeholder="#Telefono" name="tel[]"/>  
    <div>
    </div>
    <div class="button">
      <button type="button" id="add_tel" class="btn btn-success btn-sm"><i class="fas fa-plus"></i></button>
    </div>
    </div>
    <div class="form-group">
    @if(!empty($contacto->imagen))
      <img src="{{asset('imgs/users/$contacto->imagen')}}" width="70px" height="70px" ><br> 
    @else
      <img src="{{ asset('imgs/users/default.png')}}" alt="contacto-img" class="img-fluid" width="70px" height="70px">
    @endif
    <label for="imagengal">Elija una foto de perfil</label>
    <input type="file" class="form-control" name="foto">
    </div>
  <div class="form-group">
    
        <button type="submit" class="btn btn-primary" >Actualziar</button>
  </div>
  </div>
</form>
</div>
</div>
</div> 

<script>
  $(document).ready(function() {
    $("#add_tel").click(function(){
        var contador = $("input[type='text']").length;

        $(this).before('<div class="input-group col-md-11 mb-1"><input type="text" class="form-control-inline" placeholder="Etiqueta Telefono" name="ettel[]" id="ettel_'+ contador +'" /><input type="text" class="form-control-inline" placeholder="#Telefono" name="tel[]" id="tel_'+ contador +'"  /><button type="button" class="delete_email btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button></div>');
    });

     $(document).on('click', '.delete_email', function(){
        $(this).parent().remove();
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
 @endsection