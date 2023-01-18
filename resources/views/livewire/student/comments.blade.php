<div>
    <x-notifications />
    <div class="card" x-data="{ showTextarea: false }">
        <div class="card-header">
            <h3 class="card-title">Comentários</h3>
            <div class="card-tools">
                <x-button @click="showTextarea = true" xs outline primary label="Adicionar novo" />
            </div>
        </div>
        <div class="card-body">
            <div x-show="showTextarea" @close-textarea.window="showTextarea = false" class="py-2 px-4 border-b">
                <x-errors class="mb-4" />
                <x-textarea wire:model.defer="description" placeholder="Adicionar novo comentário" rows="2" required />
                <div class="mt-2 flex justify-end space-x-2">
                    <x-button wire:click="resetDescription" @click="showTextarea = false" sm flat label="Cancelar" />
                    <x-button wire:click="submitComment" sm primary label="Salvar" />
                </div>
            </div>
            <ul>
                @foreach ($comments as $comment)
                    <li class="py-4 px-4 border-b text-sm">
                        <p class="text-gray-700">
                            <a href="{{ route('catechists.show', $comment->user) }}" class="font-medium">{{ $comment->user->name }}</a> •
                            {{ $comment->created_at->format('d/m/Y H:i') }}</p>
                        <p class="mt-1">{{ $comment->description }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
