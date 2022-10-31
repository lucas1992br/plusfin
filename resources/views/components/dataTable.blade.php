<div class="table-responsive">
    <table id="table" class="table table-sm table-striped table-bordered table-hover" width="100%" cellspacing="0">
        <thead class="small">
            <tr>
                @foreach ($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody class="small">
            {{ $data }}
        </tbody>
    </table>
</div>
