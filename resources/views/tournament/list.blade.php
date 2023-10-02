<div class="col-md-12">
    <div class="table-responsive">
        <table id="dataTable" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th style="text-align: center; width: 5%">Id</th>
                    <th style="text-align: center; width: 25%">Nombre</th>
                    <th style="text-align: center; width: 10%">Fecha</th>
                    <th style="text-align: center; width: 30%">Descripción</th>
                    <th style="text-align: center; width: 10%">Estado</th>
                    <th style="text-align: right; width: 20%">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>
                        <table>
                            @php
                                $image = asset('images/default.jpg');
                                if($item->image){
                                    $image = asset('storage/'.str_replace('.', '-cropped.', $item->image));
                                }
                            @endphp
                            <tr>
                                <td><img src="{{ $image }}" alt="{{ $item->first_name }} {{ $item->last_name }}" style="width: 60px; height: 60px; border-radius: 30px; margin-right: 10px"></td>
                                <td>
                                    {{ $item->name }}
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td style="text-align: center">{{ date('d/m/Y', strtotime($item->date)) }}</td>
                    <td style="text-align: center">{{ $item->description }}</td>
                    <td style="text-align: center">
                        @if ($item->status == 0)
                            <label class="label label-success">Finalizado</label>
                        @else
                            <label class="label label-primary">En Curso</label>
                        @endif
                    </td>
                    <td class="no-sort no-click bread-actions text-right">
                        <a href="{{ route('tournaments.referee', ['tournament' => $item->id]) }}" title="Editar" class="btn btn-sm btn-success view">
                            <i class="voyager-success"></i> <span class="hidden-xs hidden-sm">Finalzar Campeonato</span>
                        </a>
                        {{-- <a href="{{ route('tournaments.referee', ['tournament' => $item->id]) }}" title="Editar" class="btn btn-sm btn-dark view">
                            <i class="fa-solid fa-person"></i> <span class="hidden-xs hidden-sm">Arbitros</span>
                        </a> --}}
                        <a href="{{ route('tournaments.type', ['tournament' => $item->id]) }}" title="Editar" class="btn btn-sm btn-dark view">
                            <i class="fa-solid fa-list"></i> <span class="hidden-xs hidden-sm">Categorias</span>
                        </a>
                        @if (auth()->user()->hasPermission('read_tournaments'))
                            <a href="{{ route('voyager.tournaments.show', ['id' => $item->id]) }}" title="Ver" class="btn btn-sm btn-warning view">
                                <i class="voyager-eye"></i> <span class="hidden-xs hidden-sm">Ver</span>
                            </a>
                        @endif
                        @if (auth()->user()->hasPermission('edit_tournaments'))
                            <a href="{{ route('voyager.tournaments.edit', ['id' => $item->id]) }}" title="Editar" class="btn btn-sm btn-primary edit">
                                <i class="voyager-edit"></i> <span class="hidden-xs hidden-sm">Editar</span>
                            </a>
                        @endif
                        @if (auth()->user()->hasPermission('delete_tournaments'))
                            <button title="Borrar" class="btn btn-sm btn-danger delete" onclick="deleteItem('{{ route('voyager.tournaments.destroy', ['id' => $item->id]) }}')" data-toggle="modal" data-target="#delete-modal">
                                <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">Borrar</span>
                            </button>
                        @endif
                    </td>
                </tr>
                @empty
                    <tr class="odd" style="text-align: center">
                        <td valign="top" colspan="6" class="dataTables_empty">No hay datos disponibles en la tabla</td>
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