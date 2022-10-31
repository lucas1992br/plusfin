<x-aplicativo-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Planilha Contabilidade {{ $mes }}
      </h2>
  </x-slot>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
      <div class="card-header py-3 d-flex justify-content-end">
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
                                  <label class="small">Data Inicio</label>
                                  <input type="Month" class="form-control form-control-sm small">
                              </div> 
                              <div class="col">
                                  <label class="small">Data Final</label>
                                  <input type="Month" class="form-control form-control-sm small">
                              </div>                         
                              <div class="col">
                                  <label>..</label></br>
                                  <button type="submit" class="btn btn-secondary btn-sm"><i class="fa fa-search" aria-hidden="true"></i><small>Pesquisar</small></button>
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
                    'headers' => ['#', 'Data', 'Conta', 'Origem', 'Fonte Pagante', 'Forma de Pagamento', 'Valor']
                ])

                @slot('data')
                <form method="POST" action="{{ route('planilha-contabilidade.store') }}" class="needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    @foreach ($methods ?? '' as $item)
                        <tr>
                            <td><input type="checkbox" name="{{ $item->id}}" value="{{ $item->files}}" aria-label="input text"></td>
                            <td title="{{ $item->data }}"><small>{{ \Carbon\Carbon::parse($item->data)->format('d/m/Y')}}</small></td>
                            <td title="{{ $item->conta }}"><small>{{ $item->conta }}</small></td>
                            <td title="{{ $item->origin->nome }}"><small>{{ $item->origin->nome }}</small></td>
                            <td title="{{ $item->payings_sources->nome }}"><small>{{ $item->payings_sources->nome }}</small></td>
                            <td title="{{ $item->payments_methods->nome }}"><small>{{ $item->payments_methods->nome }}</small></td>
                            <td title="{{ $item->valor }}"><small>{{ 'R$ '.number_format($item->valor, 2, ',', '.') }}</small></td>                                 
                        </tr>
                    @endforeach
                    <div class="modal-footer">
                      <button class="btn btn-primary" type="submit"><i class="fa-download fas mr-2"></i> <small>Exportar</small></button>
                    </div>
                  </form>
                @endslot               
            @endcomponent
      </div>
  </div>

  <div class="modal fade" id="register-new-item-modal" tabindex="-1" role="dialog" aria-labelledby="register-modal" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="register-modal">Cadastro Metas</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <form method="POST" action="{{ route('fonte-pagante.store') }}" class="needs-validation" novalidate>
                  <div class="modal-body">
                      @csrf
                      <div class="form-row">
                          <div class="col-md-12 mb-3">
                              <label>Origem</label>
                              <select class="form-select-item select form-control form-control-sm" id="atividade" name="atividade" searchable="Search here.." required="true">
                                  <option value="">Selecione uma atividade</option>
                                  
                              </select>
                              
                          </div>
                          <div class="col-md-6 mb-3">
                              <label>Ano</label>
                              <input type="date" class="form-control form-control-sm">
                          </div>
                          <div class="col-md-6 mb-3">
                              <label>Valor</label>
                              <input type="text" class="form-control-sm form-control">
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

  <div class="modal fade" id="edit-item-modal" tabindex="-1" role="dialog" aria-labelledby="update-modal" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="update-modal">Editar Fonte Pagante</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">×</span>
                  </button>
              </div>
              <form id="edit-form" class="needs-validation" method="POST" novalidate>
                  <div class="modal-body">
                      @method('PUT')
                      @csrf
                      <div class="form-row">
                          <div class="col-md-4 mb-3">
                              <label for="validationTooltip01">Nome</label>
                              <input type="text" class="form-control form-control-sm" id="edit-nome" name="nome" placeholder="Nome" value="" required>
                              <div class="invalid-tooltip">
                                  Nome é obrigatório
                              </div>
                          </div>

                          <div class="col-md-4 mb-3">
                              <label>Atividade</label>
                              <select class="form-control form-control-sm" id="edit-atividade" name="atividade">
                                  
                              </select>
                          </div>

                          <div class="col-md-4 mb-3">
                              <label>Tipo</label>
                              <select class="form-control form-control-sm" id="edit-tipo" name="tipo">
                                  <option value="Entrada">Entrada</option>
                                  <option value="Saída">Saída</option>
                              </select>
                          </div>

                          <div class="col-md-4 mb-3">
                              <label>Status</label>
                              <select class="form-select-item form-control form-control-sm" id="edit-status" name="status" required="true">
                                  <option value="">Selecione um Status</option>
                                  <option>Ativo</option>
                                  <option>Inativo</option>
                              </select>
                              <div class="invalid-tooltip">
                                  O tipo é obrigatório
                              </div>
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
