@extends('layouts.main')

@section('main_content')
<section class="panel">

    <div class="panel-body">

        @if(Session::has('flash_msg'))
        <div class="alert alert-{{ Session::get('flash_type')}}">
            <button type="button" class="close close-sm" data-dismiss="alert"><i class="fa fa-times"></i></button>{{ Session::get('flash_msg') }}
        </div>
        @endif

        <div class="adv-table editable-table ">
            <div class="space15"></div>
            <table class="table table-striped table-hover table-bordered" id="editable-sample">
                <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Direccion</th>
                    <th>Tipo</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($places as $p)
                <tr class="">
                    <td>{{ $p->nombre }}</td>
                    <td>{{ $p->direccion }}</td>
                    <td>{{ $p->type }}</td> 
                    <td>@if( $p->publicado == '1' ) <span class="label label-success">Publicado</span> @else <span class="label label-default">No Publicado</span> @endif</td>
                    <td width="20%" align="center">
                        @if( $p->type == 'shop' || 'workshop' ) <a href="{{route('editPlace', $p->id)}}" title="EDITAR DATOS" class="btn btn-default"><i class="fa fa-edit"></i></a> @endif

                        @if( $p->type !== 'parking' ) <a href="{{route('editService', $p->id)}}" title="EDITAR SERVICIOS" class="btn btn-default"><i class="fa fa-check-square-o"></i></a> <a href="#myModal2" title="ELIMINAR NEGOCIO" class="btn btn-default btn_delete" data-place-id="{{ $p->id }}" data-toggle="modal"><i class="fa fa-times"></i></a> @elseif ( $p->type == 'shop' || 'workshop' ) <a href="#myModal2" title="Eliminar" class="btn btn-default btn_delete" data-place-id="{{ $p->id }}" data-toggle="modal"><i class="fa fa-times"></i></a> @endif
                        
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</section>

<!-- Modal -->
<div id="myModal2"  aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h4 class="modal-title">Confirmaci&oacute;n</h4>
            </div>
            <div class="modal-body">
                ¿Confirma que desea eliminar este registro permanentemente?
            </div>
            <div class="modal-footer">
                <button id="btn_close" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button id="btn_confirm" type="button" class="btn btn-primary"> Aceptar</button>
            </div>
        </div>
    </div>
</div>
<!-- modal -->
@stop

@section('bottom_js')

<script>
    $(document).ready(function() {

        var current_register_id = null;
        var current_object = null;
        var route = "{{ route('defaultRoute') }}/eliminar_lugar/";

        EditableTable.init();

        $('.btn_delete').live('click', function(){
            current_register_id = $(this).data('place-id');
            current_object = $(this);
        });

        $('#btn_confirm').live('click', function(){

            var token = "{{ csrf_token() }}";

            $.ajax({
                type: "post",
                url: route + current_register_id,
                data: {_method: 'delete', _token: token }
            })
            .done(function( msg ){

                var mensaje = "";

                switch(msg){
                    case 'EXCEPTION_ERROR':
                        mensaje = "No se puede eliminar porque uno o mas usuarios han evaluado el lugar";
                        break;
                    case 'DELETED_SUCCESS':
                        mensaje = "Registro eliminado correctamente";
                        break;
                    case 'DELETED_CERO':
                        mensaje = "Ningún registro eliminado";
                        break;
                    case 'DELETION_ERROR':
                        mensaje = "No se pudo eliminar el registro";
                        break;
                }

                $.gritter.add({
                    title: 'Información:',
                    text: mensaje,
                    time: 3000,
                    before_open: function()
                    {
                        $('#btn_close').click();

                        if(msg == 'DELETED_SUCCESS')
                        {
                            var nRow = current_object.parents('tr')[0];
                            nRow.remove();
                        }
                    }
                });

            });
        });

    });

    var EditableTable = function () {

        return {

            //main function to initiate the module
            init: function () {

                var oTable = $('#editable-sample').dataTable({
                    "aLengthMenu": [
                        [5, 15, 20, -1],
                        [5, 15, 20, "Todo"] // change per page values here
                    ],
                    // set the initial value
                    "iDisplayLength": 15,
                    "sDom": "<'row'<'col-lg-6'l><'col-lg-6'f>r>t<'row'<'col-lg-6'i><'col-lg-6'p>>",
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ registros por página",
                        "oPaginate": {
                            "sPrevious": "Anterior",
                            "sNext": "Siguiente"
                        }
                    },
                    "aoColumnDefs": [{
                        'bSortable': false,
                        'aTargets': [3]
                    }
                    ],
                    "aaSorting": [[ 2, "asc" ]]
                });

                jQuery('#editable-sample_wrapper .dataTables_filter input').addClass("form-control medium"); // modify table search input
                jQuery('#editable-sample_wrapper .dataTables_length select').addClass("form-control xsmall"); // modify table per page dropdown
            }
        };

    }();
</script>
@stop