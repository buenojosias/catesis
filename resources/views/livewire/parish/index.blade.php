<div>
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-hover whitespace-nowrap">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Coordenador(es)</th>
                        <th>Catequistas</th>
                        <th>Catequizandos</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parishes as $parish)
                        <tr>
                            <td><a href="{{ route('parishes.show', $parish) }}">{{ $parish->name }}</a></td>
                            <td>
                                <ul>
                                    @foreach ($parish->coordinators as $coordinator)
                                        {!! '<li>' . $coordinator->name . '</li>' !!}
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $parish->users_count }}</td>
                            <td>{{ $parish->active_students_count }}</td>
                            <td class="text-right">
                                <x-button href="{{ route('parishes.show', $parish) }}" flat sm icon="eye" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
