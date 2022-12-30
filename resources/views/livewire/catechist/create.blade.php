<div>
    <form wire:submit.prevent="submit">
        <div class="form-card mb-6">
            <div class="heading">
                <h3>Informações básicas</h3>
            </div>
            <div class="body">
                <div class="grid sm:grid-cols-4 gap-4">
                    <div class="sm:col-span-4">
                        <x-text-input type="text" wire:model="name" name="name" label="Nome completo" required />
                    </div>
                    <div class="sm:col-span-2">
                        <x-text-input type="date" wire:model="birth" name="birth" label="Data de nascimento"
                            max="{{ Carbon\Carbon::now()->subYears(13)->format('Y-m-d') }}" required />
                    </div>
                    <div class="sm:col-span-2">
                        <label for="marital_status" class="block mb-1 font-medium text-sm text-gray-700">Estado civil</label>
                        <select wire:model="marital_status" name="marital_status" id="marital_status"
                            class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option value="Solteiro(a)">Solteiro(a)</option>
                            <option value="Casado(a)">Casado(a)</option>
                            <option value="Viúvo(a)">Viúvo(a)</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>
                    <div class="sm:col-span-4">
                        <label for="community_id" class="block mb-1 font-medium text-sm text-gray-700">Comunidade</label>
                        <select name="community_id" wire:model="community_id" id="community_id" class="w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                            <option>Selecione</option>
                            @foreach ($communities as $community)
                                <option value="{{$community->id}}">{{$community->name}}</option>
                            @endforeach
                        </select>
                    </div>

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
                        <x-text-input wire:model="email" type="email" name="email" label="E-mail" required />
                    </div>
                    <div class="sm:col-span-2">
                        <x-text-input wire:model="password" type="password" name="password" label="Senha" required />
                    </div>
                    <div class="sm:col-span-2">
                        <x-text-input wire:model="password_confirmation" type="password" name="password_confirmation" label="Confirme a senha" required />
                    </div>
                    <div class="sm:col-span-4">
                        <h3 class="mb-2 font-medium text-sm text-gray-700">Função(ões)</h3>
                        @foreach ($roles as $role)
                            <div class="flex items-center mb-2">
                                <input type="checkbox" wire:model="selected_roles.{{$role->id}}"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 focus:ring-2">
                                <label for="default-checkbox" class="ml-2 text-sm font-medium text-gray-600">{{$role->label}}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-4 sm:text-right">
            <button type="submit" class="btn btn-primary">Salvar</button>
        </div>
    </form>

</div>
