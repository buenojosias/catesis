<aside :class="{ 'block': showsidebar, 'hidden': !showsidebar }"
    class="fixed z-20 h-full top-0 left-0 pt-10 flex lg:flex flex-shrink-0 flex-col w-64 bg-white"
    x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95"
    x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-90"
    x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95">
    <div class="relative flex-1 flex flex-col min-h-0 border-r border-gray-200 bg-white pt-0">
        <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
            <div class="flex-1 px-3 bg-white divide-y space-y-1">
                <ul class="space-y-2 pb-2">
                    <li>
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="home">Dashboard</x-nav-link>
                        <x-nav-link :href="route('students.index')" :active="request()->routeIs('students.*')" icon="children">Catequizandos</x-nav-link>
                        <x-nav-link :href="route('catechists.index')" :active="request()->routeIs('catechists.*')" icon="users">Catequistas</x-nav-link>
                    </li>
                </ul>
                <div class="space-y-2 pt-2">
                    <x-nav-link :href="route('groups.index')" :active="request()->routeIs('groups.*')" icon="people-group">Grupos</x-nav-link>
                    <x-nav-link :href="route('encounters.index')" :active="request()->routeIs('encounters.*')" icon="book">Encontros</x-nav-link>
                </div>
                <div class="space-y-2 pt-2">
                    @role('admin')
                        <x-nav-link :href="route('communities.index')" :active="request()->routeIs('communities.*')" icon="church">Comunidades</x-nav-link>
                    @endrole
                    <x-nav-link :href="route('grades.index')" :active="request()->routeIs('grades.*')" icon="list-ol">Etapas</x-nav-link>
                    <x-nav-link :href="route('events.index')" :active="request()->routeIs('events.*')" icon="calendar-alt">Agenda de eventos</x-nav-link>
                    <x-nav-link :href="route('kinships.index')" :active="request()->routeIs('kinships.*')" icon="people-line">Familiares</x-nav-link>
                    <x-nav-link :href="route('pastorals.index')" :active="request()->routeIs('pastorals.*')" icon="circle-nodes">Movimentos e Pastorais</x-nav-link>
                </div>
                <div class="space-y-2 pt-2">
                    @can('student_edit')
                        <x-nav-link :href="route('enrollments')" :active="request()->routeIs('enrollments')" icon="clipboard">Festa das inscrições</x-nav-link>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</aside>
<div @click="showsidebar = false" x-show="showsidebar" class="bg-gray-900 lg:hidden opacity-50 fixed inset-0 z-10">
</div>
