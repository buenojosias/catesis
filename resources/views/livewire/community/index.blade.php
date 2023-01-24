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
                    @foreach ($communities as $community)
                        <tr>
                            <td><a href="{{ route('communities.show', $community) }}">{{ $community->name }}</a></td>
                            <td>
                                <ul>
                                    @foreach ($community->coordinators as $coordinator)
                                        {!! '<li>' . $coordinator->name . '</li>' !!}
                                    @endforeach
                                </ul>
                            </td>
                            <td>{{ $community->users_count }}</td>
                            <td>{{ $community->active_students_count }}</td>
                            <td class="text-right">
                                <x-button href="{{ route('communities.show', $community) }}" flat sm icon="eye" />
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
