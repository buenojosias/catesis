<x-app-layout>
    <section class="flex items-center h-full p-16 text-gray-600">
        <div class="container flex flex-col items-center justify-center px-5 mx-auto my-8">
            <div class="max-w-md text-center">
                <h2 class="mb-8 font-bold text-9xl text-sky-900">
                    <span class="sr-only">Erro</span>404
                </h2>
                <p class="text-2xl font-semibold md:text-3xl">Página não encontrada.</p>
                <p class="mt-4 mb-8 text-gray-600">
                    A página ou registro que você está tentando acessar não está disponível.
                </p>
                <a href="{{ route('dashboard') }}" href="#" class="px-8 py-3 font-semibold rounded bg-sky-600 text-gray-100">Voltar para a página inicial</a>
            </div>
        </div>
    </section>
</x-app-layout>
