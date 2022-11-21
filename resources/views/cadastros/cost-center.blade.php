<x-aplicativo-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Centro de custo
        </h2>
    </x-slot>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filtros</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('centro-de-custo.index') }}" method="get">
                @csrf
                <div>
                    <div class="row">
                        <div class="col">
                            <label>Tipo</label>
                            <select class="form-select-item select form-control form-control-sm form-control form-control-sm-sm" name="tipo_search">
                                <option value="">Selecione um Tipo</option> 
                                <option value="Entrada">Entrada</option>
                                <option value="Saida">Saida</option>
                            </select>
                        </div>  
                        <div class="col">
                            <label>Atividade</label>
                            <select class="form-select-item select form-control form-control-sm form-control form-control-sm-sm" name="atividade_search">
                                <option value="">Selecione uma Atividade</option>
                                @foreach($activities as $item)
                                    <option value="{{ $item->id }}">{{ $item->nome }}</option>
                                @endforeach                       
                            </select>  
                        </div>               
                        <div class="col">
                            <label>..</label></br>
                            <button type="submit" class="btn btn-secondary btn-sm"><i class="fa fa-search" aria-hidden="true"></i>Pesquisar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-end">
            <a class="btn-success p-2 rounded text-decoration-none mr-4" href="javascript:void(0)" data-toggle="modal"
                data-target="#register-new-item-modal">
                <i class="fa-plus-circle fas mr-2"></i>
                Cadastrar
            </a>
            <a class="btn-primary p-2 rounded text-decoration-none" href="{{ route('cost-center.export') }}">
                <i class="fa-download fas mr-2"></i>
                Exportar
            </a>
        </div>

        <div class="card-body">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            @component('components.dataTable',
                [
                    'headers' => ['id', 'Nome', 'Atividade', 'Tipo', 'Ações'],
                ])

                @slot('data')
                    @foreach ($cost_centers ?? '' as $cost_center)
                        <tr>
                            {{-- <td title="{{$produto ?? ''->id}}">{{$produto ?? ''->id}}</td> --}}
                            {{-- <td title="{{$cost_center->atividade}}">{{$cost_center->atividade ? 'Sim' : 'Não'}}</td> --}}
                            <td title="{{ $cost_center->id }}">{{ $cost_center->id }}</td>
                            <td title="{{ $cost_center->nome }}">{{ $cost_center->nome }}</td>
                            <td title="{{ $cost_center->atividade }}">{{ $cost_center->activity->nome }}</td>
                            <td title="{{ $cost_center->tipo }}">{{ $cost_center->tipo }}</td>
                            <td title="Ações">
                                <a role="button" class="delete-row-js" data-route="{{route('centro-de-custo.destroy',$cost_center->id)}}">
                                    <i class="fa fa-trash _i text-danger"></i>
                                </a>
                                <a role="button" class="edit-row-js" data-route="{{route('centro-de-custo.show', $cost_center->id)}}">
                                    <i class="fa fa-edit _i text-navy"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endslot

            @endcomponent
        </div>
    </div>

    <div class="modal fade" id="register-new-item-modal" tabindex="-1" role="dialog" aria-labelledby="register-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="register-modal">Cadastro de Centro de Custo</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('centro-de-custo.store') }}" class="needs-validation" novalidate>
                    <div class="modal-body">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label>Nome</label>
                                <input type="text" class="form-control" id="nome" name="nome"
                                    placeholder="Nome" required>
                                <div class="invalid-tooltip">
                                    Nome é obrigatório
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Atividade</label>
                                <select class="form-select-item select form-control" id="atividade" name="atividade" searchable="Search here.." required="true">
                                    <option value="">Selecione uma atividade</option>
                                    @foreach($activities as $item)
                                        <option value="{{ $item->id }}">{{ $item->nome }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-tooltip">
                                    Atividade é obrigatório
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Tipo</label>
                                <select class="form-select-item form-control" id="tipo" name="tipo" required="true">
                                    <option>Saída</option>
                                </select>
                                <div class="invalid-tooltip">
                                    O tipo é obrigatório
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-primary" type="submit">Salvar</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-item-modal" tabindex="-1" role="dialog" aria-labelledby="update-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-modal">Editar Centro de Custo</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="edit-form" class="needs-validation" method="POST" novalidate>
                    <div class="modal-body">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="validationTooltip01">Nome</label>
                                <input type="text" class="form-control" id="edit-nome" name="nome" placeholder="Nome" value="" required>
                                <div class="invalid-tooltip">
                                    Nome é obrigatório
                                </div>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Atividade</label>
                                <select class="form-control" id="edit-atividade" name="atividade">
                                    @foreach($activities as $item)
                                        <option value="{{ $item->id }}">{{ $item->nome }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>Tipo</label>
                                <select class="form-control" id="edit-tipo" name="tipo">
                                    <option value="Entrada">Entrada</option>
                                    <option value="Saída">Saída</option>
                                    <option value="Entrada/Saída">Entrada/Saída</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="js-edit-submit" class="btn btn-primary">Salvar</button>
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-aplicativo-layout>

<script type="text/javascript">
    $(document).ready(function() {
       

        $('.delete-row-js').on('click', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Você tem certeza?',
                text: "Você não será capaz de reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, remover!',
                cancelButtonText: "Cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).parent('td').parent('tr').hide();
                    $.ajax({
                        type: 'delete',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: $(this).data('route'),
                        data: {'_method': 'delete'},
                        success: (response, textStatus, xhr) => {
                            Swal.fire(
                                'Concluido!',
                                response,
                                'success'
                            )
                        },
                        error: (response) => {
                            console.log(response);
                            Swal.fire(
                                'Erro!',
                                response.responseJSON.message,
                                'error'
                            )
                        }
                    });
                }
            });
        });

        let editItemId = '';

        $('.edit-row-js').on('click', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'get',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: $(this).data('route'),
                success: (response, textStatus, xhr) => {
                    editItemId = response.id;
                    // debugger
                    $('#edit-nome').val(response.nome);
                    $('#edit-atividade').val(response.activity.id);
                    $('#edit-tipo').val(response.tipo);
                    $('#edit-form').attr('action', `centro-de-custo/${editItemId}`);

                    $('#edit-item-modal').modal('show');
                },
                error: (response) => {
                    console.log(response);
                    Swal.fire(
                        'Erro!',
                        response.responseJSON.message,
                        'error'
                    )
                }
            });
        });
    });
</script>
