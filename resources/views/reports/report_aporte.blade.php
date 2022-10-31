<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Data</th>
        <th scope="col">Conta</th>
        <th scope="col">Fonte Pagante</th>
        <th scope="col">Valor</th>
      </tr>
    </thead>
    <tbody>
        @foreach ($methods ?? '' as $item)
        <tr>
            <td title="{{ $item->data }}">{{ \Carbon\Carbon::parse($item->data)->format('d/m/Y')}}</td>
            <td title="{{ $item->observacao }}">{{ $item->observacao }}</td>
            <td title="{{ $item->payments_methods->nome }}">{{ $item->payments_methods->nome }}</td>
            <td title="{{ $item->valor }}">{{ 'R$ '.number_format($item->valor, 2, ',', '.') }}</td>
        </tr>
    @endforeach
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td class="bg-light">Total</td>
            <td class="bg-light">{{ 'R$ '.number_format($somatoria, 2, ',', '.') }}</td>   
        </tr>
    </tbody>
    
  </table>