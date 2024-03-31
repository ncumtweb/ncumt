<div class="comment-replies mt-2 rounded">
    <h6 class="comment-replies-title mb-4 text-muted text-uppercase" wire:click="toggleReplies({{ $recordCommentId
    }})">顯示回覆({{ $replyCount }})</h6>
    @foreach($recordCommentReplies as $recordCommentReply)
        <div class="reply d-flex mb-4" wire:key="{{ $recordCommentReply->id }}">
            <div class="flex-grow-1 ms-2 ms-sm-3">
                <div class="reply-meta d-flex align-items-baseline">
                    <h6 class="mb-0 me-2">{{ $recordCommentReply->user->name_zh }}</h6>
                    <span class="text-muted">{{ $recordCommentReply->created_at }}</span>
                </div>
                <div class="reply-body bg-light"">
                    {{ $recordCommentReply->content }}
                </div>
            </div>
        </div>
    @endforeach
</div>
