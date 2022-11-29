
<x-aplicativo-layout>
    <p>
        <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
          Filtros <i class="fa fa-filter" aria-hidden="true"></i>
        </a>
    </p>
    <div class="collapse" id="collapseExample">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('relatorio-medias_entradas.index') }}" method="get">
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
                                <label>Contas Pagas</label>
                                <select class="form-control-sm form-control" name="contas_pagas">
                                    <option value="Pendente">Não</option>
                                    <option value="Paga">Sim</option>
                                    <option value="">Todas</option>
                                </select>
                            </div>
                            <div class="col">
                                <label>Entradas Efetivadas</label>
                                <select class="form-control-sm form-control" name="entradas_efetivadas">
                                    <option>Não</option>
                                    <option value="sim">Sim</option>
                                    <option value="todas">Todas</option>
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
      </div>
    
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-end">
            <div class="py-3 d-flex justify-content-end">
                <a class="btn-success p-2 rounded text-decoration-none mr-4 small" href="javascript:void(0)" data-toggle="modal"
                    data-target="#register-new-item-modal">
                    <i class="fa-plus-circle fas mr-2"></i>
                    Exportar
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-6">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    @component('components.dataTable',
                        [
                            'headers' => ['Data', 'Conta', 'Origem', 'Fonte Pagante', 'Forma de Pagamento', 'Valor', 'status']
                        ])
    
                        @slot('data')
                            @csrf
                            @foreach ($methods ?? '' as $item)
                                <tr>
                                    <td title="{{ $item->data }}"><small>{{ \Carbon\Carbon::parse($item->data)->format('d/m/Y')}}</small></td>
                                    <td title="{{ $item->conta }}"><small>{{ $item->conta }}</small></td>
                                    <td title="{{ $item->origin->nome }}"><small>{{ $item->origin->nome }}</small></td>
                                    <td title="{{ $item->payings_sources->nome }}"><small>{{ $item->payings_sources->nome }}</small></td>
                                    <td title="{{ $item->payments_methods->nome }}"><small>{{ $item->payments_methods->nome }}</small></td>
                                    <td title="{{ $item->valor }}"><small>{{ 'R$ '.number_format($item->valor, 2, ',', '.') }}</small></td> 
                                    @switch($item->status)
                                    @case('Atualização Pendente')
                                        <td title="{{$item->status}}"><small class="badge bg-warning text-white rounded align-middle">{{$item->status}}</small></td>
                                        @break
                                    @case('Aprovação Pendente')
                                        <td title="{{$item->status}}"><small class="badge bg-dark text-white rounded align-middle">{{$item->status}}</small></td>
                                        @break
                                    @case('Pagamento Pendente')
                                        <td title="{{$item->status}}"><small class="badge bg-success text-white rounded align-middle">{{$item->status}}</small></td>
                                        @break
                                    @case('Envio De Documentos Pendente')
                                        <td title="{{$item->status}}"><small class="badge bg-primary text-white rounded align-middle">{{$item->status}}</small></td>
                                        @break
                                    @case('Paga')                              
                                        <td title="{{$item->status}}"><small class="badge bg-primary text-white">{{$item->status}}</small></td>
                                        @break
                                    @default
    
                                @endswitch                           
                                </tr>
                            @endforeach
                        @endslot               
                    @endcomponent
                </div>
                <div class="col-sm-6">
                    <div class="row">
                        <div class="col-sm-6 order-1 order-sm-1">
                            <table class="table table-sm table-bordered">
                                <tbody>
                                    <th scope="col">Fonte Pagante</th>
                                    <th scope="col">Valor R$</th>   
                                    @foreach ($fontePagante as $key)
                                        <tr>
                                            <td title="">{{$key->payings_sources->nome}}</td>
                                            <td title="">{{ 'R$ '.number_format($key->Total, 2, ',', '.') }}</td>
                                        </tr>
                                    @endforeach                        
                                    
                                    
                                </tbody>
                            </table>                                          
                        </div>
                        <div class="col-sm-6 order-3 order-sm-3">
                            <table class="table table-sm table-bordered">
                                <tbody>
                                    <th>Levantamentos</th>
                                    <th>Valor R$</th>                           
                                    <tr>
                                        <td title="">Saldo Caixa $</td>
                                        <td title="">R$ 00</td>
                                    </tr>
                                    <tr>
                                        <td title="">Saldo Caixa Cheque a Vista</td>
                                        <td title="">R$ 00</td>
                                    </tr>
                                    <tr>
                                        <td title="">Total Saldo Caixa</td>
                                        <td title="">R$ 00</td>
                                    </tr>
                                    <tr>
                                        <td title="">Contas a Pagar $</td>
                                        <td title="">R$ 00</td>
                                    </tr>
                                    <tr>
                                        <td title="">Contas a Pagar em Cheque a Vista</td>
                                        <td title="">R$ 00</td>
                                    </tr>
                                    <tr>
                                        @php
                                            $media = ($sumOrigin[10] + $sumOrigin[9] + $sumOrigin[8]) / 3;
                                        @endphp
                                        <td title="">Menor Valor da Media</td>
                                        <td title="">{{ 'R$ '.number_format(($media), 2, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <td title="">Saldo Previsto Final</td>
                                        <td title="">R$ 00</td>
                                    </tr>
                                </tbody>
                            </table>                                          
                        </div>
                        <div class="col-sm-6 order-2 order-sm-2">
                            <table class="table table-sm table-bordered">
                                <tbody>
                                    <th>Media</th>
                                    <th>Valor R$</th>                           
                                    <tr>
                                        @php
                                            $media = ($sumOrigin[10] + $sumOrigin[9] + $sumOrigin[8]) / 3;
                                        @endphp
                                        <td title="">Menor Valor da Media</td>
                                        <td title="">{{ 'R$ '.number_format(($media), 2, ',', '.') }}</td>
                                        
                                    </tr>
                                    <tr>
                                        <td title="">1 Mês Atras</td>
                                        <th>{{ 'R$ '.number_format(($sumOrigin[10]), 2, ',', '.') }}</th>
                                    </tr>
                                    <tr>
                                        <td title="">2 Mês Atras</td>
                                        <th>{{ 'R$ '.number_format(($sumOrigin[9]), 2, ',', '.') }}</th>                                       
                                    </tr>
                                    <tr>
                                        <td title="">3 Mês Atras</td>
                                        <th>{{ 'R$ '.number_format(($sumOrigin[8]), 2, ',', '.') }}</th>
                                    </tr>
                                </tbody>
                            </table>                                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
