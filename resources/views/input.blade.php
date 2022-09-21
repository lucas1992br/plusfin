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
                Entrada
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
                                    @if (count($item->files) > 0)
                                    <a role="button" class="view-row-js" data-files="{{$item->files}}">
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
                <form method="POST" action="{{ route('entradas.store') }}" class="needs-validation" novalidate>
                    @csrf
                    <div class="modal-body">
                       
                        <div class="container">
                            <div class="col-sm mb-3">
                                <label class="form-label">Data:</label>
                                <input type="date" class="form-control form-control-sm" name="data" row='3' required="true">
                            </div>
                            <hr class="sidebar-divider">
                            <p class="text-center">Origens</p>                          
                            <div class="form-row col-sm" id="formulario_origin">
                                <div class="col-sm-8">
                                    <label class="form-label">Origens:</label>
                                    <select class="form-select-item select form-control form-control-sm" name="origin_id" searchable="Search here.." required="true">
                                        <option value="">Selecione uma Origem</option>
                                        @foreach($origins as $item)
                                            <option value="{{ $item->nome }}">{{ $item->nome }}</option>
                                        @endforeach
                                    </select>                                      
                                </div>
                                <div class="col-sm">  
                                    <label class="form-label" for="valor">Valor:</label>
                                    <input type="text" id="valor" name="valor_origin" class="valor form-control-sm form-control o1" style="display:inline-block" onkeyup="SomatoriaOrigens()">
                                </div>
                                <div class="col-sm-8 mt-2">
                                    <select class="form-select-item select form-control form-control-sm" name="origin_id2" searchable="Search here..">
                                        <option value="">Selecione uma Origem</option>
                                        @foreach($origins as $item)
                                            <option value="{{ $item->nome }}">{{ $item->nome }}</option>
                                        @endforeach
                                    </select>                                     
                                </div>
                                <div class="col-sm mt-2">  
                                    <input type="text" id="valor" name="valor_origin2" class="valor form-control-sm form-control o2" style="display:inline-block" onkeyup="SomatoriaOrigens()">
                                </div>
                                <div class="col-sm-8 mt-2">                                   
                                    <select class="form-select-item select form-control form-control-sm" name="origin_id3" searchable="Search here..">
                                        <option value="">Selecione uma Origem</option>
                                        @foreach($origins as $item)
                                            <option value="{{ $item->nome }}">{{ $item->nome }}</option>
                                        @endforeach
                                    </select>                                     
                                </div>
                                <div class="col-sm mt-2">  
                                    <input type="text" id="valor" name="valor_origin3" class="valor form-control-sm form-control o3" style="display:inline-block" onkeyup="SomatoriaOrigens()">
                                </div>
                                <div class="col-sm-8 mt-2">                                  
                                    <select class="form-select-item select form-control form-control-sm" name="origin_id4" searchable="Search here..">
                                        <option value="">Selecione uma Origem</option>
                                        @foreach($origins as $item)
                                            <option value="{{ $item->nome }}">{{ $item->nome }}</option>
                                        @endforeach
                                    </select>                                      
                                </div>
                                <div class="col-sm mt-2">                                 
                                    <input type="text" id="valor" name="valor_origin4" class="valor form-control-sm form-control o4" style="display:inline-block" onkeyup="SomatoriaOrigens()">
                                </div>
                                <div class="col-sm-8 mt-2">                                  
                                    <select class="form-select-item select form-control form-control-sm" name="origin_id5" searchable="Search here..">
                                        <option value="">Selecione uma Origem</option>
                                        @foreach($origins as $item)
                                            <option value="{{ $item->nome }}">{{ $item->nome }}</option>
                                        @endforeach
                                    </select>                                      
                                </div>
                                <div class="col-sm mt-2">                                 
                                    <input type="text" id="valor" name="valor_origin5" class="valor form-control-sm form-control o5" style="display:inline-block" onkeyup="SomatoriaOrigens()">
                                </div>                   
                            </div>
                            <div class="form-row col-sm">  
                                <label class="form-label col-sm-8 mt-3" for="valor">Valor Total Origem:</label>
                                <input type="text" name="valor_payment_origin" class="valor form-control-sm form-control OrigenResult col-sm mt-2" >
                            </div>
                            <!-- Formas de Recebimento -->
                            <p class="text-center mt-2">Formas de Recebimento</p>                          
                            <div class="form-row col-sm" id="formulario_formapg">
                                <div class="col-sm-8">
                                    <label class="form-label">Forma de Recebimento</label>
                                    <input class="form-select-item select form-control form-control-sm"  name="dinheiro" value="Dinheiro" searchable="Search here.." required="true" disabled>                                      
                                </div>
                                <div class="col-sm">  
                                    <label class="form-label" for="valor">Valor:</label>
                                    <input type="text" id="valor" name="dinheiro" class="valor form-control-sm form-control v1" style="display:inline-block" onkeyup="SomatoriaformaRecebimento()">
                                </div>
                                <div class="col-sm-8 mt-2">
                                    <input class="form-select-item select form-control form-control-sm" value="Pix" searchable="Search here.." required="true" disabled>                                      
                                </div>
                                <div class="col-sm mt-2">  
                                    <input type="text" id="valor" name="pix" class="valor form-control-sm form-control v2" style="display:inline-block" onkeyup="SomatoriaformaRecebimento()">
                                </div>
                                <div class="col-sm-8 mt-2">                                   
                                    <input class="form-select-item select form-control form-control-sm" value="Cheque" searchable="Search here.." required="true" disabled>                                      
                                </div>
                                <div class="col-sm mt-2">  
                                    <input type="text" id="valor" name="cheque" class="valor form-control-sm form-control v3" style="display:inline-block" onkeyup="SomatoriaformaRecebimento()">
                                </div>
                                <div class="col-sm-8 mt-2">                                  
                                    <input class="form-select-item select form-control form-control-sm" value="Cartão Debito" searchable="Search here.." required="true" disabled>                                      
                                </div>
                                <div class="col-sm mt-2">                                 
                                    <input type="text" id="valor" name="cartao_debito" class="valor form-control-sm form-control v4" style="display:inline-block" onkeyup="SomatoriaformaRecebimento()">
                                </div>
                                <div class="col-sm-8 mt-2">                                   
                                    <input class="form-select-item select form-control form-control-sm" value="Cartão Credito" searchable="Search here.." required="true" disabled>                                      
                                </div>
                                <div class="col-sm mt-2">  
                                    <input type="text" id="valor" name="cartao_credito" class="valor form-control-sm form-control v5" style="display:inline-block" onkeyup="SomatoriaformaRecebimento()">
                                </div>       
                                <div class="col-sm-8 mt-2">                                   
                                    <input class="form-select-item select form-control form-control-sm" value="Cartão Recorrente" searchable="Search here.." required="true" disabled>                                      
                                </div>
                                <div class="col-sm mt-2">  
                                    <input type="text" id="valor" name="cartao_recorrente" class="valor form-control-sm form-control v6" style="display:inline-block" onkeyup="SomatoriaformaRecebimento()">
                                </div>
                                <div class="col-sm-8 mt-2">                                   
                                    <input class="form-select-item select form-control form-control-sm" value="Banco" searchable="Search here.." required="true" disabled>                                      
                                </div>
                                <div class="col-sm mt-2">  
                                    <input type="text" id="valor" name="banco" class="valor form-control-sm form-control v6" style="display:inline-block" onkeyup="SomatoriaformaRecebimento()">
                                </div>                   
                            </div>
                            <div class="form-row col-sm">  
                                <label class="form-label col-sm-8 mt-3" for="valor">Valor Total Recebimento:</label>
                                <input type="text" id="valorPaymentTotal" name="valor_payment_total" class="valor form-control-sm form-control formaRecebimentoResut col-sm mt-2" >
                            </div>
                            <!-- /Forma Recebimento -->
                            <!-- observações -->
                            <div class="col-sm-12 mb-3">
                              <label class="form-label">Observação - Administrativo</label>
                              <textarea class="form-control form-control-sm" name="observacao"></textarea>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <label class="form-label">Observação - Gestor</label>
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

    <!-- Modal Editar -->
    <div class="modal fade" id="edit-item-modal" tabindex="-1" role="dialog" aria-labelledby="update-modal" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-modal">Editar Origens</h5>
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
                            <p class="text-center">Origens</p>                          
                            <div class="form-row col-sm" id="formulario_origin">
                                <div class="col-sm-8">
                                    <label class="form-label">Origens:</label>
                                    <select class="form-select-item select form-control form-control-sm" name="origin_id" searchable="Search here.." required="true">
                                        <option value="">Selecione uma Origem</option>
                                        @foreach($origins as $item)
                                            <option value="{{ $item->nome }}">{{ $item->nome }}</option>
                                        @endforeach
                                    </select>                                      
                                </div>
                                <div class="col-sm">  
                                    <label class="form-label" for="valor">Valor:</label>
                                    <input type="text" id="valor" name="valor_origin" class="valor form-control-sm form-control o1" style="display:inline-block" onkeyup="SomatoriaOrigens()">
                                </div>
                                <div class="col-sm-8 mt-2">
                                    <select class="form-select-item select form-control form-control-sm" name="origin_id2" searchable="Search here.." required="true">
                                        <option value="">Selecione uma Origem</option>
                                        @foreach($origins as $item)
                                            <option value="{{ $item->nome }}">{{ $item->nome }}</option>
                                        @endforeach
                                    </select>                                     
                                </div>
                                <div class="col-sm mt-2">  
                                    <input type="text" id="valor" name="valor_origin2" class="valor form-control-sm form-control o2" style="display:inline-block" onkeyup="SomatoriaOrigens()">
                                </div>
                                <div class="col-sm-8 mt-2">                                   
                                    <select class="form-select-item select form-control form-control-sm" name="origin_id3" searchable="Search here.." required="true">
                                        <option value="">Selecione uma Origem</option>
                                        @foreach($origins as $item)
                                            <option value="{{ $item->nome }}">{{ $item->nome }}</option>
                                        @endforeach
                                    </select>                                     
                                </div>
                                <div class="col-sm mt-2">  
                                    <input type="text" id="valor" name="valor_origin3" class="valor form-control-sm form-control o3" style="display:inline-block" onkeyup="SomatoriaOrigens()">
                                </div>
                                <div class="col-sm-8 mt-2">                                  
                                    <select class="form-select-item select form-control form-control-sm" name="origin_id4" searchable="Search here.." required="true">
                                        <option value="">Selecione uma Origem</option>
                                        @foreach($origins as $item)
                                            <option value="{{ $item->nome }}">{{ $item->nome }}</option>
                                        @endforeach
                                    </select>                                      
                                </div>
                                <div class="col-sm mt-2">                                 
                                    <input type="text" id="valor" name="valor_origin4" class="valor form-control-sm form-control o4" style="display:inline-block" onkeyup="SomatoriaOrigens()">
                                </div>
                                <div class="col-sm-8 mt-2">                                  
                                    <select class="form-select-item select form-control form-control-sm" name="origin_id5" searchable="Search here.." required="true">
                                        <option value="">Selecione uma Origem</option>
                                        @foreach($origins as $item)
                                            <option value="{{ $item->nome }}">{{ $item->nome }}</option>
                                        @endforeach
                                    </select>                                      
                                </div>
                                <div class="col-sm mt-2">                                 
                                    <input type="text" id="valor" name="valor_origin5" class="valor form-control-sm form-control o5" style="display:inline-block" onkeyup="SomatoriaOrigens()">
                                </div>                   
                            </div>
                            <div class="form-row col-sm">  
                                <label class="form-label col-sm-8 mt-3" for="valor">Valor Total Origem:</label>
                                <input type="text" id="OrigenResult" name="valor_payment_origin" class="valor form-control-sm form-control OrigenResult col-sm mt-2" >
                            </div>
                            <!-- Formas de Recebimento -->
                            <p class="text-center mt-2">Formas de Recebimento</p>                          
                            <div class="form-row col-sm" id="formulario_formapg">
                                <div class="col-sm-8">
                                    <label class="form-label">Forma de Recebimento</label>
                                    <input class="form-select-item select form-control form-control-sm"  name="dinheiro" value="Dinheiro" searchable="Search here.." required="true" disabled>                                      
                                </div>
                                <div class="col-sm">  
                                    <label class="form-label" for="valor">Valor:</label>
                                    <input type="text" id="valor" name="dinheiro" class="valor form-control-sm form-control v1" style="display:inline-block" onkeyup="SomatoriaformaRecebimento()">
                                </div>
                                <div class="col-sm-8 mt-2">
                                    <input class="form-select-item select form-control form-control-sm" value="Pix" searchable="Search here.." required="true" disabled>                                      
                                </div>
                                <div class="col-sm mt-2">  
                                    <input type="text" id="valor" name="pix" class="valor form-control-sm form-control v2" style="display:inline-block" onkeyup="SomatoriaformaRecebimento()">
                                </div>
                                <div class="col-sm-8 mt-2">                                   
                                    <input class="form-select-item select form-control form-control-sm" value="Cheque" searchable="Search here.." required="true" disabled>                                      
                                </div>
                                <div class="col-sm mt-2">  
                                    <input type="text" id="valor" name="cheque" class="valor form-control-sm form-control v3" style="display:inline-block" onkeyup="SomatoriaformaRecebimento()">
                                </div>
                                <div class="col-sm-8 mt-2">                                  
                                    <input class="form-select-item select form-control form-control-sm" value="Cartão Debito" searchable="Search here.." required="true" disabled>                                      
                                </div>
                                <div class="col-sm mt-2">                                 
                                    <input type="text" id="valor" name="cartao_debito" class="valor form-control-sm form-control v4" style="display:inline-block" onkeyup="SomatoriaformaRecebimento()">
                                </div>
                                <div class="col-sm-8 mt-2">                                   
                                    <input class="form-select-item select form-control form-control-sm" value="Cartão Credito" searchable="Search here.." required="true" disabled>                                      
                                </div>
                                <div class="col-sm mt-2">  
                                    <input type="text" id="valor" name="cartao_credito" class="valor form-control-sm form-control v5" style="display:inline-block" onkeyup="SomatoriaformaRecebimento()">
                                </div>       
                                <div class="col-sm-8 mt-2">                                   
                                    <input class="form-select-item select form-control form-control-sm" value="Cartão Recorrente" searchable="Search here.." required="true" disabled>                                      
                                </div>
                                <div class="col-sm mt-2">  
                                    <input type="text" id="valor" name="cartao_recorrente" class="valor form-control-sm form-control v6" style="display:inline-block" onkeyup="SomatoriaformaRecebimento()">
                                </div>
                                <div class="col-sm-8 mt-2">                                   
                                    <input class="form-select-item select form-control form-control-sm" value="Banco" searchable="Search here.." required="true" disabled>                                      
                                </div>
                                <div class="col-sm mt-2">  
                                    <input type="text" id="valor" name="banco" class="valor form-control-sm form-control v6" style="display:inline-block" onkeyup="SomatoriaformaRecebimento()">
                                </div>                    
                            </div>
                            <div class="form-row col-sm">  
                                <label class="form-label col-sm-8 mt-3" for="valor">Valor Total Recebimento:</label>
                                <input type="text" id="valorPaymentTotal" name="valor_payment_total" class="valor form-control-sm form-control formaRecebimentoResut col-sm mt-2" >
                            </div>
                            <!-- /Forma Recebimento -->
                            <!-- observações -->
                            <div class="col-sm-12 mb-3">
                              <label class="form-label">Observação - Administrativo</label>
                              <textarea class="form-control form-control-sm" name="observacao"></textarea>
                            </div>
                            <div class="col-sm-12 mb-3">
                                <label class="form-label">Observação - Gestor</label>
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
    function SomatoriaformaRecebimento(){
        var r1 = document.querySelector(".v1").value.replace('.','').replace(',','.');
        var r2 = document.querySelector(".v2").value.replace('.','').replace(',','.');
        var r3 = document.querySelector(".v3").value.replace('.','').replace(',','.');
        var r4 = document.querySelector(".v4").value.replace('.','').replace(',','.');
        var r5 = document.querySelector(".v5").value.replace('.','').replace(',','.');
        var r6 = document.querySelector(".v6").value.replace('.','').replace(',','.');

        
       
        
        var result = parseFloat(r1 || 0) + parseFloat(r2 || 0) + parseFloat(r3 || 0) + parseFloat(r4 || 0) + parseFloat(r5 || 0) + parseFloat(r6 || 0);
        console.log(r1);
        if(result == ''){
            document.querySelector(".formaRecebimentoResut").innerHTML = 'Valor Incorreto';
        } else {
            document.querySelector(".formaRecebimentoResut").value = result;
            
        }
        
    }

    function SomatoriaOrigens(){
        var r1 = document.querySelector(".o1").value.replace('.','').replace(',','.');
        var r2 = document.querySelector(".o2").value.replace('.','').replace(',','.');
        var r3 = document.querySelector(".o3").value.replace('.','').replace(',','.');
        var r4 = document.querySelector(".o4").value.replace('.','').replace(',','.');
        var r5 = document.querySelector(".o5").value.replace('.','').replace(',','.');
        

        
       
        
        var result = parseFloat(r1 || 0) + parseFloat(r2 || 0) + parseFloat(r3 || 0) + parseFloat(r4 || 0) + parseFloat(r5 || 0);
        console.log(r1);
        if(result == ''){
            document.querySelector(".OrigenResult").innerHTML = 'Valor Incorreto';
        } else {
            document.querySelector(".OrigenResult").value = result;
            
        }
        
    }
</script>
