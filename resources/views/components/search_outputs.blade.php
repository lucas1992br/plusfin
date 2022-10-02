@php
    use App\Models\Origin;
    use App\Models\PaymentMethod;
    use App\Models\PayingSource; 

    $payments_methods = PaymentMethod::all('nome', 'id');
    $payings_sources = PayingSource::all('nome', 'id');
    $origins = Origin::all('nome', 'id');    
@endphp
<div class="card shadow mb-4">
    <div class="card-body">
        <form action="{{ route('atualizar-saidas.index') }}" method="get">
            @csrf
            <h2>Filtros</h2>
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
                        <button type="submit" class="btn btn-secondary btn-sm"><i class="fa fa-search" aria-hidden="true"></i>Pesquisar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>