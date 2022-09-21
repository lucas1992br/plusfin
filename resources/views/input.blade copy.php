<x-aplicativo-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Entradas
        </h2>
    </x-slot>
    <!-- DataTales Example -->

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
            <h2>Formas de Recebimento</h2>
            <div class="table-responsive">
                
                <table id="table" class="table table-sm table-striped table-bordered table-hover" width="100%" cellspacing="0">
                    
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Dinheiro</th>
                            <th>Pix</th>
                            <th>Cheque</th>
                            <th>Cartão Debito</th>
                            <th>Cartão Credito</th>
                            <th>Cartão Recorrente</th>
                            <th>Total</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($methods ?? '' as $item)
                            <tr>
                                <td title="{{ $item->data }}">{{ \Carbon\Carbon::parse($item->data)->format('d/m/Y')}}</td>
                                <td title="{{ $item->valor_payment }}">{{ 'R$ '.number_format($item->valor_payment, 2, ',', '.') }}</td>
                                <td title="{{ $item->valor_payment2 }}">{{ 'R$ '.number_format($item->valor_payment2, 2, ',', '.') }}</td>
                                <td title="{{ $item->valor_payment3 }}">{{ 'R$ '.number_format($item->valor_payment3, 2, ',', '.') }}</td>
                                <td title="{{ $item->valor_payment4 }}">{{ 'R$ '.number_format($item->valor_payment4, 2, ',', '.') }}</td>
                                <td title="{{ $item->valor_payment5 }}">{{ 'R$ '.number_format($item->valor_payment5, 2, ',', '.') }}</td>
                                <td title="{{ $item->valor_payment6 }}">{{ 'R$ '.number_format($item->valor_payment6, 2, ',', '.') }}</td>
                                <td title="{{ $item->valor_payment_total }}">{{ 'R$ '.number_format($item->valor_payment_total, 2, ',', '.') }}</td>
                                <td title="Ações">
                                    <a role="button" class="delete-row-js" data-route="{{route('entradas.destroy',$item->id)}}">
                                        <i class="fa fa-trash _i text-danger"></i>
                                    </a>                             
                                    <a role="button" class="edit-row-js" data-route="{{route('entradas.show', $item->id)}}">
                                        <i class="fa fa-edit _i text-navy"></i>
                                    </a>
                                   
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
                <form method="POST" action="{{ route('entradas.store') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                       
                        <div class="container">
                            <div class="col-sm mb-3">
                                <label class="form-label">Data:</label>
                                <input type="date" class="form-control form-control-sm" name="data" row='3' required="true">
                            </div>
                            <hr class="sidebar-divider">
                            <p class="text-center">Formas de Recebimento</p>                          
                            <div class="row col-sm mt-2" id="formulario_formapg">
                                <div class="col-sm-5">
                                    <div class="form-label text-sm" name="payment_methods_id" searchable="Search here.." required="true">Dinheiro</div>
                                </div>
                                <div class="col-sm mb-7">  
                                    <input type="text" id="valor" name="valor_payment" class="valor form-control form-control-sm formaRecebimento" style="display:inline-block" onkeyup="SomatoriaformaRecebimento()">
                                </div>                         
                            </div>
                            <div class="row col-sm mt-2">
                                <div class="col-sm-5">
                                    <div class="form-label text-sm" name="payment_methods_id2" searchable="Search here.." required="true">PIX</div>
                                </div>
                                <div class="col-sm">  
                                    <input type="text" id="valor" name="valor_payment2" class="valor form-control form-control-sm formaRecebimento2" style="display:inline-block" onkeyup="SomatoriaformaRecebimento()">
                                </div>                         
                            </div>
                            <div class="row col-sm mt-2">
                                <div class="col-sm-5">
                                    <div class="form-label text-sm" name="payment_methods_id3" searchable="Search here.." required="true">Cheque</div>
                                </div>
                                <div class="col-sm">  
                                    <input type="text" id="valor" name="valor_payment3" class="valor form-control form-control-sm formaRecebimento3" style="display:inline-block" onkeyup="SomatoriaformaRecebimento()">
                                </div>                         
                            </div>
                            <div class="row col-sm mt-2">
                                <div class="col-sm-5">
                                    <div class="form-label text-sm" name="payment_methods_id4" searchable="Search here.." required="true">Cartão Debito</div>
                                </div>
                                <div class="col-sm">  
                                    <input type="text" id="valor" name="valor_payment4" class="valor form-control form-control-sm formaRecebimento4" style="display:inline-block" onkeyup="SomatoriaformaRecebimento()">
                                </div>                         
                            </div>
                            <div class="row col-sm mt-2">
                                <div class="col-sm-5">
                                    <div class="form-label text-sm" name="payment_methods_id5" searchable="Search here.." required="true">Cartão Credito</div>
                                </div>
                                <div class="col-sm">  
                                    <input type="text" id="valor" name="valor_payment5" class="valor form-control form-control-sm formaRecebimento5" style="display:inline-block" onkeyup="SomatoriaformaRecebimento()">
                                </div>                         
                            </div>
                            <div class="row col-sm mt-2">
                                <div class="col-sm-5">
                                    <div class="form-label text-sm" name="payment_methods_id6" searchable="Search here.." required="true">Cartão Recorrente</div>
                                </div>
                                <div class="col-sm-7">  
                                    <input type="text" id="valor" name="valor_payment6" class="valor form-control form-control-sm formaRecebimento6" style="display:inline-block" onkeyup="SomatoriaformaRecebimento()">
                                </div>                         
                            </div>
                            <div class="row col-sm mt-2">
                                    <div class="form-label text-sm col-sm-9"><span>Valor Total Forma de Recebimento</span></div>
                                    <input type="text" id="valor" name="valor_payment_total" class="valor form-control form-control-sm formaRecebimentoResut col-sm-3" style="display:inline-block" >
                                                                        
                            </div>
                            <div class="form-row col-sm" id="formulario_origin">
                                <div class="col-sm-8 mb-3">
                                    <label class="form-label">Origem</label>
                                    <select class="form-select-item select form-control form-control-sm" id="edit-origin_id" name="origin_id" searchable="Search here.." required="true">
                                       <option value="">Selecione uma Origem</option>
                                       @foreach($origins as $item)
                                           <option value="{{ $item->id }}">{{ $item->nome }}</option>
                                       @endforeach
                                   </select>
                                </div>
                                <div class="col-sm mb-3">  
                                    <label class="form-label" for="valor">Valor:</label>
                                    <input type="text" id="valor" name="valor_origin" class="valor form-control-sm form-control" style="display:inline-block" >
                                </div>
                                <div class="col-sm mb-3">
                                    <label class="form-label">Add</label>
                                    <button type="button" class="btn btn-sm btn-primary mb-3" onclick="adicionarCampoOrigin()"><i class="fas fa-plus"></i></button>
                                </div>                          
                            </div>
                            <div class="col-sm mb-3">  
                                <label class="form-label" for="valor">Valor Total Entrada Origen:</label>
                                <input type="text" id="valorOrigin" name="valor_payment_origin" value="10" class="valor form-control-sm form-control" style="display:inline-block">
                            </div>
                            <div class="col-sm-12 mb-3">
                              <label class="form-label">Observação - Administrativo</label>
                              <textarea class="form-control form-control-sm" name="observacao"></textarea>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <label class="form-label">Observação - Gestpr</label>
                                <textarea class="form-control form-control-sm" name="observacao2"></textarea>
                              </div>
                            <div class="col-sm-12 mb-3">
                                <label class="form-label" >Observação Auditoria</label>
                                <textarea class="form-control form-control-sm" name="observacao_atuditoria"></textarea>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <label class="form-label">Observação Auditoria</label>
                                <textarea class="form-control form-control-sm" name="observacao_atuditoria2"></textarea>
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
                        <div class="container">
                            <div class="col-sm mb-3">
                                <label class="form-label">Data:</label>
                                <input type="date" class="form-control form-control-sm" name="data" row='3' required="true">
                            </div>
                            <hr class="sidebar-divider">
                            <p class="text-center">Formas de Recebimento</p>                          
                            <div class="row col-sm mt-2" id="formulario_formapg">
                                <div class="col-sm-5">
                                    <div class="form-label text-sm" name="payment_methods_id" searchable="Search here.." required="true">Dinheiro</div>
                                </div>
                                <div class="col-sm mb-7">  
                                    <input type="text" id="valor" name="valor_payment" class="valor form-control form-control-sm formaRecebimento" style="display:inline-block" onkeyup="SomatoriaformaRecebimento()">
                                </div>                         
                            </div>
                            <div class="row col-sm mt-2">
                                <div class="col-sm-5">
                                    <div class="form-label text-sm" name="payment_methods_id2" searchable="Search here.." required="true">PIX</div>
                                </div>
                                <div class="col-sm">  
                                    <input type="text" id="valor" name="valor_payment2" class="valor form-control form-control-sm formaRecebimento2" style="display:inline-block" onkeyup="SomatoriaformaRecebimento()">
                                </div>                         
                            </div>
                            <div class="row col-sm mt-2">
                                <div class="col-sm-5">
                                    <div class="form-label text-sm" name="payment_methods_id3" searchable="Search here.." required="true">Cheque</div>
                                </div>
                                <div class="col-sm">  
                                    <input type="text" id="valor" name="valor_payment3" class="valor form-control form-control-sm formaRecebimento3" style="display:inline-block" onkeyup="SomatoriaformaRecebimento()">
                                </div>                         
                            </div>
                            <div class="row col-sm mt-2">
                                <div class="col-sm-5">
                                    <div class="form-label text-sm" name="payment_methods_id4" searchable="Search here.." required="true">Cartão Debito</div>
                                </div>
                                <div class="col-sm">  
                                    <input type="text" id="valor" name="valor_payment4" class="valor form-control form-control-sm formaRecebimento4" style="display:inline-block" onkeyup="SomatoriaformaRecebimento()">
                                </div>                         
                            </div>
                            <div class="row col-sm mt-2">
                                <div class="col-sm-5">
                                    <div class="form-label text-sm" name="payment_methods_id5" searchable="Search here.." required="true">Cartão Credito</div>
                                </div>
                                <div class="col-sm">  
                                    <input type="text" id="valor" name="valor_payment5" class="valor form-control form-control-sm formaRecebimento5" style="display:inline-block" onkeyup="SomatoriaformaRecebimento()">
                                </div>                         
                            </div>
                            <div class="row col-sm mt-2">
                                <div class="col-sm-5">
                                    <div class="form-label text-sm" name="payment_methods_id6" searchable="Search here.." required="true">Cartão Recorrente</div>
                                </div>
                                <div class="col-sm-7">  
                                    <input type="text" id="valor" name="valor_payment6" class="valor form-control form-control-sm formaRecebimento6" style="display:inline-block" onkeyup="SomatoriaformaRecebimento()">
                                </div>                         
                            </div>
                            <div class="row col-sm mt-2">
                                    <div class="form-label text-sm col-sm-9"><span>Valor Total Forma de Recebimento</span></div>
                                    <input type="text" id="valor" name="valor_payment_total" class="valor form-control form-control-sm formaRecebimentoResut col-sm-3" style="display:inline-block" >
                                                                        
                            </div>
                            <div class="form-row col-sm" id="formulario_origin">
                                <div class="col-sm-8 mb-3">
                                    <label class="form-label">Origem</label>
                                    <select class="form-select-item select form-control form-control-sm" id="edit-origin_id" name="origin_id" searchable="Search here.." required="true">
                                       <option value="">Selecione uma Origem</option>
                                       @foreach($origins as $item)
                                           <option value="{{ $item->id }}">{{ $item->nome }}</option>
                                       @endforeach
                                   </select>
                                </div>
                                <div class="col-sm mb-3">  
                                    <label class="form-label" for="valor">Valor:</label>
                                    <input type="text" id="valor" name="valor_origin" class="valor form-control-sm form-control" style="display:inline-block" >
                                </div>
                                <div class="col-sm mb-3">
                                    <label class="form-label">Add</label>
                                    <button type="button" class="btn btn-sm btn-primary mb-3" onclick="adicionarCampoOrigin()"><i class="fas fa-plus"></i></button>
                                </div>                          
                            </div>
                            <div class="col-sm mb-3">  
                                <label class="form-label" for="valor">Valor Total Entrada Origen:</label>
                                <input type="text" id="valorOrigin" name="valor_payment_origin" value="10" class="valor form-control-sm form-control" style="display:inline-block">
                            </div>
                            <div class="col-sm-12 mb-3">
                              <label class="form-label">Observação - Administrativo</label>
                              <textarea class="form-control form-control-sm" name="observacao"></textarea>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <label class="form-label">Observação - Gestpr</label>
                                <textarea class="form-control form-control-sm" name="observacao2"></textarea>
                              </div>
                            <div class="col-sm-12 mb-3">
                                <label class="form-label" >Observação Auditoria</label>
                                <textarea class="form-control form-control-sm" name="observacao_atuditoria"></textarea>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <label class="form-label">Observação Auditoria</label>
                                <textarea class="form-control form-control-sm" name="observacao_atuditoria2"></textarea>
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
              <h5 class="modal-title">Arquivos Entradas</h5>
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
       /*$('#valor').mask('#.##0,00', {reverse: true});*/
        $('#table').DataTable({
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
    var formaPagamento = 1;
    function adicionarcampo()
    {
        var totalformaPagamento = formaPagamento++;
        if(totalformaPagamento <= 4)
        {
            document.getElementById('formulario_formapg').insertAdjacentHTML('beforeend', '<div class="form-row"  id="campo' + formaPagamento +'"><div class="col-sm-8"><label class="form-label">Forma Pagamento</label><select class="form-select-item select form-control form-control-sm" name="payment_methods_id' + formaPagamento +'" searchable="Search here.." required="true"><option value="">Selecione uma Forma de Pagamento</option>@foreach($payments_methods as $item)<option value="{{ $item->id }}">{{ $item->nome }}</option>@endforeach</select></div><div class="col-sm mb-3"><label class="form-label text-sm" for="valor">Valor:</label><input type="text" id="valor" name="valor' + formaPagamento +'" class="valor form-control form-control-sm" style="display:inline-block" ></div><div class="col-sm"><label class="form-label">Add</label></br><button type="button" class="btn btn-sm btn-danger" onclick="removerCampo(' + formaPagamento + ')"><i class="fas fa-minus-circle"></i></button></div></div>');
        }         
        else 
        {
            alert("Limite Maximo de Formas de Pagamento");
        }
        
    }
    function removerCampo(idCampo)
    {
        document.getElementById('campo' + idCampo).remove();
    }
    var origin = 1;
    function adicionarCampoOrigin()
    {
        
        var totalOrigin = origin++;
        if( totalOrigin <= 4)
        {
            document.getElementById('formulario_origin').insertAdjacentHTML('beforeend', '<div class="form-row"  id="campo' + origin +'"><div class="col-sm-8"><label class="form-label">Origem</label><select class="form-select-item select form-control form-control-sm" name="payment_methods_id' + origin +'" searchable="Search here.." required="true"><option value="">Selecione uma Origem</option>@foreach($origins as $item)<option value="{{ $item->id }}">{{ $item->nome }}</option>@endforeach</select></div><div class="col-sm mb-3"><label class="form-label text-sm" for="valor">Valor:</label><input type="text" id="valor" name="valor' + origin +'" class="valor form-control form-control-sm" style="display:inline-block" ></div><div class="col-sm"><label class="form-label">Add</label></br><button type="button" class="btn btn-sm btn-danger" onclick="removerCampo(' + origin + ')"><i class="fas fa-minus-circle"></i></button></div></div>');
        }   
        else 
        {
            alert("Limite Maximo de Origens");
        }
        
    }
    function SomatoriaformaRecebimento(){
        var r1 = document.querySelector(".formaRecebimento").value;
        var r2 = document.querySelector(".formaRecebimento2").value;
        var r3 = document.querySelector(".formaRecebimento3").value;
        var r4 = document.querySelector(".formaRecebimento4").value;
        var r5 = document.querySelector(".formaRecebimento5").value;
        var r6 = document.querySelector(".formaRecebimento6").value;
        
        var result = parseInt(r1 || 0) + parseInt(r2 || 0) + parseInt(r3 || 0) + parseInt(r4 || 0) + parseInt(r5 || 0) + parseInt(r6 || 0);
        if(result == ''){
            document.querySelector(".formaRecebimentoResut").innerHTML = 'Valor Incorreto';
        } else {
            document.querySelector(".formaRecebimentoResut").innerHTML = result;
            document.querySelector(".formaRecebimentoResut").value = result;
            
        }
        
    }
</script>
