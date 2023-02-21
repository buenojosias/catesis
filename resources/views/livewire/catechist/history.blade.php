<div class="md:max-w-3xl mx-auto">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Histórico de grupos</h3>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-hover whitespace-nowrap">
                <thead>
                    <tr>
                        <th>Ano</th>
                        <th>Etapa</th>
                        <th>Catequizandos</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($groups as $group)
                        <tr>
                            <td>{{ $group->year }}</td>
                            <td>
                                <a href="{{ route('groups.show', $group) }}">{{ $group->grade->title }}</a>
                            </td>
                            <td>{{ $group->students_count }}</td>
                        </tr>
                    @empty
                        <x-empty span="3" />
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if (auth()->user()->can('catechist_edit') || $catechist->id === auth()->user()->id)
        <div x-data="{ 'showTrainings': false }" class="card mt-4">
            <div class="card-header">
                <h3 @click="showTrainings = !showTrainings" wire:click="loadTrainings"
                    class="card-title cursor-pointer">Formação Específica em Catequética</h3>
            </div>
            <div x-show="showTrainings" class="card-body py-2 px-4">
                @if ($catechist->id === auth()->user()->id)
                    <p class="mb-2 text-sm">Assinale as formações que possui.</p>
                @endif
                @if ($trainings)
                    <ul>
                        @foreach ($trainings as $training)
                            <li
                                class="py-1 flex items-center space-x-2 {{ $catechist->id !== auth()->user()->id ? 'border-b last:border-none' : '' }}">
                                @if ($catechist->id === auth()->user()->id)
                                    <x-checkbox :label="$training['title']" wire:model.defer="catechistTrainings"
                                        wire:change="syncTraining({{ $training['id'] }})" :value="$training['id']" />
                                @else
                                    <div class="w-4">
                                        <x-icon name="check"
                                            class="w-4 h-4 {{ in_array($training->id, $catechistTrainings) ? 'text-green-500' : 'text-gray-100' }}"
                                            solid />
                                    </div>
                                    <div>{{ $training->title }}</div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    @endif
</div>
