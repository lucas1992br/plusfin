@section('content_header')
<h2 class="font-semibold text-xl text-gray-800 leading-tight">
    Relatorio DRE
</h2>
@stop
<x-aplicativo-layout>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-end">
            <a class="btn-primary p-2 rounded text-decoration-none btn-sm">
                <i class="fa-download fas mr-2"></i>
                Exportar
            </a> 
            <a class="btn-primary p-2 rounded text-decoration-none btn-sm ml-2" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                Filtros <i class="fa fa-filter" aria-hidden="true"></i>
            </a>
        </div>
        <div class="collapse" id="collapseExample">
            <div>
                <div class="card-body">
                    <form action="{{ route('dre.index') }}" method="get">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col">
                                    <label>Mês Inicio</label>
                                    <input type="Month" class="form-control form-control-sm">
                                </div> 
                                <div class="col">
                                    <label>Mês Final</label>
                                    <input type="Month" class="form-control form-control-sm">
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
          <div class="card-body">
            <meta name="csrf-token" content="{{ csrf_token() }}">
            @component('components.dataTable',
                [
                    'headers' => ['Origen', 'Valor'],
                ])
    
                @slot('data')
                    @foreach ($input_origins ?? '' as $item)
                    <tr>
                        <td title="{{ $item->origin_id }}">{{ $item->origin_id }}</td>
                        <td title="{{ $item->Total }}">{{ 'R$ '.number_format($item->Total, 2, ',', '.') }}</td>                
                    </tr>
                    @endforeach 
                    <tr>
                        <td><b>Formas de Recebimento</b></td>
                        <td><b>Valor</b></td>                
                    </tr>
                    @foreach ($input_payment ?? '' as $item)
                    <tr>
                        <td title="{{ $item->payment_methods_id }}">{{ $item->payment_methods_id }}</td>
                        <td title="{{ $item->Total }}">{{ 'R$ '.number_format($item->Total, 2, ',', '.') }}</td>                
                    </tr>
                    @endforeach                  
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
