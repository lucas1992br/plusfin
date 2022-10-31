
<x-aplicativo-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Aporte
        </h2>
    </x-slot>
    <!-- DataTales Example -->
    <p>
        <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
          Filtros <i class="fa fa-filter" aria-hidden="true"></i>
        </a>
    </p>
    <div class="collapse" id="collapseExample">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('aporte.index') }}" method="get">
                    @csrf
                    <div>
                        <div class="row">
                            <div class="col">
                                <label>Data Inicial</label>
                                <input type="date" name="data_inicial_search" class="form-control-sm form-control">
                            </div>
                            <div class="col">
                                <label>Data Final</label>
                                <input type="date" name="data_final_search" class="form-control-sm form-control">
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
      </div>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-end">
            <div class="card-header py-3 d-flex justify-content-end">
                <a class="btn-success p-2 rounded text-decoration-none mr-4 small" href="javascript:void(0)" data-toggle="modal"
                    data-target="#register-new-item-modal">
                    <i class="fa-plus-circle fas mr-2"></i>
                    Aporte
                </a>
            </div>
        </div>
        <div class="card-body">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            @component('components.dataTable',
                [
                    'headers' => ['Data', 'Conta', 'Fonte Pagante', 'Valor','Ações'],
                ])

                @slot('data')
                    @foreach ($methods ?? '' as $item)
                        <tr class="small">
                            <td title="{{ $item->data }}">{{ \Carbon\Carbon::parse($item->data)->format('d/m/Y')}}</td>
                            <td title="{{ $item->observacao }}">{{ $item->observacao }}</td>
                            <td title="{{ $item->payments_methods->nome }}">{{ $item->payments_methods->nome }}</td>
                            <td title="{{ $item->valor }}">{{ 'R$ '.number_format($item->valor, 2, ',', '.') }}</td>
                            <td title="Ações">
                                <a role="button" class="delete-row-js" data-route="{{route('aporte.destroy',$item->id)}}">
                                    <i class="fa fa-trash _i text-danger"></i>
                                </a>
                                <a role="button" class="edit-row-js" data-route="{{route('aporte.show', $item->id)}}">
                                    <i class="fa fa-edit _i text-navy"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    <tfoot class="small">
                        <td class="bg-light"></td>
                        <td class="bg-light"></td>
                        <td class="bg-light">Total</td>
                        <td class="bg-light">{{ 'R$ '.number_format($somatoria, 2, ',', '.') }}</td>
                        <td class="bg-light"></td>
                    </tfoot>
                @endslot

            @endcomponent
        </div>
    </div>
    <!-- Registro -->
    <div class="modal fade" id="register-new-item-modal" tabindex="-1" role="dialog" aria-labelledby="register-modal" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="register-modal">Adicionar Aporte</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('aporte.store') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-5">
                                    <label>Data</label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="date" name="data_aporte" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-5">
                                    <label>Forma de Pagamento</label>
                                </div>
                                <div class="col-sm-7">
                                    <select class="form-control form-control-sm" name="payments_methodcad">
                                        <option>Selecioone...</option>
                                        @foreach ( $payments_methodcad as $item )
                                            <option value="{{ $item->id }}">{{ $item->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-5">
                                    <label>Valor:</label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control form-control-sm" id="valor" name="valor">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-5">
                                    <label>Observação:</label>
                                </div>
                                <div class="col-sm-7">
                                    <textarea class="form-control form-control-sm" rows="4" name="observacao_aporte"></textarea>
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
    <!-- Editar -->
    <div class="modal fade" id="edit-item-modal" tabindex="-1" role="dialog" aria-labelledby="register-modal" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="register-modal">Adicionar Aporte</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form method="POST" action="{{ route('aporte.store') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-5">
                                    <label>Data</label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="date" name="data_aporte" class="form-control form-control-sm" id='edit_data'>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-5">
                                    <label>Forma de Pagamento</label>
                                </div>
                                <div class="col-sm-7">
                                    <select class="form-control form-control-sm" name="payments_methodcad" id="edit_payments_methods">
                                        <option>Selecioone...</option>
                                        @foreach ( $payments_methodcad as $item )
                                            <option value="{{ $item->id }}">{{ $item->nome}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-5">
                                    <label>Valor:</label>
                                </div>
                                <div class="col-sm-7">
                                    <input type="text" class="form-control form-control-sm" id="edit_valor" name="valor">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-sm-5">
                                    <label>Observação:</label>
                                </div>
                                <div class="col-sm-7">
                                    <textarea class="form-control form-control-sm" rows="4" name="observacao_aporte" id='edit_observacao_aporte'></textarea>
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
    <div>
               
    
    </div>
</x-aplicativo-layout>

<script type="text/javascript">
    $(document).ready(function() {
        $('#valor').mask('#.##0,00', {reverse: true});
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
                    $('#edit_data').val(response.data);               
                    $('#edit_payments_methods').val(response.payment_methods_id);
                    $('#edit_valor').val(response.valor);
                    $('#edit_observacao_aporte').val(response.observacao);
                    $('#edit-form').attr('action', `aporte/${editItemId}`);
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
