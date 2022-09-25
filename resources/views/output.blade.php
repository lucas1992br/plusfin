<x-aplicativo-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Saidas
        </h2>
    </x-slot>
    <!-- DataTales Example -->
    @component('components.search')
    @endcomponent
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
                    'headers' => ['Data', 'Conta', 'Origem', 'Fonte Pagante', 'Forma de Pagamento', 'Valor', 'Estagio', 'Ações'],
                ])

                @slot('data')
                    @foreach ($methods ?? '' as $item)
                        <tr>
                            <td title="{{ $item->data }}">{{ \Carbon\Carbon::parse($item->data)->format('d/m/Y')}}</td>
                            <td title="{{ $item->conta }}">{{ $item->conta }}</td>
                            <td title="{{ $item->origin->nome }}">{{ $item->origin->nome }}</td>
                            <td title="{{ $item->payings_sources->nome }}">{{ $item->payings_sources->nome }}</td>
                            <td title="{{ $item->payments_methods->nome }}">{{ $item->payments_methods->nome }}</td>
                            <td title="{{ $item->valor }}">{{ 'R$ '.number_format($item->valor, 2, ',', '.') }}</td>
                            @switch($item->status)
                                @case('Atualização Pendente')
                                    <td class="bg-warning text-white rounded align-middle">Atualização Pendente</td>
                                    @break
                                @case('Aprovação Pendente')
                                    <td class="bg-dark text-white rounded align-middle">Aprovação Pendente</td>
                                    @break
                                @case('Pagamento Pendente')
                                    <td class="bg-success text-white rounded align-middle">Pagamento Pendente</td>
                                    @break
                                @case('Envio De Documentos Pendente')
                                    <td class="bg-primary text-white rounded align-middle">Envio De Documentos Pendente</td>
                                    @break
                                @case('Paga')
                                    <td class="bg-primary text-white rounded align-middle">Paga</td>
                                    @break
                                @default

                            @endswitch
                            <td title="Ações">
                                <a role="button" class="delete-row-js" data-route="{{route('saidas.destroy',$item->id)}}">
                                    <i class="fa fa-trash _i text-danger"></i>
                                </a>                             
                                <a role="button" class="edit-row-js" data-route="{{route('saidas.show', $item->id)}}">
                                    <i class="fa fa-edit _i text-navy"></i>
                                </a>
                                @if (count($item->files) > 0)
                                    <a role="button" class="view-row-js" data-files="{{$item->files}}">
                                        <i class="fa fa-eye _i text-navy"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @endslot

            @endcomponent
        </div>
    </div>

    <div class="modal fade" id="register-new-item-modal" tabindex="-1" role="dialog" aria-labelledby="register-modal" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="register-modal">Cadastro Saidas</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('saidas.store') }}" class="needs-validation" novalidate>
                    <div class="modal-body">
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                         <label class="form-label">Fonte Pagante</label>
                                         <select class="form-select-item select form-control" name="paying_sources_id" searchable="Search here.." required="true">
                                            <option value="">Selecione uma Fonte Pagante</option>
                                            @foreach($payings_sources as $item)
                                                <option value="{{ $item->id }}">{{ $item->nome }}</option>
                                            @endforeach
                                        </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                        <label class="form-label">Forma Pagamento</label>
                                        <select class="form-select-item select form-control" name="payment_methods_id" searchable="Search here.." required="true">
                                            <option value="">Selecione uma Forma de Pagamento</option>
                                            @foreach($payments_methods as $item)
                                                <option value="{{ $item->id }}">{{ $item->nome }}</option>
                                            @endforeach
                                        </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                        <label class="form-label">Data:</label>
                                        <input type="date" class="form-control" name="data" row='3' required="true">
                            </div>
                            <div class="col-md-12 mb-3">
                                        <label class="form-label">Conta</label>
                                        <textarea class="form-control" name="conta" required="true"></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                         <label class="form-label">Origem</label>
                                         <select class="form-select-item select form-control" name="origin_id" searchable="Search here.." required="true">
                                            <option value="">Selecione uma Origem</option>
                                            @foreach($origins as $item)
                                                <option value="{{ $item->id }}">{{ $item->nome }}</option>
                                            @endforeach
                                        </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                        <label class="form-label" for="valor">Valor:</label>
                                        <input type="text" id="valor" name="valor" class="valor form-control" style="display:inline-block" required="true"/>
                            </div>

                            <div class="col-md-12 mb-3">
                                         <label class="form-label" required="true">Atualizada</label>
                                         <select class="form-select-item select form-control" name="status">
                                            <option value="Aprovação Pendente">Sim</option>
                                            <option value="Atualização Pendente">Não</option>
                                          </select>
                            </div>

                            <div class="col-md-12 mb-3" style="display: none">
                              <label class="form-label" >Observação - Gestor</label>
                              <textarea class="form-control" name="observacao"></textarea>
                            </div>

                            <div class="col-md-12 mb-3" style="display: none">
                              <label class="form-label" >Observação Auditoria</label>
                              <textarea class="form-control" name="observacao_atuditoria"></textarea>
                            </div>

                            <div class="col-md-12 mb-3" style="display: none">
                              <label class="form-label">Observação - Administrativo</label>
                              <textarea class="form-control" name="observacao2"></textarea>
                            </div>

                            <div class="col-md-12 mb-3" style="display: none">
                                <label class="form-label">Observação Auditoria</label>
                                <textarea class="form-control" name="observacao_atuditoria2"></textarea>
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
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-modal">Editar saidas</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="edit-form" class="needs-validation" method="POST" novalidate>
                    <div class="modal-body">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                         <label class="form-label">Fonte Pagante</label>
                                         <select class="form-select-item select form-control" id="edit-paying_sources_id" name="paying_sources_id" searchable="Search here.." required="true">
                                            <option value="">Selecione uma Fonte Pagante</option>
                                            @foreach($payings_sources as $item)
                                                <option value="{{ $item->id }}">{{ $item->nome }}</option>
                                            @endforeach
                                        </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                        <label class="form-label">Forma Pagamento</label>
                                        <select class="form-select-item select form-control" id="edit-payment_methods_id" name="payment_methods_id" searchable="Search here.." required="true">
                                            <option value="">Selecione uma Forma de Pagamento</option>
                                            @foreach($payments_methods as $item)
                                                <option value="{{ $item->id }}">{{ $item->nome }}</option>
                                            @endforeach
                                        </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                        <label class="form-label" required="true">Data:</label>
                                        <input type="date" class="form-control" id="edit-data" name="data" row='3'>
                            </div>
                            <div class="col-md-12 mb-3">
                                        <label class="form-label">Conta</label>
                                        <textarea class="form-control" id="edit-conta" name="conta"></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                         <label class="form-label">Origem</label>
                                         <select class="form-select-item select form-control" id="edit-origin_id" name="origin_id" searchable="Search here.." required="true">
                                            <option value="">Selecione uma Origem</option>
                                            @foreach($origins as $item)
                                                <option value="{{ $item->id }}">{{ $item->nome }}</option>
                                            @endforeach
                                        </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                        <label class="form-label" for="dinheiro" required="true">Valor:</label>
                                        <input type="number" id="edit-valor" name="valor" class="dinheiro form-control" style="display:inline-block" />
                            </div>

                            <div class="col-md-12 mb-3">
                                         <label class="form-label">Estagio</label>
                                         <select class="form-select-item select form-control" name="status" searchable="Search here.." id="edit-status">
                                            @foreach($methods ?? '' as $item)
                                                <option value="{{ $item->status }}">{{ $item->status }}</option>
                                            @endforeach
                                          </select>
                            </div>

                            <div class="col-md-12 mb-3">
                              <label class="form-label">Observação - Gestor</label>
                              <textarea class="form-control" id="edit-observacao" name="observacao"></textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                              <label class="form-label" >Observação - Administrativo</label>
                              <textarea class="form-control" id="edit-observacao2" name="observacao2"></textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Observação Auditoria</label>
                                <textarea class="form-control" id="edit-observacao_atuditoria" name="observacao_atuditoria"></textarea>
                              </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Observação Auditoria</label>
                                <textarea class="form-control" id="edit-observacao_atuditoria2" name="observacao_atuditoria2"></textarea>
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

    <div class="modal fade" id="view-files-modal" aria-labelledby="view-modal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Arquivos</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <ul id="files-list-js" class="list-group">

                </ul>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

