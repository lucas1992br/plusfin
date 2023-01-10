
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Entrada</h1>
@stop

@section('content')
<style>
    .btn-label {
        position: relative;
        left: -12px;
        display: inline-block;
        padding: 6px 12px;
        background: rgba(0, 0, 0, 0.15);
        border-radius: 3px 0 0 3px;
    }

    .btn-labeled {
        padding-top: 0;
        padding-bottom: 0;
    }

    .btn {
        margin-bottom: 10px;
    }
</style>

<p>
    <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#filtro" role="button" aria-expanded="false" aria-controls="filtro">
      Filtros <i class="fa fa-filter" aria-hidden="true"></i>
    </a>
</p>
<div class="collapse" id="filtro">
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('entradas.index') }}" method="get">
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
        <a class="btn-success p-2 rounded text-decoration-none small mr-4" id="newInput" href="javascript:void(0)"
           data-toggle="modal"
            data-target="#register-new-item-modal">
            <i class="fa-plus-circle fas mr-2"></i>
            Entrada
        </a>
        <!--<a class="btn-success p-2 rounded text-decoration-none small mr-4" href="javascript:void(0)" data-toggle="modal"
            data-target="#register-bank-item-modal">
            <i class="fa-plus-circle fas mr-2"></i>
            Entrada Banco
        </a>-->
    </div>
    <div class="card-body" >
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <div class="table-responsive">
            <table id="table" class="table table-sm table-striped table-bordered" width="100%" cellspacing="0">

                <thead>
                    <tr class="">
                        Entradas
                    </tr>
                </thead>
                @if(count($methods)>0)
                <tbody>
                <tr style="text-align: center;background-color: #98C4CF">
                    <th rowspan="">Data Entrada</th>
                    <th colspan="{{count($origins)}}">Origens</th>
                    <th colspan="{{count($payments_methods)+1}}">Forma de Pagamentos</th>
                    <th colspan="2">Ações</th>
                </tr>

                <?php
                $arrayOrigem =array();
                $totalValue=0;
                $arrayPagamentos =array();
                $totalAll=0;
                ?>


                @foreach($methods as $input)

                <tr style="text-align: center;background-color: #98C4CF">
                    <th rowspan="2">{{date_format(new DateTime($input->data),'d/m/Y')}}</th>
                    @foreach($origins as $origem)
                        <th>{{$origem->nome}}</th>
                    @endforeach
                    @foreach($payments_methods as $pagamentos)
                        <th>{{$pagamentos->nome}}</th>
                    @endforeach
                    <th>Total</th>
                    <td rowspan="2"><i onclick="editInput({{$input->id}})"><svg xmlns="http://www.w3.org/2000/svg"
                                                                             width="16"
                                                               height="16"
                                             fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                            </svg></i></td>
                    <td rowspan="2"><i onclick="deleteInput({{$input->id}})"><svg xmlns="http://www.w3.org/2000/svg"
                                                                             width="16" height="16"
                                              fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                            </svg></i></td>
                </tr>

                <tr style="text-align: center">
                    @foreach($origins as $index => $origem)
                        <?php
                            if(!isset($arrayOrigem[$index])){
                                $arrayOrigem[$index]=0;
                            }
                            $valorOrigem=$input->originById($origem->id);
                            $arrayOrigem[$index]+=$valorOrigem;

                        ?>
                        <td>R$ {{number_format($valorOrigem,2)}}</td>

                    @endforeach
                    @foreach($payments_methods as $index => $pagamentos)
                                <?php
                                if(!isset($arrayPagamentos[$index])){
                                    $arrayPagamentos[$index]=0;
                                }
                                $valorPagamentos=$input->paymentsById($pagamentos->id);
                                $arrayPagamentos[$index]+=$valorPagamentos;
                                ?>
                        <td>R$ {{number_format($valorPagamentos,2)}}</td>
                    @endforeach
                        <td>R$ {{number_format($input->totalValue(),2)}}</td>
                </tr>
                    <?php
                      $totalAll+=number_format($input->totalValue(),2);
                    ?>
                    @endforeach

                <tr style="text-align: center;background-color: #98C4CF">
                    <th>Total</th>
                    @foreach($arrayOrigem as $index => $origemValue)
                        <th>R$ {{number_format($origemValue,2)}}</th>
                    @endforeach
                    @foreach($arrayPagamentos as $index => $pagamentosValue)
                        <th>R$ {{number_format($pagamentosValue,2)}}</th>
                    @endforeach
                    <th>R$ {{number_format($totalAll,2)}}</th>
                </tr>
                </tbody>
                @else
                    <div class="col-sm-12 alert alert-secondary" >Nenhuma entrada existente</div>
                @endif
            </table>
        </div>

    </div>
