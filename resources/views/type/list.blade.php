<div class="col-md-12">
    <div class="table-responsive">
        <table id="dataTable" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="text-align: center; width: 5%">Id</th>
                    <th style="text-align: center; width: 25%">Torneos</th>
                    <th style="text-align: center; width: 25%">Tipos de Torneos</th>
                    <th style="text-align: center; width: 25%">Categoría</th>
                    <th style="text-align: center; width: 10%">Estado</th>
                    <th style="text-align: right; width: 10%">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>
                        {{ $item->tournament->name }}
                    </td>
                    <td>
                        {{ $item->type->name }}
                    </td>
                    <td style="text-align: center">{{ $item->description }}</td>
                    <td style="text-align: center">
                            <label class="label label-success">Activo</label>
                    </td>
                    <td class="no-sort no-click bread-actions text-right">

                        <a href="{{ route('tournaments-type.competitor', ['tournament' => $item->tournament_id, 'type'=>$item->id]) }}" title="Editar" class="btn btn-sm btn-dark view">
                            <i class="fa-solid fa-people-roof"></i> <span class="hidden-xs hidden-sm">Competidores</span>
                        </a>
                        {{-- @if (auth()->user()->hasPermission('delete_tournaments')) --}}
                            <button title="Borrar" class="btn btn-sm btn-danger delete" onclick="destroyItem('{{ route('type.destroy', ['type' => $item->id]) }}')" data-toggle="modal" data-target="#delete-modal">
                                <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Borrar</span>
                            </button>
                        {{-- @endif --}}
                    </td>
                </tr>
                @empty
                    <tr class="odd" style="text-align: center">
                        <td valign="top" colspan="5" class="dataTables_empty">No hay datos disponibles en la tabla</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="col-md-12">
    <div class="col-md-4" style="overflow-x:auto">
        @if(count($data)>0)
            <p class="text-muted">Mostrando del {{$data->firstItem()}} al {{$data->lastItem()}} de {{$data->total()}} registros.</p>
        @endif
    </div>
    <div class="col-md-8" style="overflow-x:auto">
        <nav class="text-right">
            {{ $data->links() }}
        </nav>
    </div>
</div>

<script>
    var page = "{{ request('page') }}";
    $(document).ready(function(){
        $('.page-link').click(function(e){
            e.preventDefault();
            let link = $(this).attr('href');
            if(link){
                page = link.split('=')[1];
                list(page);
            }
        }); 

    });
</script>