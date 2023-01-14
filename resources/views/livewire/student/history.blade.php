<div>
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Histórico de etapas</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover whitespace-nowrap">
                <thead>
                    <tr>
                        <th>Ano</th>
                        <th>Etapa</th>
                        <th>Matrícula</th>
                        <th>Aprovado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($groups as $group)
                        <tr>
                            <td>{{ $group->year }}</td>
                            <td>{{ $group->grade->title }}</td>
                            <td>{{ $group->pivot->matriculation_id }}</td>
                            <td>{{ $group->pivot->approved }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
