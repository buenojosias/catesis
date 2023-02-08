<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            {{-- <x-native-select id="email" name="email" label="Selecione um usuário para entrar" required autofocus>
                <option value="">Selecione</option>
                @foreach (\App\Models\User::query()->where('id', '<', 26)->get() as $user)
                    <option value="{{$user->email}}">{{ $user->name }}</option>
                @endforeach
            </x-native-select> --}}
            <x-input id="email" class="block mt-1 w-full" type="email" label="E-mail" name="email"
                :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            {{-- <input type="hidden" id="password" name="password" value="123456" /> --}}
            <x-input id="password" class="block mt-1 w-full" type="password" name="password" label="Senha"
                required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ml-2 text-sm text-gray-600">Manter conectado</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    Esqueci minha senha
                </a>
            @endif

            <x-button type="submit" label="Entrar" primary />
        </div>
    </form>
</x-guest-layout>
