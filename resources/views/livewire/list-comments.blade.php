<div style="display: flex; flex-direction: column; gap: 1rem;">
    @if ($comments->isNotEmpty())
        @foreach ($comments as $comment)
            @livewire('comment', ['comment' => $comment, 'pagination' => true], key($comment->id))
        @endforeach
        <div style="display: flex; align-items: center; gap: 0.75rem;">
            @if ($showLess)
                <button type="button"
                    style="display: inline-flex; align-items: center; justify-content: center; gap: 0.35rem; padding: 0.5rem 1rem; font-size: 0.85rem; font-weight: 600; color: #0f172a; background: linear-gradient(90deg, #3b82f6, #6366f1); border: none; border-radius: 0.5rem; box-shadow: 0 10px 20px rgba(99,102,241,0.2); color: #fff; cursor: pointer;"
                    wire:click="loadLess">
                    <span>Show Less</span>
                    <x-filament::icon icon="heroicon-o-chevron-up" class="w-4 h-4 inline"
                        wire:loading.remove wire:target="loadLess" />
                </button>
            @endif
            @if ($showMore)
                <button type="button"
                    style="display: inline-flex; align-items: center; justify-content: center; gap: 0.35rem; padding: 0.5rem 1rem; font-size: 0.85rem; font-weight: 600; color: #fff; background: linear-gradient(90deg, #a855f7, #ec4899); border: none; border-radius: 0.5rem; box-shadow: 0 10px 20px rgba(236,72,153,0.2); cursor: pointer;"
                    wire:click="loadMore">
                    <span>Show More</span>
                    <x-filament::icon icon="heroicon-o-chevron-down" class="w-4 h-4 inline"
                        wire:loading.remove wire:target="loadMore" />
                </button>
            @endif
        </div>
    @endif
    @if ($comments->isEmpty())
        <p style="text-align: center;">No comments available.</p>
    @endif
    <div style="margin-top: 2rem;">
        @livewire('add-comment', ['record' => $record])
    </div>
</div>
