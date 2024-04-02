<div class="comment-replies mt-2 rounded">
    <h6 class="comment-replies-title mb-4 text-muted text-uppercase" wire:click="toggleReplies({{ $recordCommentId
    }})">顯示回覆({{ $replyCount }})</h6>
    @foreach($recordCommentReplies as $recordCommentReply)
        <div class="reply d-flex mb-2 bg-light" wire:key="{{ $recordCommentReply->id }}">
            <div class="flex-grow-1 ms-2 ms-sm-3">
                <div class="reply-meta d-flex align-items-baseline">
                    <h6 class="mb-0 me-2">{{ $recordCommentReply->user->name_zh }}</h6>
                    <span class="text-muted">{{ $recordCommentReply->created_at }}</span>
                </div>
                <div class="reply-body">
                    {{ $recordCommentReply->content }}
                </div>

            </div>
        </div>
    @endforeach
    @guest
        <a class="mb-4" href="{{ route('portal.index') }}">請先登入才能回覆此評論。（點我登入）</a>
    @endguest
    @auth
        <div class="row justify-content-center mt-2">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-10 mb-3">
                        @if($successMessage)
                            <div class="alert alert-success mt-3">{{ $successMessage }}</div>
                        @endif
                        <textarea class="form-control" id="content" placeholder="留下你的回覆"
                                  wire:model.defer="content"
                                  cols="10" rows="1">
                                    </textarea>
                    </div>
                    <div class="col-2">
                        <button wire:click="postReply" class="btn btn-primary">回覆</button>
                    </div>
                </div>
            </div>
        </div><!-- End Comments Form -->
    @endauth
</div>
