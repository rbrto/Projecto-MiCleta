@extends('layouts.main')

@section('additional_plugins')
@stop

@section('main_content')
<div class="row">
    <div class="col-sm-12">
        <section class="panel">
            <div class="panel-body">

                 @foreach($comments as $c)
                      <div class="well">
                            
                                  <blockquote>  

                                     <p><strong>Titulo :  </strong> {{ $c->titulo }}</p>    
                          

                                  @foreach($c->usuarios as $ficha)
                                        <p><strong>Fecha :  </strong>{{ $ficha->pivot->fecha}}</p>
                                      <p><strong>Publicado por :  </strong> {{ $ficha->nombre}}</p>
                                    
                                  <div class="well">   

                                   <div class="well" id="target" style="width:400px;  height: 200px; overflow: scroll; display: inline-block; ">

                                  <p>{{ $c->descripcion }}</p>
                                 </div>
                                 @endforeach

                              
 
                                 <div style=" width:300px;  margin-left: 100px; display: inline-block; ">
                                     <video width="370" height="219" controls>
                                         <source src="{{ $c->url }}" type="video/mp4">
                              
                                    </video>
                              </div>
                            </div>

                            </blockquote>

              </div> 
              @endforeach        
               
               <div style='margin-left: 400px;'>
              {{ $comments->links() }}    
              </div>          
                       
            </div>
        </section>
    </div>
    
</div>
@stop

@section('bottom_js')

<script>  
    $( "#target" ).scroll(function() {
  $( "#log" ).append( "<div>Handler for .scroll() called.</div>" );
});

</script>

@stop