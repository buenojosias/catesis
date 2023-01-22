<div class="sm:grid sm:grid-cols-2 sm:space-x-4">
    <div>
        @livewire('pastoral.related-list', ['model' => $student])
    </div>
    <div>
        @livewire('student.documents', ['student' => $student])
    </div>
</div>
