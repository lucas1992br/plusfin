
<x-aplicativo-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            
        </h2>
    </x-slot>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-end">
        </div>

        <div class="card-body">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <h2>Efetivar Entradas</h2>
            <div class="table-responsive">
                
                <table id="table" class="table table-sm table-striped table-bordered table-hover" width="100%" cellspacing="0">
                    
                    <thead>
                        <tr class="small">
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
                            <tr class="small">
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

    <div class="modal fade" id="edit-item-modal" tabindex="-1" role="dialog" aria-labelledby="update-modal" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-modal">Comprovantes de Entradas</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="edit-form" class="needs-validation" method="POST" novalidate enctype="multipart/form-data">
                    <div class="modal-body">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-sm-12 mb-3">
                                <p class="col-sm">Caixa</p>
                                <input multiple type="file" class="form-control-file" id="exampleFormControlFile1" name="files[]" >
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <p class="col-sm">Cartão</p>
                                <input multiple type="file" class="form-control-file" id="exampleFormControlFile1" name="files[]">
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <p class="col-sm">Banco</p>
                                <input multiple type="file" class="form-control-file" id="exampleFormControlFile1" name="files[]">
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
                    $('#edit-observacao').val(response.observacao);
                    $('#edit-observacao2').val(response.observacao2);
                    // $('#edit-form').attr('action', `saidas/${editItemId}`);
                    $('#edit-form').attr('action', `entradas-documentos/${editItemId}`);

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
