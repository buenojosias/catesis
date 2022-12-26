<div>
    <div class="card">
        <form wire:submit.prevent="submit">
            <div class="card-body">
                {{ $this->form }}
            </div>
            <div class="card-footer">
                <button type="submit">
                    Submit
                </button>
            </div>
        </form>
    </div>
</div>
