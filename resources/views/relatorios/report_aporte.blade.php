<x-aplicativo-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Relatorio Aporte / Retirada
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
                <form action="{{ route('relatorio-aporte.index') }}" method="get">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <label>Data Inicio</label>
                                <input type="date" class="form-control form-control-sm" name="data_inicial_search">
                            </div> 
                            <div class="col">
                                <label>Data Final</label>
                                <input type="date" class="form-control form-control-sm" name="data_final_search">
                            </div>    
                            <div class="col">
                                <label>Aporte/Retirada</label>
                                <select class="form-select-item select form-control form-control-sm" name="tipo_search">
                                    <option value="Aporte">Aporte</option>
                                    <option value="Retirada">Retirada</option>                        
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
            <a class="btn-primary p-2 rounded small text-decoration-none" href="{{ route('relatorio-aporte.export') }}">
                <i class="fa-download fas mr-2"></i>
                Exportar
            </a>
        </div>
        <div class="card-body">               
            <meta name="csrf-token" content="{{ csrf_token() }}">
            @component('components.dataTable',
                [
                    'headers' => ['Data', 'Conta', 'Fonte Pagante', 'Valor'],
                ])

                @slot('data')
                    @foreach ($methods ?? '' as $item)
                        <tr>
                            <td title="{{ $item->data }}">{{ \Carbon\Carbon::parse($item->data)->format('d/m/Y')}}</td>
                            <td title="{{ $item->observacao }}">{{ $item->observacao }}</td>
                            <td title="{{ $item->payments_methods->nome }}">{{ $item->payments_methods->nome }}</td>
                            <td title="{{ $item->valor }}">{{ 'R$ '.number_format($item->valor, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tfoot class="small">
                        <td class="bg-light"></td>
                        <td class="bg-light"></td>
                        <td class="bg-light">Total</td>
                        <td class="bg-light">{{ 'R$ '.number_format($somatoria, 2, ',', '.') }}</td>
                        
                    </tfoot>
                @endslot

            @endcomponent
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
                    $('#edit-nome').val(response.nome);
                    $('#edit-atividade').val(response.activity.id);
                    $('#edit-tipo').val(response.tipo);
                    $('#edit-status').val(response.status);
                    $('#edit-form').attr('action', `fonte-pagante/${editItemId}`);

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
