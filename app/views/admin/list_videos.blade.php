@extends('layouts.main')

@section('main_content')

<section class="panel">
    <div class="panel-body">

     
       <div style='margin: 10px 0px 0px 300px' class='before'></div>   


           <div> 
              <table class="table table-striped table-bordered table-hover" id="tabla">
                                    <thead>
                                        <tr>
                                            
                                            <th>Titulo</th>
                                            <th>Publicado Por</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        

                                        </tr>
                                    </thead>
                                      <tbody>
                                       @foreach($comments as $c)
                                             @foreach($c->usuarios as $ficha)
                                        <tr>                                    
                                           <td>{{ $c->titulo }}</td>
                                           
                                             <td>{{$ficha->nombre}}</td>
                                           
                                               @if( $c->publicado == '1' ) 
                                           <td>
                                                    <span  idvideo="{{ $c->id }}" titulo="{{$c->titulo}}" nombre="{{ $ficha->nombre}}" apellido="{{ $ficha->apellido }}" email="{{ $ficha->email}}" class="label label-success edit">Publicado</span>             
                                           </td>
                                              @else 
                                           <td>
                                              <span  idvideo="{{ $c->id }}" titulo="{{$c->titulo}}" nombre="{{ $ficha->nombre}}" apellido="{{ $ficha->apellido }}" email="{{ $ficha->email}}" class="label label-danger edit">NoPublicado</span> 
                                          </td>    
                                              @endif


                                     
                                          <td width="20%" align="center">
                                            
                                            <button class="btn btn-sm btn-primary"><a href="{{route('detalleVideo', $c->id)}}" style="color: white;text-decoration: none;">Detalles</a></button>
                                            
                                         
                                         </td>
                                                                                                                  
                                    </tr>
                                    @endforeach
                                   @endforeach
                                    </tbody>
                                   
                </table>
           </div>   
      </div>
</section>
@stop


@section('bottom_js')
   


    <script>
    
    $(document).ready( function () {
    $('#tabla').DataTable( {
        "oLanguage": {
            "sLengthMenu": "_MENU_ resultados por página",
            "zeroRecords": "No se han encontrado resultados",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay resultados disponibles",
            "infoFiltered": "(filtrado de _MAX_ clientes totales)",
            "search":         "Buscar Cliente:",
             "oPaginate": {
                                           "first":      "Primero",
                                            "last":       "Último",
                                            "sNext":       "Siguiente",
                                            "sPrevious":   "Anterior",
                         }
        }
    } );
    } );

    </script>

    <script>
      $(document).ready(function() {

        $(".edit").on("click", function(e){
            e.preventDefault();

 

            id_video = $(this).attr('idvideo');
            titulo = $(this).attr('titulo');
            nombre= $(this).attr('nombre');
            apellido= $(this).attr('apellido');
            email= $(this).attr('email');
                   
            $.ajax({
                type: "POST",
                url: 'editar_video',
                dataType: 'json',
                data: {id: id_video, titulo:titulo, nombre:nombre, apellido:apellido, email:email},
                
                beforeSend: function(){
                   $('.before').append('<img src="images/350.gif" />');
                },
                success: function (data)
                {
                    var mensaje = "";

                     switch(data)
                     {
                        case 'PUBLICADO':
                            mensaje = "Se ha enviado un correo al usuario.";
                                   $.gritter.add(
                                    {
                                      title: 'Información:',
                                      text: mensaje,
                                      time: 2000
                                     
                                    });
                 

                                   setTimeout(function(){
                                      location.reload();;
                                   }, 2500);
                              

                             break;

                        case 'NOPUBLICADO':
                            location.reload();
                            break;
                   
                   }
                
                  

              }
          })
      });
  });
  </script>





 @stop   