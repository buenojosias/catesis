<div>
    <div class="card mb-4">
        <div class="card-header">
            <h3 class="card-title">Catequizandos</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover whitespace-nowrap">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Idade</th>
                        <th>Status</th>
                        <th>Faltas</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                        <tr>
                            <td><a href="{{ route('students.show', $student) }}">{{ $student->name }}</a></td>
                            <td>{{ $student->age }} anos</td>
                            <td>{{ $student->pivot->status }}</td>
                            <td>
                                {{ $student->encounters->count() }}
                            </td>
                            <td class="text-right">
                                <x-button href="{{ route('students.show', $student) }}" flat sm icon="eye" />
                            </td>
                        </tr>
                    @empty
                        <x-empty label="Nenhum catequizando adicionado." />
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
