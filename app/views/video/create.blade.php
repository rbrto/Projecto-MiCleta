@extends('layouts.main')

@section('main_content')
<div class="row">
<div class="col-sm-12">
        <section class="panel">
            <div class="panel-body">

               
            @if(Session::has('flash_msg'))
                <div class="alert alert-{{ Session::get('flash_type')}}">
                    <button type="button" class="close close-sm" data-dismiss="alert"><i class="fa fa-times"></i></button>{{ Session::get('flash_msg') }}
                </div>
            @endif


                {{ Form::open(array('route' => 'video.store', 'method' => 'POST','enctype' =>'multipart/form-data')) }}

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">

                            {{ Form::label('titulo','Titulo') }}

                            {{ Form::text('titulo', $errors->has('titulo') ? Input::old('titulo') : '', array('placeholder' => '', 'class' => 'form-control')) }}

                            @if( $errors->has('titulo') )
                            @foreach($errors->get('titulo') as $error )
                            <p class="help-block" style="color: #a94442">{{ $error }}</p>
                            @endforeach
                            @endif

                        </div>
                    </div>
                </div>
          
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">

                            {{ Form::label('comentario','Comentario') }}

                            {{ Form::textarea('comentario', $errors->has('comentario') ? Input::old('comentario') : '', array('placeholder' => '', 'class' => 'form-control', 'rows' => '5')) }}

                            @if( $errors->has('comentario') )
                            @foreach($errors->get('comentario') as $error )
                            <p class="help-block" style="color: #a94442">{{ $error }}</p>
                            @endforeach
                            @endif

                        </div>
                    </div>
                </div>
  <br>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">

                           {{ Form::file('archivo',['id' => 'input-file','size' => '60000']) }}

                            @if( $errors->has('archivo') )
                            @foreach($errors->get('archivo') as $error )
                            <p class="help-block" style="color: #a94442">{{ $error }}</p>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>


                {{ Form::hidden('creador', Auth::user()->id ) }}
    

   
       <br>

                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            {{ Form::reset('Borrar', array('class' => 'btn btn-default')) }}
                            {{ Form::submit('Publicar Video', array('class' => 'btn btn-primary')) }}
                        </div>
                    </div>
                </div>

                {{ Form::close() }}
            </div>
        </section>
    </div>
 </div>
 @stop

 @section('bottom_js')

    <script>
$(document).ready(function (){
   /* Valida el tamaño maximo de un archivo adjunto */
   $('#input-file').change(function (){
     var sizeByte = this.files[0].size;
     //1Mb=1024Kb
     var siezekiloByte = parseInt(sizeByte / 1024);
 
     if(siezekiloByte > $(this).attr('size')){

        var mensaje = "El tamaño supera el limite permitido!";
        $.gritter.add({
            title: 'Información:',
            text: mensaje,
            time: 3000
        });

    
         $(this).val('');
     }
   });
});
</script>
 @stop
