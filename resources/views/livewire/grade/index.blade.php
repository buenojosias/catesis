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
                                <x-button href="{{ route('grades.show', $grade) }}" sm flat icon="eye" />
                                @can('grade_edit')
                                    <x-button href="#" sm flat icon="pencil" />
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
