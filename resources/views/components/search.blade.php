@php
    use App\Models\Origin;
    use App\Models\PaymentMethod;
    use App\Models\PayingSource; 

    $payments_methods = PaymentMethod::where('tipo','Saida')->where('status','Ativo')->get();
    $payings_sources = PayingSource::where('tipo','Saida')->where('status','Ativo')->get();
    $origins = Origin::all('nome', 'id');    
@endphp

<p>
    <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
      Filtros <i class="fa fa-filter" aria-hidden="true"></i>
    </a>
</p>
<div class="collapse" id="collapseExample">
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
                                <option value="">Todas</option>
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
                                <option value="">Todas</option>
                                @foreach($origins as $item)
                                    <option value="{{ $item->id }}">{{ $item->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label>Forma Pag:</label>
                            <select class="form-select-item select form-control form-control-sm" name="payments_methods_search">
                                <option value="">Todas</option>
                                @foreach($payments_methods as $item)
                                    <option value="{{ $item->id }}">{{ $item->nome }}</option>
                                @endforeach                       
                            </select>
                        </div>
                        <div class="col">
                            <label>Fonte Pagante</label>
                            <select class="form-select-item select form-control form-control-sm" name="paying_sources_search">
                                <option value="">Todas</option>
                                @foreach($payings_sources as $item)
                                <option value="{{ $item->id }}">{{ $item->nome }}</option>
                                 @endforeach                          
                            </select>
                        </div>
                        <div class="col">
                            <label>Pesquisar</label>
                            <button type="submit" class="btn btn-secondary btn-sm"><i class="fa fa-search" aria-hidden="true"></i>Pesquisar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>
