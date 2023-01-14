<div>
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Familiares</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover whitespace-nowrap">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Parentesco</th>
                        <th>Responsável</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kinships as $kinship)
                        <tr>
                            <td>{{ $kinship->name }}</td>
                            <td>{{ $kinship->pivot->title }}</td>
                            <td>{{ $kinship->pivot->is_enroller }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
