@extends('layouts.main')

@section('main_content')

<section class="panel">
    <div class="panel-body">



           <div> 
              <table class="table table-striped table-bordered table-hover" id="tablamisvideos">
                                    <thead>
                                        <tr>
                                            
                                            <th>Titulo</th>
                                            <th>Estado</th>
                                             <th>Descripcion</th>
                                            <th>Accion</th>
                                        

                                        </tr>
                                    </thead>
                                      <tbody>
                                       @foreach($comments as $c)
                                        @foreach($c->videos as $ficha)
                                        <tr>  
                                         
                                           <td>{{ $ficha->titulo }}</td>
                                      
                                        
                                               @if( $ficha->publicado == '1' ) 
                                           <td>
                                              <span class="label label-success edit">Publicado</span>             
                                           </td>
                                              @else 
                                           <td>
                                              <span class="label label-danger edit">NoPublicado</span> 
                                          </td>    
                                              @endif
                                        



                                    <td>{{ $ficha->descripcion }}</td>

                                     
                                          <td width="10%" align="center">
                                             
                                          <button class="btn btn-sm btn-success"><a href="{{route('video.edit', $ficha->id)}}"  style="color: white;text-decoration: none;">Editar</a></button>
                                         
                                           
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
    //el cambio a español se ve en el js
    $(document).ready( function () {
    $('#tablamisvideos').DataTable( {
        "oLanguage": {
             "sLengthMenu": "_MENU_ registros por página",
            "zeroRecords": "No se han encontrado resultados",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay resultados disponibles",
            "infoFiltered": "(filtrado de _MAX_ videos totales)",
            "search":         "Buscar Video:",
             "oPaginate": {
                                           "sFirst":      "Primero",
                                            "sLast":       "Último",
                                            "sNext":       "Siguiente",
                                            "sPrevious":   "Anterior",
                         }
        }
    } );
    } );

    </script>

@stop