</x-aplicativo-layout>

<script type="text/javascript">
    $(document).ready(function() {
      $('#valor').mask('#.##0,00', {reverse: true});
        /*$('#table').DataTable({
            pageLength: 25,
            responsive: true,
            dom: 'lTf<"row-datatable-user"ip>',
            processing: true,
            columnDefs: [{
                    targets: [],
                    render: function(data, type, row) {
                        return data.length > 25 ? data.substr(0, 25) + '…' : data;
                    }
                },
                {
                    targets: [],
                    orderable: true,
                }
            ],

            oLanguage: {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                },
                "select": {
                    "rows": {
                        "_": "Selecionado %d linhas",
                        "0": "Nenhuma linha selecionada",
                        "1": "Selecionado 1 linha"
                    }
                }
            }
        });
        */
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
                    $('#edit-status').val(response.status);
                    $('#edit-data').val(response.data);
                    $('#edit-conta').val(response.conta);
                    $('#edit-observacao').val(response.observacao);
                    $('#edit-observacao_atuditoria').val(response.observacao_atuditoria);
                    $('#edit-observacao2').val(response.observacao2);
                    $('#edit-valor').val(response.valor);
                    $('#edit-paying_sources_id').val(response.paying_sources_id);
                    $('#edit-payment_methods_id').val(response.payment_methods_id);
                    $('#edit-origin_id').val(response.payment_methods_id);
                    $('#edit-form').attr('action', `saidas/${editItemId}`);

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

        $('.view-row-js').on('click', function(e) {
            e.preventDefault();
            var files = $(this).data('files');

            var arquivos = files.map(function(item){
                return `<li class="list-group-item"><a target="_blank" href="${item.path}">${item.name}</a></li>`
            });

            document.querySelector("#files-list-js").innerHTML = arquivos.join("");

            $('#view-files-modal').modal('show');
        });
    });
</script>
