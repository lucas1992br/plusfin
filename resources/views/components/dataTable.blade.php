<div class="table-responsive">
    <table id="table" class="table table-striped table-bordered table-hover" width="100%" cellspacing="0">
        <thead>
            <tr>
                @foreach ($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            {{ $data }}
        </tbody>
    </table>
</div>
