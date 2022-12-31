<div>
    <x-dialog />
    <x-errors class="mb-4 shadow" />
    <form wire:submit.prevent="submit">
        <div class="form-card mb-6">
            <div class="heading">
                <h3>Informações básicas</h3>
            </div>
            <div class="body">
                <div class="grid sm:grid-cols-4 gap-4">
                    <div class="sm:col-span-4">
                        <x-text-input type="text" wire:model.defer="name" name="name" label="Nome completo" required />
                    </div>
                    <div class="sm:col-span-2">
                        <x-datetime-picker
                            without-time
                            without-tips
                            wire:model.defer="birth"
                            :max="now()->subYears(13)"
                            label="Data de nascimento"
                            placeholder="Selecione"
                        />
                        {{-- <x-text-input type="date" wire:model.defer="birth" name="birth" label="Data de nascimento"
                            max="{{ Carbon\Carbon::now()->subYears(13)->format('Y-m-d') }}" required /> --}}
                    </div>
                    <div class="sm:col-span-2">
                        <label for="marital_status" class="block mb-1 font-medium text-sm text-gray-700">Estado civil</label>
                        <select wire:model.defer="marital_status" name="marital_status" id="marital_status"
                            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">Selecione</option>
                            <option value="Solteiro(a)">Solteiro(a)</option>
                            <option value="Casado(a)">Casado(a)</option>
                            <option value="Viúvo(a)">Viúvo(a)</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>
                    @role('admin')
                    <div class="sm:col-span-4">
                        <label for="community_id" class="block mb-1 font-medium text-sm text-gray-700">Comunidade</label>
                        <select name="community_id" wire:model.defer="community_id" id="community_id" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">Selecione</option>
                            @foreach ($communities as $community)
                                <option value="{{$community->id}}">{{$community->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    @endrole
                </div>
            </div>
        </div>

        <div class="form-card">
            <div class="heading">
                <h3>Conta</h3>
            </div>
            <div class="body">
                <div class="grid sm:grid-cols-4 gap-4">
                    <div class="sm:col-span-4">
                        <x-text-input wire:model.defer="email" type="email" name="email" label="E-mail" required />
                    </div>
                    <div class="sm:col-span-2">
                        <x-text-input wire:model.defer="password" type="password" name="password" label="Senha" required />
                    </div>
                    <div class="sm:col-span-2">
                        <x-text-input wire:model.defer="password_confirmation" type="password" name="password_confirmation" label="Confirme a senha" required />
                    </div>
                    <div class="sm:col-span-4">
                        <label for="role" class="block mb-1 font-medium text-sm text-gray-700">Função</label>
                        <select name="role" wire:model.defer="role" id="role" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="">Selecione</option>
                            @foreach ($roles as $role)
                                <option value="{{$role->id}}">{{$role->label}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-4 sm:text-right">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>

</div>