</div>

<div class="modal fade" id="register-new-item-modal" tabindex="-1" role="dialog" aria-labelledby="register-modal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="register-modal">Cadastro Entradas</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
                <div class="modal-body">

                    <div class="container">
                    <form method="POST" action="" id="testForm" class="needs-validation" novalidate>
                        @csrf
                        <div class="col-sm mb-3">
                            {{--                            <form method="POST" action="{{ route('entradas.store') }}" class="needs-validation" novalidate>--}}
{{--                            <form>--}}
{{--                                @csrf--}}
                                <label class="form-label">Data:</label>
                                <input type="date" class="form-control form-control-sm" name="data" id="data" row='3' required="true">
                                {{--                                <button class='btn btn-sm mt-2 btn-success d-flex' id='btnCriarEntrada'>Criar Entrada</button>--}}
{{--                            </form>--}}
                        </div>
                        <hr>
                        <div class='mt-6' id='entradas-detalhes'>
                            <div class="form-row col-sm">
                                <input type="hidden" name='idEntrada' id='idEntrada'>
                                <div class="col-sm-8">
                                    <label class="form-label">Origens:</label>
                                    <select class="select-origin form-select-item select form-control form-control-sm"
                                            name="origins[0]" id="origin_id" searchable="Search here.." required="true">
                                        <option value="">Selecione uma Origem</option>
                                        @foreach($origins as $item)
                                            <option value="{{ $item->id }}">{{ $item->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm">
                                    <label class="form-label" for="valor">Valor:</label>
                                    <input type="text" id="valor_origin" name="origin_valor[0]" class="valor valor_origin
                                    form-control-sm
                                    form-control o1" style="display:inline-block" onblur="SomatoriaOrigens()">
                                </div>
                            </div>
                            <div class="form-row col-sm mt-2">
                                <div class="col-sm-8">
                                    <label class="form-label">Forma de Recebimento:</label>
                                    <select class="select-pagamento form-select-item select form-control
                                    form-control-sm"
                                            name="payment_methods[0]"  id="payment_methods_id" searchable="Search here
                                            .." required="true">
                                        <option value="">Selecione um recebimento</option>
                                        @foreach($payments_methods as $item)
                                            <option value="{{ $item->id }}">{{ $item->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm">
                                    <label class="form-label" for="valor">Valor:</label>
                                    <input type="text" id="valor_pagamento" name="payment_valor[0]" class="valor
                                    valor_pagamento
                                    form-control-sm
                                     form-control o1" style="display:inline-block" onblur="SomatoriaOrigens()">
                                </div>
                            </div>
                        </div>
                        <div class='' id='entradas-detalhes-add'>
                        </div>
                        <div class="modal-footer">
                            <div class="col-sm-12" style="display: block"
                                 role="alert"><label>Total Origens: </label><span id="total-value-origin-add">
                                </span></div>
                            <div class="col-sm-12" style="display: block"
                                 role="alert"><label>Total Recebimentos: </label><span id="total-value-payment-add">
                                </span></div>
                            <div class="col-sm-12 alert alert-danger" id="empty-inputs" style="display: none"
                                 role="alert"><svg style="padding-right: 5px" xmlns="http://www.w3.org/2000/svg"
                                                   width="16"
                                                   height="16"
                                                   fill="currentColor" class="bi bi-info-square-fill" viewBox="0 0 16 16">
                                    <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.93 4.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                </svg>Preencha todos os campos para prosseguir.<button
                                        id="close-alert-inputs"
                               type="button" class="close close-alert-inputs" aria-label="Close">                      <span
                                        aria-hidden="true">&times;</span>
                                </button></div>

                            <div class="col-sm-12 alert alert-danger" id="differ-values" style="display: none"
                                 role="alert"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-square-fill" viewBox="0 0 16 16">
                                    <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.93 4.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                </svg> Existem valores diferentes. (Origem e Pagamento) <button id="close-alert-value"
                                                                                     type="button"
                                                                           class="close close-alert-inputs" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button></div>
                            <button type="button" id="addNewLines" class="btn btn-labeled btn-success">
                                    <span class="btn-label"><i class="fa fa-plus">
                                        </i></span>Origem/Recebimento</button>
                            <button class="btn btn-primary" id='btnSalvarDetalhes' type="submit">Salvar</button>
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>

                        </div>
                    </form>


                    </div>
                </div>
        </div>
    </div>
</div>
<!-- Modal Editar -->
<div class="modal fade" id="edit-item-modal" tabindex="-1" role="dialog" aria-labelledby="register-modal" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="register-modal">Editar Entrada</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="edit-form" class="needs-validation" method="POST" novalidate>
                <div class="modal-body">
                    @csrf
                    <div class="edit-container-inputs-data">
                        <input type="date" class="form-control form-control-sm" name="data-update" id="data-update" row='3'
                               required="true">
                        <input type="number"  name="contadorOrigins" id="contadorUpdate" hidden>
                        <input type="text"  name="id_input_update" id="id_input_update" hidden>
                    </div>
                    <div class="edit-container-inputs">
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-sm-12" style="display: block"
                         role="alert"><label>Total Origens: </label><span id="total-value-origin-update">
                                </span></div>
                    <div class="col-sm-12" style="display: block"
                         role="alert"><label>Total Recebimentos: </label><span id="total-value-payment-update">
                                </span></div>
                    <div class="col-sm-12 alert alert-danger" id="empty-inputs-update" style="display: none"
                         role="alert"><svg style="padding-right: 5px" xmlns="http://www.w3.org/2000/svg"
                                           width="16"
                                           height="16"
                                           fill="currentColor" class="bi bi-info-square-fill" viewBox="0 0 16 16">
                            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.93 4.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                        </svg>Preencha todos os campos para prosseguir.<button
                            id="close-alert-inputs"
                            type="button" class="close close-alert-inputs" aria-label="Close">                      <span
                                aria-hidden="true">&times;</span>
                        </button></div>

                    <div class="col-sm-12 alert alert-danger" id="differ-values-update" style="display: none"
                         role="alert"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-square-fill" viewBox="0 0 16 16">
                            <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.93 4.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                        </svg> Existem valores diferentes. (Origem e Pagamento) <button id="close-alert-value"
                                                                                        type="button"
                                                                                        class="close close-alert-value"
                                                                                        aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button></div>
                    <button type="button" id="addNewLinesUpdate" class="btn btn-labeled btn-success">
                                    <span class="btn-label"><i class="fa fa-plus">
                                        </i></span>Origem/Recebimento</button>
                    <button class="btn btn-primary" id="btnUpdate" type="submit">Salvar</button>
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Visualização de arquivos -->
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

@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/jquery-easing/jquery.easing.min.js"></script>
<script src="js/chart.js/Chart.min.js"></script>
<script src="js/jquery/jquery.min.js"></script>
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
<script src="js/bootstrap/js/bootstrap.bundle.min.js"></script>






<script>

    let contadorOrigens=0;
    function SomatoriaOrigens(){
        var contadorOriginValue=0;
        var contadorPaymentValue=0;
        $('.valor_origin').each(function (){
            var value=0;
            if($(this).val()!=''){
                if(Number.isInteger(+$(this).val())){
                    contadorOriginValue=contadorOriginValue+(+$(this).val()*100)
                }else{
                    value=$(this).val().replace(',', '');
                    value=value.replace('.', '');
                    contadorOriginValue=contadorOriginValue+parseInt(value);
                }
            }
        });

        $('.valor_pagamento').each(function (){
            var value=0;
                if($(this).val()!=''){
                    if(Number.isInteger(+$(this).val())){
                        console.log('é inteiro');
                        contadorPaymentValue=contadorPaymentValue+($(this).val()*100)
                    }else{
                        value=$(this).val().replace(',', '');
                        value=value.replace('.', '');
                        contadorPaymentValue=contadorPaymentValue+parseInt(value);
                    }
            }
        });


        console.log((contadorOriginValue/100));
        console.log((contadorPaymentValue/100));
        $("#total-value-origin-add").html(' R$ '+(contadorOriginValue/100).toFixed(2));
        // $("#total-value-origin-add").mask('R$ 000.000.000.000.000,00', {reverse: true});
        $("#total-value-payment-add").html(' R$ '+(contadorPaymentValue/100).toFixed(2));
        // $("#total-value-payment-add").mask('R$ 000.000.000.000.000,00', {reverse: true});
    }

    function SomatoriaOrigensUpdate(){

        var contadorOriginValue=0;
        var contadorPaymentValue=0;
        $('.valor_origin_update').each(function (){
            var value=0;
            if($(this).val()!=''){
                if(Number.isInteger(+$(this).val())){
                    contadorOriginValue=contadorOriginValue+(+$(this).val()*100)
                }else{
                    value=$(this).val().replace(',', '');
                    value=value.replace('.', '');
                    contadorOriginValue=contadorOriginValue+parseInt(value);
                }
            }
        });

        $('.valor_pagamento_update').each(function (){
            var value=0;
            if($(this).val()!=''){
                if(Number.isInteger(+$(this).val())){
                    console.log('é inteiro');
                    contadorPaymentValue=contadorPaymentValue+($(this).val()*100)
                }else{
                    value=$(this).val().replace(',', '');
                    value=value.replace('.', '');
                    contadorPaymentValue=contadorPaymentValue+parseInt(value);
                }
            }
        });


        console.log((contadorOriginValue/100));
        console.log((contadorPaymentValue/100));
        $("#total-value-origin-update").html(' R$ '+(contadorOriginValue/100).toFixed(2));
        // $("#total-value-origin-add").mask('R$ 000.000.000.000.000,00', {reverse: true});
        $("#total-value-payment-update").html(' R$ '+(contadorPaymentValue/100).toFixed(2));
        // $("#total-value-payment-add").mask('R$ 000.000.000.000.000,00', {reverse: true});
    }

    //Cria os detalhes da entrada [InputController::detalhes]
    let btnSalvarDetalhes = document.querySelector('#btnSalvarDetalhes');


    btnSalvarDetalhes.addEventListener('click',async(e)=>{
        e.preventDefault();

        var flagValidate=true;
        var flagValidateValue=true;
        var contadorOriginValue=0;
        var contadorPagamentoValue=0;
        var value=0;


        $('.valor_origin').each(function (){
            if($(this).val()!=''){
                value=$(this).val().replace(',', '');
                value=value.replace('.', '');
                contadorOriginValue+=parseInt(value);
            }

        });

        $('.valor_pagamento').each(function (){
            if($(this).val()!=''){
                value=$(this).val().replace(',', '');
                value=value.replace('.', '');
                contadorPagamentoValue+=parseInt(value);
            }
        });

        $('.valor_origin').each(function() {

            console.log($(this).val());
            if(!$(this).val()){
                flagValidate=false;
                $(this).css("borderColor","red");
            }else{
                $(this).css("borderColor","");
            }
        });


        $('#data').each(function() {

            console.log($(this).val());
            if(!$(this).val()){
                flagValidate=false;
                $(this).css("borderColor","red");
            }else{
                $(this).css("borderColor","");
            }
        });

        $('.valor_pagamento').each(function() {

            console.log($(this).val());
            if(!$(this).val()){
                flagValidate=false;
                $(this).css("borderColor","red");
            }else{
                $(this).css("borderColor","");
            }
        });

        $('.select-pagamento').each(function() {
            console.log($(this).val());
            if(!$(this).val()){
                flagValidate=false;
                $(this).css("borderColor","red");
            }else{
                $(this).css("borderColor","");
            }
        });

        $('.select-origin').each(function() {
            console.log($(this).val());
            if(!$(this).val()){
                flagValidate=false;
                $(this).css("borderColor","red");
            }else{
                $(this).css("borderColor","");
            }
        });


        if(contadorPagamentoValue!=contadorOriginValue){
            console.log('diferente');
            console.log('ContadorOrigin'+contadorOriginValue);
            console.log('ContadorPagamento'+contadorPagamentoValue);
            flagValidateValue=false;
        }else{
            console.log('N diferente');
        }

        if(flagValidate==true){
            $("#empty-inputs").hide();
            if(flagValidateValue==false){

                $("#differ-values").show();
                return;
            }else{
                $.ajax({
                    type: "POST",
                    url: "entrada/detalhes",
                    data:  $("#testForm").serialize(),
                    dataType: "json",
                    encode: true,
                }).done(function (data) {
                    Swal.fire(
                        'Sucesso!',
                        data.msg,
                        'success'
                    ).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if(result.isConfirmed){
                            location.reload();
                        }else if(result.isDismissed){
                            location.reload();
                        }
                    })
                }).fail(function (data) {
                    Swal.fire(
                        'Houve um erro para dar entrada.',
                        'Entre em contato com nosso suporte.',
                        'error'
                    )
                });
            }

        }else{
            $("#empty-inputs").show();
            return;
        }





    });

    //Cria os detalhes da alteracao da entrada
    let btnUpdate = document.querySelector('#btnUpdate');


    btnUpdate.addEventListener('click',async(e)=>{
        e.preventDefault();

        var flagValidate=true;
        var flagValidateValue=true;
        var contadorOriginValue=0;
        var contadorPagamentoValue=0;
        var value=0;


        $('.valor_origin_update').each(function (){
            console.log('passou aqui origin valor:'+$(this).val());
            if($(this).val()!=''){
                value=$(this).val().replace(',', '');
                value=value.replace('.', '');
                contadorOriginValue+=parseInt(value);
            }

        });

        $('.valor_pagamento_update').each(function (){
            console.log('passou aqui pagamento valor:'+$(this).val());
            if($(this).val()!=''){
                value=$(this).val().replace(',', '');
                value=value.replace('.', '');
                contadorPagamentoValue+=parseInt(value);
            }
        });

        $('.valor_origin_update').each(function() {
            if(!$(this).val()){
                flagValidate=false;
                $(this).css("borderColor","red");
            }else{
                $(this).css("borderColor","");
            }
        });


        $('#data-update').each(function() {
            if(!$(this).val()){
                flagValidate=false;
                $(this).css("borderColor","red");
            }else{
                $(this).css("borderColor","");
            }
        });

        $('.valor_pagamento_update').each(function() {
            if(!$(this).val()){
                flagValidate=false;
                $(this).css("borderColor","red");
            }else{
                $(this).css("borderColor","");
            }
        });

        $('.select-pagamento-update').each(function() {
            if(!$(this).val()){
                flagValidate=false;
                $(this).css("borderColor","red");
            }else{
                $(this).css("borderColor","");
            }
        });

        $('.select-origin-update').each(function() {
            if(!$(this).val()){
                flagValidate=false;
                $(this).css("borderColor","red");
            }else{
                $(this).css("borderColor","");
            }
        });


        if(contadorPagamentoValue!=contadorOriginValue){
            flagValidateValue=false;
        }else{
            console.log('N diferente');
        }

        if(flagValidate==true){
            $("#empty-inputs-update").hide();
            if(flagValidateValue==false){

                $("#differ-values-update").show();
                return;
            }else{
                $.ajax({
                    type: "POST",
                    url: "entrada/update",
                    data:  $("#edit-form").serialize(),
                    dataType: "json",
                    encode: true,
                }).done(function (data) {
                    Swal.fire(
                        'Entrada Atualizada com Sucesso!',
                        data.msg,
                        'success'
                    ).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if(result.isConfirmed){
                            location.reload();
                        }else if(result.isDismissed){
                            location.reload();
                        }
                    })
                }).fail(function (data) {
                    Swal.fire(
                        'Houve um erro para dar entrada.',
                        'Entre em contato com nosso suporte.',
                        'error'
                    )
                });
            }

        }else{
            $("#empty-inputs-update").show();
            return;
        }





    });

    $('select').change(function (){
        $(this).css("borderColor","");
    });

    $('input').change(function (){
        $(this).css("borderColor","");
    });

    $("#newInput").click(function (){

        console.log('clicou no nova entrada');
        $("#entradas-detalhes-add").empty();
        contadorOrigens=0;
    });


    $("#addNewLines").click(function (){
        contadorOrigens++
        var html=gerarHtmlOrigemFormaPagamento(contadorOrigens,1);
        $("#entradas-detalhes-add").append(html);
        $('.valor').mask('#.##0,00', {reverse: true});
        $('select').change(function (){
            $(this).css("borderColor","");
        });

        $('input').change(function (){
            $(this).css("borderColor","");
        });

    });

    $("#addNewLinesUpdate").click(function (){
        var contadorOrigens=$("#contadorUpdate").val();
        contadorOrigens++;
        console.log('teste');
        console.log(contadorOrigens);

        var html=gerarHtmlOrigemFormaPagamento(contadorOrigens,0);

        $(".edit-container-inputs").append(html);
        $('.valor').mask('#.##0,00', {reverse: true});
        $('select').change(function (){
            $(this).css("borderColor","");
        });

        $('input').change(function (){
            $(this).css("borderColor","");
        });
        $("#contadorUpdate").val(contadorOrigens);
    });



    function gerarHtmlOrigemFormaPagamento(contadorOrigens,type){

        var arrayFormasPagamento=$.parseJSON(sessionStorage.paymentsMethodsData);
        var arrayOrigins=$.parseJSON(sessionStorage.originsData);

        arrayFormasPagamento=$.parseJSON(arrayFormasPagamento);
        arrayOrigins=$.parseJSON(arrayOrigins);


        var htmlFormasPagamento='';
        var htmlOrigins='';
        arrayFormasPagamento.forEach(function(item) {
            htmlFormasPagamento+='<option value="'+item.id+'">'+item.nome+'</option>';
        });

        arrayOrigins.forEach(function(item) {
            htmlOrigins+='<option value="'+item.id+'">'+item.nome+'</option>';
        });

        if(type){
            var origem='<hr><div class="form-row col-sm">' +
                '<div class="col-sm-8">' +
                '<label class="form-label">Origens:</label>'+
                '<select class="select-origin form-select-item select form-control form-control-sm" ' +
                'name="origins['+contadorOrigens+']" ' +
                'id="origin_id" searchable="Search here.." required="true">'+
                ' <option value="">Selecione uma Origem</option>'+
                htmlOrigins+
                ' </select>'+
                '</div>'+
                '<div class="col-sm">'+
                '<label class="form-label" for="valor">Valor:</label>'+
                '<input type="text" id="valor_origin" name="origin_valor['+contadorOrigens+']" class="valor valor_origin ' +
                'form-control-sm form-control o1" ' +
                'style="display:inline-block" onblur="SomatoriaOrigens()">'+
                '</div>'+
                '</div>';

            var forma_pagamento='<div class="form-row col-sm mt-2">'+
                '<div class="col-sm-8">'+
                '<label class="form-label">Forma de Recebimento:</label>'+
                '<select class="select-pagamento form-select-item select form-control form-control-sm" ' +
                'name="payment_methods['+contadorOrigens+']"  id="payment_methods_id" searchable="Search here.." required="true">'+
                '<option value="">Selecione um recebimento</option>'+
                htmlFormasPagamento+
                '</select>'+
                '</div>'+
                '<div class="col-sm">'+
                '<label class="form-label" for="valor">Valor:</label>'+
                ' <input type="text" id="valor_pagamento" name="payment_valor['+contadorOrigens+']" ' +
                'class="valor valor_pagamento form-control-sm ' +
                'form-control o1" style="display:inline-block" onblur="SomatoriaOrigens()">'+
                '</div>'+
                '</div>';
        }else{
            var origem='<hr><div class="form-row col-sm">' +
                '<div class="col-sm-8">' +
                '<label class="form-label">Origens:</label>'+
                '<select class="select-origin-update form-select-item select form-control form-control-sm" ' +
                'name="origins['+contadorOrigens+']" ' +
                'id="origin_id" searchable="Search here.." required="true">'+
                ' <option value="">Selecione uma Origem</option>'+
                htmlOrigins+
                ' </select>'+
                '</div>'+
                '<div class="col-sm">'+
                '<label class="form-label" for="valor">Valor:</label>'+
                '<input type="text" id="valor_origin_update" name="origin_valor['+contadorOrigens+']" class="valor ' +
                'valor_origin valor_origin_update ' +
                'form-control-sm form-control o1" ' +
                'style="display:inline-block" onblur="SomatoriaOrigensUpdate()">'+
                '</div>'+
                '</div>';

            var forma_pagamento='<div class="form-row col-sm mt-2">'+
                '<div class="col-sm-8">'+
                '<label class="form-label">Forma de Recebimento:</label>'+
                '<select class="select-pagamento-update form-select-item select form-control form-control-sm" ' +
                'name="payment_methods['+contadorOrigens+']"  id="payment_methods_id" searchable="Search here.." required="true">'+
                '<option value="">Selecione um recebimento</option>'+
                htmlFormasPagamento+
                '</select>'+
                '</div>'+
                '<div class="col-sm">'+
                '<label class="form-label" for="valor">Valor:</label>'+
                ' <input type="text" id="valor_pagamento" name="payment_valor['+contadorOrigens+']" ' +
                'class="valor valor_pagamento_update form-control-sm ' +
                'form-control o1" style="display:inline-block" onblur="SomatoriaOrigensUpdate()">'+
                '</div>'+
                '</div>';
        }


        var delButton='<div class="form-row col-sm mt-2">'+
            '<div class="col-sm">'+
            '<a class="btn btn-danger" onclick="removerOrigemEPagamento('+contadorOrigens+')"> Remover </a>'+
            '</div>'+
            '</div>';

        return '<div id="entradas-detalhes-add-child-'+contadorOrigens+'">'+origem+forma_pagamento+delButton+'</div>';
    }

    function gerarHtmlOrigemFormaPagamentoUpdate(contadorOrigens,objetoInput,origin,payment_methods){

        var arrayFormasPagamento=payment_methods;
        var arrayOrigins=origin;

        var htmlFormasPagamento='';
        var htmlOrigins='';

        arrayFormasPagamento.forEach(function(item) {
            if(objetoInput.payment_method_id==item.id){
                htmlFormasPagamento+='<option value="'+item.id+'" selected>'+item.nome+'</option>';
            }else{
                htmlFormasPagamento+='<option value="'+item.id+'">'+item.nome+'</option>';
            }

        });

        arrayOrigins.forEach(function(item) {
            if(objetoInput.origin_id==item.id){
                htmlOrigins+='<option value="'+item.id+'" selected>'+item.nome+'</option>';
            }else{
                htmlOrigins+='<option value="'+item.id+'">'+item.nome+'</option>';
            }

        });


        var origem='<hr><div class="form-row col-sm">' +
            '<div class="col-sm-8">' +
            '<label class="form-label">Origens:</label>'+
            '<select class="select-origin-update form-select-item select form-control form-control-sm" ' +
            'name="origins['+contadorOrigens+']" ' +
            'id="origin_id" searchable="Search here.." required="true">'+
            ' <option value="">Selecione uma Origem</option>'+
            htmlOrigins+
            ' </select>'+
            '</div>'+
            '<div class="col-sm">'+
            '<label class="form-label" for="valor">Valor:</label>'+
            '<input type="text" id="valor_origin" name="origin_valor['+contadorOrigens+']" class="valor ' +
            'valor_origin_update' +
            ' ' +
            'form-control-sm form-control o1" ' +
            'style="display:inline-block" value="'+objetoInput.origin_valor+'" onblur="SomatoriaOrigensUpdate()">'+
            '</div>'+
            '</div>';

        var forma_pagamento='<div class="form-row col-sm mt-2">'+
            '<div class="col-sm-8">'+
            '<label class="form-label">Forma de Recebimento:</label>'+
            '<select class="select-pagamento-update form-select-item select form-control form-control-sm" ' +
            'name="payment_methods['+contadorOrigens+']"  id="payment_methods_id" searchable="Search here.." required="true">'+
            '<option value="">Selecione um recebimento</option>'+
            htmlFormasPagamento+
            '</select>'+
            '</div>'+
            '<div class="col-sm">'+
            '<label class="form-label" for="valor">Valor:</label>'+
            ' <input type="text" id="valor_pagamento" name="payment_valor['+contadorOrigens+']" ' +
            'class="valor valor_pagamento_update form-control-sm ' +
            'form-control o1" style="display:inline-block" value="'+objetoInput.origin_valor+'" ' +
            'onblur="SomatoriaOrigensUpdate' +
            '()">'+
            '</div>'+
            '</div>';

        var delButton='<div class="form-row col-sm mt-2">'+
            '<div class="col-sm">'+
            '<a class="btn btn-danger" onclick="removerOrigemEPagamento('+contadorOrigens+')"> Remover </a>'+
            '</div>'+
            '</div>';

        return '<div id="entradas-detalhes-add-child-'+contadorOrigens+'">'+origem+forma_pagamento+delButton+'</div>';
    }


        function removerOrigemEPagamento(contadorOrigemPagamento){
            $("#entradas-detalhes-add-child-"+contadorOrigemPagamento).remove();
        }

