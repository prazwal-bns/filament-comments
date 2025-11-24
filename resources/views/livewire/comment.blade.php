<div style="display: flex; flex-direction: column; gap: 1.5rem;">
    @php
        $displayNameColumn = config('filament-comments.display_name_column');
    @endphp
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        <div
            style="border-radius: 16px; border: 1px solid rgba(15,23,42,0.08); background: rgba(255,255,255,0.95); padding: 1.25rem; box-shadow: 0 10px 25px rgba(15,23,42,0.05); backdrop-filter: blur(6px);">
            <div style="display: flex; align-items: flex-start; gap: 1rem;">
                <div
                    style="height: 48px; width: 48px; overflow: hidden; border-radius: 50%; border: 2px solid rgba(59,130,246,0.25);">
                    <img src="{{ $this->getAvatarUrl() }}" alt="{{ $comment->user->{$displayNameColumn} }}"
                        style="height: 100%; width: 100%; object-fit: cover;" />
                </div>

                <div style="flex: 1; display: flex; flex-direction: column; gap: 0.75rem;">
                    <div style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 0.75rem;">
                        <p style="font-size: 1rem; font-weight: 600; color: #0f172a;">
                            {{ $comment->user->{$displayNameColumn} }}
                        </p>
                        <p style="font-size: 0.65rem; letter-spacing: 0.15em; text-transform: uppercase; color: #94a3b8;">
                            {{ $comment->created_at->diffForHumans() }}
                        </p>
                    </div>

                    <div style="font-size: 0.95rem; line-height: 1.6; color: #475569;">
                        {!! str($comment->body)->sanitizeHtml() !!}
                    </div>

                    <div style="display: flex; flex-wrap: wrap; gap: 1rem; font-size: 0.85rem; color: #64748b;">
                        {{ $this->likeAction() }}
                        {{ $this->dislikeAction() }}
                        {{ $this->replyAction() }}
                        {{ $this->editAction() }}
                        {{ $this->deleteAction() }}
                    </div>
                </div>
            </div>
        </div>

        @if ($this->replyingTo === $comment->id || $this->editing === $comment->id)
            <div
                style="border-radius: 16px; border: 1px dashed rgba(15,23,42,0.15); background: rgba(241,245,249,0.95); padding: 1.25rem;">
                <form style="display: flex; flex-direction: column; gap: 1rem;"
                    wire:submit="{{ $this->editing ? 'update' : 'create' }}">
                    {{ $this->form }}
                    <div style="display: flex; gap: 0.75rem;">
                        <x-filament::button type="submit">
                            Reply
                        </x-filament::button>
                        <x-filament::button color="gray" type="button" wire:click="cancel">
                            Cancel
                        </x-filament::button>
                    </div>
                </form>
            </div>
        @endif

        @if ($hasReplies && $comment->replies->count())
            <div
                style="display: flex; flex-direction: column; gap: 1rem; border-inline-start: 2px solid rgba(226,232,240,0.9); padding-inline-start: 1.5rem;">
                @foreach ($replies as $reply)
                    @livewire('comment', ['comment' => $reply, 'hasReplies' => false, 'pagination' => false], key($reply->id))
                @endforeach

                @if ($pagination)
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        @if ($showLess)
                            <x-filament::button type="button" size="sm" color="gray" wire:click="loadLess"
                                wire:target="loadLess" wire:loading.attr="disabled" wire:loading.class="opacity-70">
                                <x-filament::icon icon="heroicon-o-chevron-up" class="h-4 w-4 me-1" />
                                Show Less
                            </x-filament::button>
                        @endif
                        @if ($showMore)
                            <x-filament::button type="button" size="sm" color="primary" wire:click="loadMore"
                                wire:target="loadMore" wire:loading.attr="disabled" wire:loading.class="opacity-70">
                                <x-filament::icon icon="heroicon-o-chevron-down" class="h-4 w-4 me-1" />
                                Show More
                            </x-filament::button>
                        @endif
                    </div>
                @endif
            </div>
        @endif
    </div>
    <x-filament-actions::modals />
</div>
