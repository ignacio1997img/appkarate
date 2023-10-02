<div class="col-md-12">
    <div class="table-responsive">
        <table id="dataTable" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="text-align: center; width: 5%">Id</th>
                    <th style="text-align: center; width: 20%">Tipo & Categoría</th>
                    <th style="text-align: center; width: 15%">Dojo</th>
                    <th style="text-align: center; width: 30%">Nombres</th>
                    <th style="text-align: center; width: 5%">Género</th>
                    <th style="text-align: center; width: 5%">Edad</th>
                    <th style="text-align: center; width: 5%">Peso</th>
                    <th style="text-align: right; width: 15%">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>
                        {{ $item->type->type->name }} - {{ $item->type->description }}
                    </td>
                    <td>
                        {{ $item->dojo->name }}
                    </td>                    
                    <td>
                        
                        <small>CI: </small>{{ $item->ci }} <br>
                        {{ $item->first_name }} {{ $item->last_name }}
                    </td>
                    <td>
                        {{ $item->gender }}
                    </td>
                    <td>
                        {{ $item->age }}
                    </td>
                    <td>
                        {{ $item->weight }}
                    </td>
                    <td class="no-sort no-click bread-actions text-right">
                        <a data-target="#modal-edit-customer" data-toggle="modal" title="Editar" class="btn btn-sm btn-primary edit" data-item="{{$item}}">
                            <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Editar</span>
                        </a>
                        <button title="Borrar" class="btn btn-sm btn-danger delete" onclick="destroyItem('{{ route('tournaments-competitor.destroy', ['competitor' => $item->id]) }}')" data-toggle="modal" data-target="#delete-modal">
                            <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Borrar</span>
                        </button>
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