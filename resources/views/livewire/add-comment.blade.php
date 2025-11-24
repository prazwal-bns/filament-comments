<div style="margin-top: 1.5rem;">
    <form style="display: flex; flex-direction: column; gap: 1rem;">
        {{ $this->form }}
        <x-filament::button style="align-self: flex-start;" wire:click="create">
            Add Comment
        </x-filament::button>
    </form>
</div>
