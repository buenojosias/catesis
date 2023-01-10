<div>
    <div class="card">
        <div class="card-body table-responsive">
            <table class="table table-hover whitespace-nowrap">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Catequizandos</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grades as $grade)
                        <tr>
                            <td><a href="{{ route('grades.show', $grade) }}">{{ $grade->title }}</a></td>
                            <td>{{ $grade->active_students_count }}</td>
                            <td class="text-right">
                                <x-button href="{{ route('grades.show', $grade) }}" flat primary sm
                                    icon="eye" />
                                @can('grade_edit')
                                    <x-button href="#" flat primary sm icon="pencil" />
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
