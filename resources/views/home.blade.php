<x-aplicativo-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Portal') }}
        </h2>
    </x-slot>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-6 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pendências</h6>
                </div>
                <div class="card-body">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                   
                    <div class="table-responsive table-sm">
                        
                        <table id="table" class="table table-sm table-striped table-bordered table-hover" width="100%" cellspacing="0">
                            
                            <thead>
                                <tr>
                                    <th>Estagios</th>
                                    <th class="bg-danger text-light">Vencidos</th>
                                    <th class="bg-warning text-light">Hoje</th>
                                    <th>Periodo</th>
                                    <th>Mês</th>                                 
                                </tr>
                            </thead>
                            <tbody>                               
                                <tr>
                                    <th>Atualização Pendente</th>
                                    <td class="bg-danger text-light">0</td>
                                    <td class="bg-warning text-light">0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <th>Aprovação Pendente</th>
                                    <td class="bg-danger text-light">0</td>
                                    <td class="bg-warning text-light">0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <th>Envio de Documentos Pendente</th>
                                    <td class="bg-danger text-light">0</td>
                                    <td class="bg-warning text-light">0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <th>Pagamento Pendente</th>
                                    <td class="bg-danger text-light">0</td>
                                    <td class="bg-warning text-light">0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <th>Entradas Pendentes</th>
                                    <td class="bg-danger text-light">0</td>
                                    <td class="bg-warning text-light">0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <th>Auditorias Entrada Pendentes</th>
                                    <td class="bg-danger text-light">0</td>
                                    <td class="bg-warning text-light">0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr> 
                                <tr>
                                    <th>Auditorias Saida Pendentes</th>
                                    <td class="bg-danger text-light">0</td>
                                    <td class="bg-warning text-light">0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>                           
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-6 mb-4">

            <!-- Illustrations -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recebimentos</h6>
                </div>
                <div class="card-body">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    
                    <div class="table-responsive table-sm">
                        
                        <table id="table" class="table table-sm table-striped table-bordered table-hover" width="100%" cellspacing="0">
                            
                            <thead>
                                <tr>
                                    <th>Formas de Recebimento</th>
                                    <th>Valor</th>
                                    <th>Aporte</th>
                                    <th>Retirada</th>                                  
                                </tr>
                            </thead>
                            <tbody>                               
                                <tr>
                                    <th>Dinheiro</th>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <th>Pix</th>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <th>Cheque</th>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <th>Cartão Debito</th>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <th>Cartão Credito</th>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <th>Cartão Recorrente</th>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr> 
                                <tr>
                                    <th>Total</th>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>                           
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary text-center">Lista de Saidas Pendentes para Hoje</h6>
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

        </div>
    </div>
    <!-- /.container-fluid -->
</x-aplicativo-layout>

<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>
