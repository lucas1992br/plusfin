
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Entrada</h1>
@stop

@section('content')
@php
    use App\Models\Origin;
    $origins = Origin::where('status','Ativo')->where('tipo','Entrada')->get();
@endphp

<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-end">
        <a class="btn-success p-2 rounded text-decoration-none small mr-4" href="javascript:void(0)" data-toggle="modal"
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
    {{ $input }}
    <div class="card-body">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="col-sm-5 card ">
            <div>
                <p>Cadastro de Origens</p>
                <div class="col-sm-8">
                    <label class="form-label">Origens:</label>
                    <form method="POST" action="" class="needs-validation" novalidate>
                        @csrf 
                        <div class="row">
                            <div class="col-sm-5">
                                <input name='idEntrada' id='idEntrada'>
                                <select class="form-select-item select form-control form-control-sm" name="origin_id" id="origin_id" searchable="Search here.." required="true">
                                    <option value="">Selecione uma Origem</option>
                                    @foreach($origins as $item)
                                        <option value="{{ $item->id }}">{{ $item->nome }}</option>
                                    @endforeach
                                </select> 
                            </div>
                            <div class="col-sm-6">  
                                <label class="form-label" for="valor">Valor:</label>
                                <input type="text" id="valor" name="origin_valor" class="valor form-control-sm form-control o1" style="display:inline-block" onkeyup="SomatoriaOrigens()">
                            </div> 
                            <div class="col-sm-2">
                                <button class="btn-sm btn btn-primary" id="btnSalvarOrigens">add</button>
                            </div>                          
                        </div>                     
                    </form>
                </div>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>teste</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>gsfdhafsjdgfajshgf</td>  
                            <td>gsfdhafsjdgfajshgf</td>
                            <td>gsfdhafsjdgfajshgf</td>                   
                        <tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>






@stop

@section('js')
<script>
    let ress = await reqs.json();
    document.querySelector('#idEntrada').value=ress;
    let btnSalvarDetalhes = document.querySelector('#btnSalvarOrigens');
    btnSalvarDetalhes.addEventListener('click',async(e)=>{
        e.preventDefault();
        let id = document.querySelector('#idEntrada').value;
        let origin_id = document.querySelector('#origin_id').value;
        let origin_valor = document.querySelector('#valor').value;               
        let reqs = await fetch('entrada/detalhes',{
            method:'POST',
            headers:{
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body:JSON.stringify({
                'id': id,
                'origin_id':origin_id,
                'origin_valor':origin_valor,
                
            })
            
        });
        let ress = await reqs.json();      
        
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="js/jquery-easing/jquery.easing.min.js"></script>
<script src="js/chart.js/Chart.min.js"></script>
<script src="js/jquery/jquery.min.js"></script>
<script src="https://igorescobar.github.io/jQuery-Mask-Plugin/js/jquery.mask.min.js"></script>
<script src="js/bootstrap/js/bootstrap.bundle.min.js"></script>
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

       
    });
   
</script>
@stop

