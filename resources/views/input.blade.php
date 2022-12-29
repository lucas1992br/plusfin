
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
    <div class="card-body">
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <div class="table-responsive-lg">
            <table class="table">
                <thead>
                <tr>
                   <div class="col-2">DATA</div>
                </tr>

                    <tr>
                        <th>Data</th>
                        <th>Formas de Recebimento</th>
                        <th>Valor Total Entradas</th>
                        <th>Retirada</th>
                    </tr>
                </thead>
            </table>
        </div>


        <div class="table-responsive">
            <table id="table" class="table table-sm table-striped table-bordered table-hover" width="100%" cellspacing="0">

                <thead>
                    <tr class="">
                        <th>Entradas</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($methods ?? '' as $item)
                    <tr class="expandable-body">
                        <td>
                          <div class="p-0">
                            <table class="table table-hover">
                              <tbody>
                                <tr data-widget="expandable-table" aria-expanded="true">
                                  <td class="small">
                                    <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                    <b>{{ \Carbon\Carbon::parse($item->data)->format('d/m/Y')}}</b>
                                    Valor total da entrada
                                    @php
                                    $origem = 0;
                                    foreach ($item->receipts as $key) {
                                        $origem += $key->origin_valor;
                                    }
                                    $recebimento = 0;
                                    foreach ($item->payments as $key) {
                                        $recebimento += $key->payment_valor;
                                    }
                                    $total = $origem + $recebimento;
                                    @endphp
                                    - <b>{{ 'R$ '.number_format($total, 2, ',', '.') }}</b>
                                  </td>

                                </tr>
                                <tr class="expandable-body">
                                  <td>
                                    <div class="p-0" style="display: none;">
                                      <table class="table table-hover">
                                        <thead>
                                            <tr class="small">
                                                <th style="text-align: center">Origem</th>
                                                <th style="text-align: center">Forma de Recebimento</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="small">
                                            @foreach ($item->receipts as $key)

                                                <td>{{ $key->origin->nome }}</td>
                                            @endforeach
                                            </tr>
                                            <tr>
                                                @foreach ($item->receipts as $key)

                                                    <td> {{ 'R$ '.number_format($key->origin_valor, 2, ',', '.') }}</td>
                                                @endforeach

                                            </tr>
                                        </tbody>
                                        <thead>
                                            <tr class="small">
                                                <th>Forma de Recebimento</th>
                                                @php
                                                $base = 0;
                                                foreach ($item->payments as $key) {
                                                    $base += $key->payment_valor;
                                                }
                                                @endphp

                                                <th>Valor R$ <b>{{ 'R$ '.number_format($base, 2, ',', '.') }}</b></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($item->payments as $key)
                                            <tr class="small">
                                                <td>{{ $key->payments_methods->nome }}</td>
                                                <td> {{ 'R$ '.number_format($key->payment_valor, 2, ',', '.') }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                      </table>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </td>
                      </tr>
                        <tr class="small">
                            <td>
                                <!--<a role="button" title="Deletar" class="delete-row-js" data-route="{{route('entradas.destroy',$item->id)}}">
                                    <i class="fa fa-trash _i text-danger"></i>
                                </a>-->
{{--                                <a role="button" title="Editar" class="edit-row-js ml-2" data-route="{{route('entradas.show', $item->id)}}">--}}
{{--                                    <i class="fas fa-plus"> Adicionar entradas</i>--}}
{{--                                </a>--}}
                                @if (count($item->files) > 0)
                                <a role="button" title="Arquivos" class="view-row-js ml-2" data-files="{{$item->files}}">
                                    <i class="fa fa-eye _i text-navy"></i>
                                </a>
                                @endif
                            </td>
                        </tr>

                    @endforeach
                </tbody>
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
                                    form-control o1" style="display:inline-block" onkeyup="SomatoriaOrigens()">
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
                                     form-control o1" style="display:inline-block" onkeyup="SomatoriaOrigens()">
                                </div>
                            </div>
                        </div>
                        <div class='' id='entradas-detalhes-add'>
                        </div>

                        <div class="modal-footer">
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
                <h5 class="modal-title" id="register-modal">Adicionar Entradas</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form id="edit-form" class="needs-validation" method="POST" novalidate>
                <div class="modal-body">
                    @method('PUT')
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-5">
                                <label>Data</label>
                            </div>
                            <div class="col-sm-7">
                                <input type="date" name="data" class="form-control form-control-sm" id='edit_data'>
                            </div>
                        </div>
                        <div class="form-row col-sm">
                            <div class="col-sm-8">
                                <label class="form-label">Origens:</label>
                                <select class="form-select-item select form-control form-control-sm" name="origin_id" searchable="Search here.." required="true">
                                    <option value="">Selecione uma Origem</option>
                                    @foreach($origins as $item)
                                        <option value="{{ $item->id }}">{{ $item->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm">
                                <label class="form-label" for="valor">Valor:</label>
                                <input type="text" id="valor_origin_update" name="origin_valor" class="valor
                                form-control-sm form-control o1" style="display:inline-block" onkeyup="SomatoriaOrigens()">
                            </div>
                        </div>
                        <div class="form-row col-sm mt-2">
                            <div class="col-sm-8">
                                <label class="form-label">Forma de Recebimento:</label>
                                <select class="form-select-item select form-control form-control-sm" name="payment_methods_id" searchable="Search here.." required="true">
                                    <option value="">Selecione um recebimento</option>
                                    @foreach($payments_methods as $item)
                                        <option value="{{ $item->id }}">{{ $item->nome }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm">
                                <label class="form-label" for="valor">Valor:</label>
                                <input type="text" id="valor" name="payment_valor" class="valor form-control-sm form-control o1" style="display:inline-block" onkeyup="SomatoriaOrigens()">
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
        console.log('somarOrigens');
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

        if(flagValidateValue==false){

            Swal.fire(
                'Houve um erro para dar entrada.',
                'A soma de valores Origem/Pagamento devem ser iguais.',
                'warning'
            )
            return;
        }

        if(flagValidate==true){
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
        }else{
            Swal.fire(
                'Preencha todos os campos para prosseguir.',
                '',
                'warning'
            )
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
        var html=gerarHtmlOrigemFormaPagamento(contadorOrigens);
        $("#entradas-detalhes-add").append(html);
        $('.valor').mask('#.##0,00', {reverse: true});
        $('select').change(function (){
            $(this).css("borderColor","");
        });

        $('input').change(function (){
            $(this).css("borderColor","");
        });

    });



    function gerarHtmlOrigemFormaPagamento(contadorOrigens){

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
            'style="display:inline-block" onkeyup="SomatoriaOrigens()">'+
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
            'form-control o1" style="display:inline-block" onkeyup="SomatoriaOrigens()">'+
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

</script>
@stop