</script>

<script type="text/javascript">
    $(document).ready(function() {
       $('.valor').mask('#.##0,00', {reverse: true});
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
                    $('#edit-form').attr('action', `entradas/${editItemId}`);
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


        $.get( "all-payment-methods", function( data ) {
            sessionStorage.setItem("paymentsMethodsData",JSON.stringify(data));
        });

        $.get( "all-origins/Entrada", function( data ) {
            sessionStorage.setItem("originsData",JSON.stringify(data));
        });

    });

    $(".close-alert-value").click(function (){
        $("#differ-values").hide();
        $("#differ-values-update").hide();
    })

    $(".close-alert-inputs").click(function (){
        $("#empty-inputs").hide();
        $("#empty-inputs-update").hide();
    })

    $("#close-alert-value").click(function (){
        $("#differ-values").hide();
        $("#differ-values-update").hide();
    })

    $("#close-alert-inputs").click(function (){
        $("#empty-inputs").hide();
        $("#empty-inputs-update").hide();
    })

    function editInput(inputId){
        $(".edit-container-inputs").html('');

        $.ajax({
            type: "GET",
            url: "entrada/info",
            data :{
                'inputId':inputId
            },
            dataType: "json",
            encode: true,
        }).done(function (data) {

            var html_input="";
            var origin=JSON.parse(data.origins);
            var info=JSON.parse(data.info);
            var payment_methods=JSON.parse(data.payment_methods);
            var inputs=JSON.parse(data.inputs);
            var contadorUpdate=0;
            var now = new Date(info.data);

            var day = ("0" + (now.getDate()+1)).slice(-2);

            var month = ("0" + (now.getMonth() + 1)).slice(-2);
            var date = now.getFullYear()+"-"+(month)+"-"+(day) ;


            $.each(inputs, function( index, entradas ) {
                html_input+=gerarHtmlOrigemFormaPagamentoUpdate((index+1),entradas,origin,payment_methods);
                contadorUpdate++;
            });

            $("#data-update").val(date);
            $("#id_input_update").val(info.id);
            $("#contadorUpdate").val(contadorUpdate);
            $(".edit-container-inputs").append(html_input);
            $('.valor').mask('#.##0,00', {reverse: true});
            $('select').change(function (){
                $(this).css("borderColor","");
            });
            SomatoriaOrigensUpdate();
        }).fail(function (data) {
            Swal.fire(
                'Houve um erro para dar entrada.',
                'Entre em contato com nosso suporte.',
                'error'
            )
        });

        $(".edit-container-inputs").append();


        $("#edit-item-modal").modal({
            show: true
        });
    }

    function deleteInput(inputId){
        $.ajax({
            type: "DELETE",
            url: "entrada/delete/"+inputId,
            data :{
                '_token': '{{ csrf_token() }}',
            },
            dataType: "json",
            encode: true,
        }).done(function (data) {
            location.reload();
        }).fail(function (data) {
            Swal.fire(
                'Houve um erro para dar entrada.',
                'Entre em contato com nosso suporte.',
                'error'
            )
        });
    }
</script>
@stop

