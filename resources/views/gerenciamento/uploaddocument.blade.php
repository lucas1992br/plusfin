
<x-aplicativo-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Envio de Documentos
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
    <p>
        <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
          Filtros <i class="fa fa-filter" aria-hidden="true"></i>
        </a>
    </p>
    <div class="collapse" id="collapseExample">
        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('envio-documentos.index') }}" method="get">
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
        </div>

        <div class="card-body">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            @component('components.dataTable',
                [
                    'headers' => ['Data', 'Conta', 'Origem', 'Fonte Pagante', 'Forma de Pagamento', 'Valor', 'Estagio', 'Ações'],
                ])

                @slot('data')
                    @foreach ($methods ?? '' as $item)
                        <tr class="small">
                            <td title="{{ $item->data }}">{{ \Carbon\Carbon::parse($item->data)->format('d/m/Y')}}</td>
                            <td title="{{ $item->conta }}">{{ $item->conta }}</td>
                            <td title="{{ $item->origin->nome }}">{{ $item->origin->nome }}</td>
                            <td title="{{ $item->payings_sources->nome }}">{{ $item->payings_sources->nome }}</td>
                            <td title="{{ $item->payments_methods->nome }}">{{ $item->payments_methods->nome }}</td>
                            <td title="{{ $item->valor }}">{{ 'R$ '.number_format($item->valor, 2, ',', '.') }}</td>
                            <td title="{{$item->status}}" class="badge bg-primary text-white rounded align-middle">{{$item->status}}</td>
                            <td title="Ações">
                                <a role="button" class="delete-row-js" data-route="{{route('saidas.destroy',$item->id)}}">
                                    <i class="fa fa-trash _i text-danger"></i>
                                </a>
                                <a role="button" class="edit-row-js" data-route="{{route('saidas.show', $item->id)}}">
                                    <i class="fa fa-edit _i text-navy"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @endslot

            @endcomponent
        </div>
    </div>

    <div class="modal fade" id="edit-item-modal" tabindex="-1" role="dialog" aria-labelledby="update-modal" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="update-modal">Envio de Documentos</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form id="edit-form" class="needs-validation" method="POST" novalidate enctype="multipart/form-data">
                    <div class="modal-body">
                        @method('PUT')
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-12 mb-3">
                                <input multiple type="file" class="form-control-file" id="exampleFormControlFile1" name="files[]">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label" >Observação - Gestor</label>
                                <textarea class="form-control" id="edit-observacao" name="observacao"></textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label" >Observação - Administrativo</label>
                                <textarea class="form-control" id="edit-observacao2" name="observacao2"></textarea>
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
                    $('#edit-form').attr('action', `envio-documentos/${editItemId}`);

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
