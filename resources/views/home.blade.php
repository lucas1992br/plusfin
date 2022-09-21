<?php
use App\Models\Output;
use App\Models\Input;
use Illuminate\Support\Facades\DB;
?>
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
                                <?php
                                $aprovPendente = [0,0,0]; //Vencidos,Hoje,Mês
                                $atualPendente = [0,0,0]; //Vencidos,Hoje,Mês
                                $docPendente = [0,0,0]; //Vencidos,Hoje,Mês
                                $pgPendente = [0,0,0]; //Vencidos,Hoje,Mês
                                $entadaPendente = [0,0,0]; //Vencidos,Hoje,Mês
                                $auditEntPendente = [0,0,0]; //Vencidos,Hoje,Mês
                                $auditSaidaPendente = [0,0,0]; //Vencidos,Hoje,Mês
                                ?>
                                @foreach($methods as $method)
                                    <?php
                                    $today = new \DateTime('now', new \DateTimeZone('America/Sao_Paulo'));                                
                                    $dateRegister = new \DateTime($method->data, new \DateTimeZone('America/Sao_Paulo'));                                    
                                    $diff = $today->diff($dateRegister);                                                                                   
                                    //Aprovação Pendente                                    
                                    if($method->status == 'Aprovação Pendente'){
                                        if($diff->invert == 1 && $diff->d > 0){                                            
                                            $aprovPendente[0]+=1;
                                        } 
                                        if($diff->days == 0){
                                            $aprovPendente[1]+=1;  
                                        }
                                         
                                        if($today->format('m/Y') == $dateRegister->format('m/Y')){
                                            $aprovPendente[2]+=1;
                                        }
                                        
                                    }   
                                    //Atualização Pendente                                    
                                    if($method->status == 'Atualização Pendente'){
                                        if($diff->invert == 1 && $diff->d > 0){                                            
                                            $atualPendente[0]+=1;
                                        } 
                                        if($diff->days == 0){
                                            $atualPendente[1]+=1;  
                                        }
                                        if($today->format('m/Y') == $dateRegister->format('m/Y')){
                                            $atualPendente[2]+=1;
                                        }                                           
                                    }
                                    //Envio de Documentos Pendente                                    
                                    if($method->status == 'Envio De Documentos Pendente'){
                                        if($diff->invert == 1 && $diff->d > 0){                                            
                                            $docPendente[0]+=1;
                                        } 
                                        if($diff->days == 0){
                                            $docPendente[1]+=1;  
                                        }
                                        if($today->format('m/Y') == $dateRegister->format('m/Y')){
                                            $docPendente[2]+=1;
                                        }                                           
                                    }
                                    //Pagamento Pendente                                    
                                    if($method->status == 'Pagamento Pendente'){
                                        if($diff->invert == 1 && $diff->d > 0){                                            
                                            $pgPendente[0]+=1;
                                        } 
                                        if($diff->days == 0){
                                            $pgPendente[1]+=1;  
                                        }
                                        if($today->format('m/Y') == $dateRegister->format('m/Y')){
                                            $pgPendente[2]+=1;
                                        }                                           
                                    }    
                                    //Entradas Pendentes                                    
                                    if($method->status == 'Entradas Pendentes'){
                                        if($diff->invert == 1 && $diff->d > 0){                                            
                                            $entadaPendente[0]+=1;
                                        } 
                                        if($diff->days == 0){
                                            $entadaPendente[1]+=1;  
                                        }
                                        if($today->format('m/Y') == $dateRegister->format('m/Y')){
                                            $entadaPendente[2]+=1;
                                        }                                           
                                    }                          
                                    ?>         
                                @endforeach   
                                    <tr>
                                        <th>Atualização Pendente</th>
                                        <td class="bg-danger text-light">{{$atualPendente[0]}}</td>
                                        <td class="bg-warning text-light">{{$atualPendente[1]}}</td>
                                        <td>0</td>
                                        <td>{{$atualPendente[2]}}</td>
                                    </tr>                             
                                    <tr>
                                        <th>Aprovação Pendente</th>
                                        <td class="bg-danger text-light">{{$aprovPendente[0]}}</td>
                                        <td class="bg-warning text-light">{{$aprovPendente[1]}}</td>
                                        <td>0</td>
                                        <td>{{$aprovPendente[2]}}</td>
                                    </tr>
                                    <tr>
                                        <th>Envio de Documentos Pendente</th>
                                        <td class="bg-danger text-light">{{$docPendente[0]}}</td>
                                        <td class="bg-warning text-light">{{$docPendente[1]}}</td>
                                        <td>0</td>
                                        <td>{{$docPendente[2]}}</td>
                                    </tr>
                                    <tr>
                                        <th>Pagamento Pendente</th>
                                        <td class="bg-danger text-light">{{$pgPendente[0]}}</td>
                                        <td class="bg-warning text-light">{{$pgPendente[1]}}</td>
                                        <td>0</td>
                                        <td>{{$pgPendente[2]}}</td>
                                    </tr>
                                    <tr>
                                        <th>Entradas Pendentes</th>
                                        <td class="bg-danger text-light">{{$entadaPendente[0]}}</td>
                                        <td class="bg-warning text-light">{{$entadaPendente[1]}}</td>
                                        <td>0</td>
                                        <td>{{$entadaPendente[2]}}</td>
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
                                    @php
                                    $input = Input::where('valor_payment', '>', 0)->get()->sum->valor_payment;
                                    $input2 = Output::where('payment_methods_id', '=', 	'1')->where('status', '=', 	'Paga')->get()->sum->valor;
                                    $dinheiro = $input - $input2;
                                    @endphp
                                    <td>{{ 'R$ '.number_format("$dinheiro",2,",",".") }}</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <th>Pix</th>
                                    @php
                                    $input = Input::where('valor_payment2', '>', 0)->get()->sum->valor_payment2;
                                    $input2 = Output::where('payment_methods_id', '=', 	'2')->where('status', '=', 	'Paga')->get()->sum->valor;
                                    $pix = $input - $input2;
                                    @endphp
                                    <td>{{ 'R$ '.number_format("$pix",2,",",".") }}</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <th>Cheque</th>
                                    @php
                                    $input = Input::where('valor_payment3', '>', 0)->get()->sum->valor_payment3;
                                    $input2 = Output::where('payment_methods_id', '=', 	'3')->where('status', '=', 	'Paga')->get()->sum->valor;
                                    $cheque = $input - $input2;
                                    @endphp                                     
                                    <td>{{ 'R$ '.number_format("$cheque",2,",",".") }}</td>
                                    <td>0</td>
                                    <td>0</td>
                                        
                                </tr>
                                <tr>
                                    <th>Cartão Debito</th>
                                    @php
                                    $input = Input::where('valor_payment4', '>', 0)->get()->sum->valor_payment4;
                                    $input2 = Output::where('payment_methods_id', '=', 	'4')->where('status', '=', 	'Paga')->get()->sum->valor;
                                    $debito = $input - $input2;
                                    @endphp
                                    <td>{{ 'R$ '.number_format("$debito",2,",",".") }}</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <th>Cartão Credito</th>
                                    @php
                                    $input = Input::where('valor_payment5', '>', 0)->get()->sum->valor_payment4;
                                    $input2 = Output::where('payment_methods_id', '=', 	'5')->where('status', '=', 	'Paga')->get()->sum->valor;
                                    $credito = $input - $input2;
                                    @endphp
                                    <td>{{ 'R$ '.number_format("$credito",2,",",".") }}</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <th>Cartão Recorrente</th>
                                    @php
                                    $input = Input::where('valor_payment6', '>', 0)->get()->sum->valor_payment5;
                                    $input2 = Output::where('payment_methods_id', '=', 	'7')->where('status', '=', 	'Paga')->get()->sum->valor;
                                    $recorrente = $input - $input2;
                                    @endphp
                                    <td>{{ 'R$ '.number_format("$recorrente",2,",",".") }}</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr> 
                                <tr>
                                    <th>Total</th>
                                    @php
                                   
                                    $total = $dinheiro + $pix + $cheque + $debito +  $credito + $recorrente
                                    @endphp                                  
                                    <td>{{ 'R$ '.number_format("$total",2,",",".") }}</td>                                    
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
    <!-- /.container-fluid -->
</x-aplicativo-layout>

<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>
