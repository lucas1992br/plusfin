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
                       
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>..</th>
                        <th>Janeiro</th>
                        <th>Fevereiro</th>
                        <th>Março</th>
                        <th>Abril</th>
                        <th>Maio</th>
                        <th>Junho</th>
                        <th>Julho</th>
                        <th>Agosto</th>
                        <th>Setembro</th>
                        <th>Outubro</th>
                        <th>Novembro</th>
                        <th>Dezembro</th>
                    </tr>
                </thead>

                <tbody>
                    <tr class="table-info">
                        <th>Receitas Brutas</th>
                        <th>{{ 'R$ '.number_format($sumOrigin[1], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOrigin[2], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOrigin[3], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOrigin[4], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOrigin[5], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOrigin[6], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOrigin[7], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOrigin[8], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOrigin[9], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOrigin[10], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOrigin[11], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOrigin[12], 2, ',', '.') }}</th>
                    </tr>
                    <tr class="table-info">
                        <th> Origens Total</th>
                        <th>{{ 'R$ '.number_format($sumOrigin[1], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOrigin[2], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOrigin[3], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOrigin[4], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOrigin[5], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOrigin[6], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOrigin[7], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOrigin[8], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOrigin[9], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOrigin[10], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOrigin[11], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOrigin[12], 2, ',', '.') }}</th>
                    </tr>
                    @foreach($arrorigens as $origens) 
                        @php
                            $janeiro = 0;
                            $fevereiro = 0;
                            $marco = 0;
                            $abril = 0;
                            $maio = 0;
                            $junho = 0;
                            $julho = 0;
                            $agosto = 0;
                            $setembro = 0;
                            $outubro = 0;
                            $novembro = 0;
                            $dezembro = 0;
                        @endphp    
                        <tr>
                            @switch($origens)
                                
                                @case('1')
                                <td>{{ $arrNomeOriogin[0] }}</td>
                                @break

                                @case('2')
                                    <td>{{ $arrNomeOriogin[1] }}</td>
                                @break

                                @case('3')
                                    <td>{{ $arrNomeOriogin[2] }}</td>
                                @break

                                @case('4')
                                    <td>{{ $arrNomeOriogin[3] }}</td>
                                @break         
                                
                                @default
                                    
                            @endswitch               
                            @foreach($input as $inp)
                                @php
                                    if($inp->origin_id == $origens && $inp->mes == 1){
                                        $janeiro = $inp->Total;
                                    }
                                    if($inp->origin_id == $origens && $inp->mes == 2){
                                        $fevereiro = $inp->Total;
                                    }
                                    if($inp->origin_id == $origens && $inp->mes == 3){
                                        $marco = $inp->Total;
                                    }
                                    if($inp->origin_id == $origens && $inp->mes == 4){
                                        $abril = $inp->Total;
                                    }
                                    if($inp->origin_id == $origens && $inp->mes == 5){
                                        $maio = $inp->Total;
                                    }
                                    if($inp->origin_id == $origens && $inp->mes == 6){
                                        $junho = $inp->Total;
                                    }
                                    if($inp->origin_id == $origens && $inp->mes == 7){
                                        $julho = $inp->Total;
                                    }
                                    if($inp->origin_id == $origens && $inp->mes == 8){
                                        $agosto = $inp->Total;
                                    }
                                    if($inp->origin_id == $origens && $inp->mes == 9){
                                        $setembro = $inp->Total;
                                    }
                                    if($inp->origin_id == $origens && $inp->mes == 10){
                                        $outubro = $inp->Total;
                                    }
                                    if($inp->origin_id == $origens && $inp->mes == 11){
                                        $novembro = $inp->Total;
                                    }
                                    if($inp->origin_id == $origens && $inp->mes == 12){
                                        $dezembro = $inp->Total;
                                    }
                                @endphp
                            @endforeach
                            <td>{{ 'R$ '.number_format($janeiro, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($fevereiro, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($marco, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($abril, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($maio, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($junho, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($julho, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($agosto, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($setembro, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($outubro, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($novembro, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($dezembro, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr class="table-info">
                        <th>Formas Recebimento Total</th>
                        <th>{{ 'R$ '.number_format($sumPayment[1], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumPayment[2], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumPayment[3], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumPayment[4], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumPayment[5], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumPayment[6], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumPayment[7], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumPayment[8], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumPayment[9], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumPayment[10], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumPayment[11], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumPayment[12], 2, ',', '.') }}</th>
                    </tr>
                    @foreach($arrpayment as $payment) 
                        @php
                            $janeiro = 0;
                            $fevereiro = 0;
                            $marco = 0;
                            $abril = 0;
                            $maio = 0;
                            $junho = 0;
                            $julho = 0;
                            $agosto = 0;
                            $setembro = 0;
                            $outubro = 0;
                            $novembro = 0;
                            $dezembro = 0;
                        @endphp    
                        <tr>
                            @switch($payment)
                                
                                @case('1')
                                    <td>{{ $arrNomePayment[0] }}</td>
                                @break
                                @case('2')
                                    <td>{{ $arrNomePayment[1] }}</td>
                                @break
                                @case('3')
                                    <td>{{ $arrNomePayment[2] }}</td>
                                @break
                                @case('4')
                                    <td>{{ $arrNomePayment[3] }}</td>
                                @break 
                                @case('5')
                                    <td>{{ $arrNomePayment[4] }}</td>
                                @break 
                                @case('6')
                                    <td>{{ $arrNomePayment[5] }}</td>
                                @break                               
                            
                                @default
                                    
                            @endswitch               
                            @foreach($dre_payment as $inp)
                                @php
                                    if($inp->payment_methods_id == $payment && $inp->mes == 1){
                                        $janeiro = $inp->Total;
                                    }
                                    if($inp->payment_methods_id == $payment && $inp->mes == 2){
                                        $fevereiro = $inp->Total;
                                    }
                                    if($inp->payment_methods_id == $payment && $inp->mes == 3){
                                        $marco = $inp->Total;
                                    }
                                    if($inp->payment_methods_id == $payment && $inp->mes == 4){
                                        $abril = $inp->Total;
                                    }
                                    if($inp->payment_methods_id == $payment && $inp->mes == 5){
                                        $maio = $inp->Total;
                                    }
                                    if($inp->payment_methods_id == $payment && $inp->mes == 6){
                                        $junho = $inp->Total;
                                    }
                                    if($inp->payment_methods_id == $payment && $inp->mes == 7){
                                        $julho = $inp->Total;
                                    }
                                    if($inp->payment_methods_id == $payment && $inp->mes == 8){
                                        $agosto = $inp->Total;
                                    }
                                    if($inp->payment_methods_id == $payment && $inp->mes == 9){
                                        $setembro = $inp->Total;
                                    }
                                    if($inp->payment_methods_id == $payment && $inp->mes == 10){
                                        $outubro = $inp->Total;
                                    }
                                    if($inp->payment_methods_id == $payment && $inp->mes == 11){
                                        $novembro = $inp->Total;
                                    }
                                    if($inp->payment_methods_id == $payment && $inp->mes == 12){
                                        $dezembro = $inp->Total;
                                    }
                                @endphp
                            @endforeach
                            <td>{{ 'R$ '.number_format($janeiro, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($fevereiro, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($marco, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($abril, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($maio, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($junho, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($julho, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($agosto, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($setembro, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($outubro, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($novembro, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($dezembro, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr class="table-info">
                        <th>Custos Total</th>
                        <th>{{ 'R$ '.number_format($sumOutput[1], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOutput[2], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOutput[3], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOutput[4], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOutput[5], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOutput[6], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOutput[7], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOutput[8], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOutput[9], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOutput[10], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOutput[11], 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format($sumOutput[12], 2, ',', '.') }}</th>
                    </tr>
                    @foreach($arroutput as $output) 
                        @php
                            $janeiro = 0;
                            $fevereiro = 0;
                            $marco = 0;
                            $abril = 0;
                            $maio = 0;
                            $junho = 0;
                            $julho = 0;
                            $agosto = 0;
                            $setembro = 0;
                            $outubro = 0;
                            $novembro = 0;
                            $dezembro = 0;
                        @endphp    
                        <tr>
                            @switch($output)
                                
                                @case('1')
                                    <td>{{ $arrNomeOriogin[0] }}</td>
                                @break
                                @case('2')
                                    <td>{{ $arrNomeOriogin[1] }}</td>
                                @break
                                @case('3')
                                    <td>{{ $arrNomeOriogin[2] }}</td>
                                @break
                                @case('4')
                                    <td>{{ $arrNomeOriogin[3] }}</td>
                                @break 
                                @case('5')
                                    <td>{{ $arrNomeOriogin[4] }}</td>
                                @break 
                                @case('6')
                                    <td>{{ $arrNomeOriogin[5] }}</td>
                                @break                               
                            
                                @default
                                    
                            @endswitch               
                            @foreach($outputs as $inp)                         
                                @php
                                    if($inp->origin_id == $output && $inp->mes == 1){
                                        $janeiro = $inp->Total;
                                    }
                                    if($inp->origin_id == $output && $inp->mes == 2){
                                        $fevereiro = $inp->Total;
                                    }
                                    if($inp->origin_id == $output && $inp->mes == 3){
                                        $marco = $inp->Total;
                                    }
                                    if($inp->origin_id == $output && $inp->mes == 4){
                                        $abril = $inp->Total;
                                    }
                                    if($inp->origin_id == $output && $inp->mes == 5){
                                        $maio = $inp->Total;
                                    }
                                    if($inp->origin_id == $output && $inp->mes == 6){
                                        $junho = $inp->Total;
                                    }
                                    if($inp->origin_id == $output && $inp->mes == 7){
                                        $julho = $inp->Total;
                                    }
                                    if($inp->origin_id == $output && $inp->mes == 8){
                                        $agosto = $inp->Total;
                                    }
                                    if($inp->origin_id == $output && $inp->mes == 9){
                                        $setembro = $inp->Total;
                                    }
                                    if($inp->origin_id == $output && $inp->mes == 10){
                                        $outubro = $inp->Total;
                                    }
                                    if($inp->origin_id == $output && $inp->mes == 11){
                                        $novembro = $inp->Total;
                                    }
                                    if($inp->origin_id == $output && $inp->mes == 12){
                                        $dezembro = $inp->Total;
                                    }
                                @endphp
                            @endforeach
                            <td>{{ 'R$ '.number_format($janeiro, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($fevereiro, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($marco, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($abril, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($maio, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($junho, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($julho, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($agosto, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($setembro, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($outubro, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($novembro, 2, ',', '.') }}</td>
                            <td>{{ 'R$ '.number_format($dezembro, 2, ',', '.') }}</td>
                        </tr>
                    @endforeach
                    <tr class="table-success">
                        <th>LL</th>
                        <th>{{ 'R$ '.number_format(($sumOrigin[1] - $sumOutput[1]), 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format(($sumOrigin[2] - $sumOutput[2]), 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format(($sumOrigin[3] - $sumOutput[3]), 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format(($sumOrigin[4] - $sumOutput[4]), 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format(($sumOrigin[5] - $sumOutput[5]), 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format(($sumOrigin[6] - $sumOutput[6]), 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format(($sumOrigin[7] - $sumOutput[7]), 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format(($sumOrigin[8] - $sumOutput[8]), 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format(($sumOrigin[9] - $sumOutput[9]), 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format(($sumOrigin[10] - $sumOutput[10]), 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format(($sumOrigin[11] - $sumOutput[11]), 2, ',', '.') }}</th>
                        <th>{{ 'R$ '.number_format(($sumOrigin[12] - $sumOutput[12]), 2, ',', '.') }}</th>
                    </tr>
                    
                </tbody>
            
            </table>




            
            
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
