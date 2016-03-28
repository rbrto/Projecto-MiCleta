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