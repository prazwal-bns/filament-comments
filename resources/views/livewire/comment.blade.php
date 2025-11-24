<div style="display: flex; flex-direction: column; gap: 1.5rem;">
    @php
        $displayNameColumn = config('filament-comments.display_name_column');
    @endphp
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">
        <div
            style="border-radius: 12px; border: 1px solid #e2e8f0; background: #ffffff; padding: 1.5rem; box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1); transition: all 0.2s ease;"
            onmouseover="this.style.boxShadow='0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1)';"
            onmouseout="this.style.boxShadow='0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1)';">
            <div style="display: flex; align-items: flex-start; gap: 1rem;">
                <div
                    style="height: 48px; width: 48px; overflow: hidden; border-radius: 50%; border: 2px solid #e0e7ff; background: linear-gradient(135deg, #e0e7ff 0%, #ddd6fe 100%); flex-shrink: 0;">
                    <img src="{{ $this->getAvatarUrl() }}" alt="{{ $comment->user->{$displayNameColumn} }}"
                        style="height: 100%; width: 100%; object-fit: cover;" />
                </div>

                <div style="flex: 1; display: flex; flex-direction: column; gap: 0.875rem; min-width: 0;">
                    <div style="display: flex; flex-wrap: wrap; align-items: baseline; justify-content: space-between; gap: 0.75rem;">
                        <p style="font-size: 1rem; font-weight: 600; color: #1e293b; margin: 0;">
                            {{ $comment->user->{$displayNameColumn} }}
                        </p>
                        <p style="font-size: 0.75rem; letter-spacing: 0.05em; text-transform: uppercase; color: #94a3b8; margin: 0; font-weight: 500;">
                            {{ $comment->created_at->diffForHumans() }}
                        </p>
                    </div>

                    <div style="font-size: 0.9375rem; line-height: 1.7; color: #475569; word-wrap: break-word;">
                        {!! str($comment->body)->sanitizeHtml() !!}
                    </div>

                    <div style="display: flex; flex-wrap: wrap; align-items: center; gap: 0.5rem; font-size: 0.875rem;">
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
                style="border-radius: 12px; border: 1px dashed #cbd5e1; background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%); padding: 1.5rem; margin-top: 0.5rem;">
                <form style="display: flex; flex-direction: column; gap: 1.25rem;"
                    wire:submit="{{ $this->editing ? 'update' : 'create' }}">
                    {{ $this->form }}
                    <div style="display: flex; gap: 0.75rem;">
                        <x-filament::button type="submit" size="md">
                            {{ $this->editing ? 'Update' : 'Reply' }}
                        </x-filament::button>
                        <x-filament::button color="gray" type="button" wire:click="cancel" size="md">
                            Cancel
                        </x-filament::button>
                    </div>
                </form>
            </div>
        @endif

        @if ($hasReplies && $comment->replies->count())
            <div
                style="display: flex; flex-direction: column; gap: 1.25rem; border-left: 2px solid #e2e8f0; padding-left: 1.75rem; margin-top: 0.5rem;">
                @foreach ($replies as $reply)
                    @livewire('comment', ['comment' => $reply, 'hasReplies' => false, 'pagination' => false], key($reply->id))
                @endforeach

                @if ($pagination)
                    <div style="display: flex; align-items: center; gap: 0.75rem; margin-top: 0.5rem;">
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
