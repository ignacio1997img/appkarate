@extends('voyager::master')

@section('page_title', 'Viendo Arbitros')

@section('page_header')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body" style="padding: 0px">
                        <div class="col-md-8" style="padding: 0px">
                            <h1 id="titleHead" class="page-title">
                                <i class="fa-solid fa-person"></i> Arbitros
                            </h1>
                            <a href="{{ route('voyager.tournaments.index') }}" class="btn btn-warning">
                                <i class="fa-solid fa-rotate-left"></i> <span>Volver</span>
                            </a>
                        </div>
                        <div class="col-md-4 text-right" style="margin-top: 30px">
                            <a href="#" title="Registrar arbitro" data-target="#modal-create-customer" data-toggle="modal" class="btn btn-success">
                                <i class="voyager-plus"></i> <span>Crear</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('content')
    <div class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-bordered">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-10">
                                <div class="dataTables_length" id="dataTable_length">
                                    <label>Mostrar <select id="select-paginate" class="form-control input-sm">
                                        <option value="10">10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select> registros</label>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <input type="text" id="input-search" class="form-control">
                            </div>
                        </div>
                        <div class="row" id="div-results" style="min-height: 120px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <form action="{{ url('admin/tournaments/referee/store') }}" id="form-create-customer" method="POST">
        <div class="modal fade" tabindex="-1" id="modal-create-customer" role="dialog">
            <div class="modal-dialog modal-primary">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa-solid fa-person"></i> Registrar Arbitro</h4>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>CI</label>
                                <input type="text" id="ci" name="ci" class="form-control" placeholder="CI" required>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Edad</label>
                                    <input type="number" name="age" id="age" class="form-control" placeholder="edad" required>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label>Nombres</label>
                                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Nombres" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Apellidos</label>
                                <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Apellidos" required>
                            </div>
                        </div>


                        
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label>Observación/Descripción</label>
                                <textarea name="description" id="description" class="form-control" rows="2" placeholder="Observación"></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="tournament_id" value="{{$referee->id}}">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary btn-save-customer" value="Sí, guardar">
                    </div>
                </div>
            </div>
        </div>
    </form>


    <form action="#" id="destroy_form" method="POST">
        {{ method_field('DELETE') }}
        {{ csrf_field() }}
        <div class="modal modal-danger fade" data-backdrop="static" tabindex="-1" id="delete-modal" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="voyager-trash"></i> Desea eliminar el siguiente registro?</h4>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                            <i class="voyager-trash" style="color: red; font-size: 5em;"></i>
                            <p><b>Desea eliminar el siguiente registro?</b></p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-danger pull-right delete-confirm" value="Sí, eliminar">                        
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@stop

@section('css')

@stop

@section('javascript')
    <script src="{{ url('js/main.js') }}"></script>
    <script>
        var countPage = 10, order = 'id', typeOrder = 'desc';

        var tournament = {{$referee->id}}
        $(document).ready(() => {
            list();

            $('.toggleswitch').bootstrapToggle();
            
            $('#input-search').on('keyup', function(e){
                if(e.keyCode == 13) {
                    list();
                }
            });

            $('#select-paginate').change(function(){
                countPage = $(this).val();
                list();
            });

        });

        function list(page = 1){
            $('#div-results').loading({message: 'Cargando....'});
            let url = '{{ url("admin/tournaments/referee/ajax/list") }}/'+tournament;

            let search = $('#input-search').val() ? $('#input-search').val() : '';
            
            $.ajax({
                url: `${url}/${search}?paginate=${countPage}&page=${page}`,
                type: 'get',
                success: function(response){
                    $('#div-results').html(response);
                    $('#div-results').loading('toggle');
                }
            });
        }



        // ############################################################
        function destroyItem(url){
            $('#destroy_form').attr('action', url);
        }


    </script>
@stop
