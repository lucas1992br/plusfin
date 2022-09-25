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
        <form action="{{ route('saidas.index') }}" method="get">
            @csrf
            <h2>Filtros</h2>
            <div class="container">
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
                        <label>Excluidas</label>
                        <select class="form-select-item select form-control form-control-sm" name="excluida_search">
                            <option value="">Selecione</option>
                            <option value="Não">Não</option>
                            <option value="Sim">Sim</option>                          
                        </select>
                    </div>
                    <div class="col">
                        <label>Estagio</label>
                        <select class="form-select-item select form-control form-control-sm" name="status">
                            <option value="">Selecione</option>
                            <option value="Atualização Pendente">Atualização Pendente</option>
                            <option value="Aprovação Pendente">Aprovação Pendente</option>
                            <option value="Pagamento Pendente">Pagamento Pendente</option>
                            <option value="Envio De Documentos Pendente">Envio De Documentos Pendente</option>
                            <option value="Paga">Paga</option>
                        </select>
                    </div>
                    <div class="col">
                        <label>Origem:</label>
                        <select class="form-select-item select form-control form-control-sm" name="origin_search">
                            <option value="">Selecione uma Origem</option>
                            @foreach($origins as $item)
                                <option value="{{ $item->id }}">{{ $item->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label>Forma Pag:</label>
                        <select class="form-select-item select form-control form-control-sm" name="payments_methods_search">
                            <option value="">Selecione uma Forma de Pagamento</option>
                            @foreach($payments_methods as $item)
                                <option value="{{ $item->id }}">{{ $item->nome }}</option>
                            @endforeach                       
                        </select>
                    </div>
                    <div class="input-field col s6">
                        <label>Fonte Pagante</label>
                        <select class="form-select-item select form-control form-control-sm" name="paying_sources_search">
                            <option value="">Selecione uma Fonte Pagante</option>
                            @foreach($payings_sources as $item)
                            <option value="{{ $item->id }}">{{ $item->nome }}</option>
                             @endforeach                          
                        </select>
                    </div>
                    <div class="col">
                    </br>
                        <button type="submit" class="btn btn-secondary btn-sm"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>