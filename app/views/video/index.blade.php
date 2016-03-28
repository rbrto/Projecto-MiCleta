@extends('layouts.main')

@section('additional_plugins')
@stop

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

                @if((!Session::get('flash_type')) || (Session::get('flash_type') !== "danger") )          
                 <div class="row">

					     <div class="col-md-12">
                 @foreach($comments as $c)
				        	  	<div class="well">
                            
                                  <blockquote>  

                                     <p><strong>Titulo :  </strong> {{ $c->titulo }}</p>    
                          

                                  @foreach($c->usuarios as $ficha)
                                        <p><strong>Fecha Publicación:  </strong>{{ date("d-m-Y",strtotime($ficha->pivot->fecha))}}</p>
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
              </div>

                <div style='margin-left: 400px;'>
              {{ $comments->links() }}   
              </div>   
                                     
				  </div>
                @endif

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