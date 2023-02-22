<div class="card mt-4" x-data="{ showTextarea: false }">
    <div class="card-header">
        <h3 class="card-title">Comentários</h3>
        @if ($canAddComment)
        <div class="card-tools">
            <x-button x-show="!showTextarea" @click="showTextarea = true" xs outline primary label="Adicionar comentário" />
        </div>
        @endif
    </div>
    <div class="card-body">
        @if ($canAddComment)
        <div x-show="showTextarea" @close-textarea.window="showTextarea = false" class="py-2 px-4 border-b">
            <x-errors class="mb-4" />
            <x-textarea wire:model.defer="commentDescription" placeholder="Adicionar novo comentário" rows="2"
                required />
            <div class="mt-2 flex space-x-2">
                <x-button wire:click="resetDescription" @click="showTextarea = false" sm flat label="Cancelar" />
                <x-button wire:click="submitComment" sm primary label="Salvar" />
            </div>
        </div>
        @endif
        <ul>
            @forelse ($comments as $comment)
                <li class="py-4 px-4 border-b text-sm">
                    <p class="text-gray-700">
                        <a href="{{ route('catechists.show', $comment->user) }}"
                            class="font-medium">{{ $comment->user->name }}</a> •
                        {{ $comment->created_at->format('d/m/Y H:i') }}
                    </p>
                    <p class="mt-1">{{ $comment->description }}</p>
                </li>
            @empty
                <div x-show="!showTextarea">
                    <x-empty label="Nenhum comentário adicionado." />
                </div>
            @endforelse
        </ul>
    </div>
</div>
