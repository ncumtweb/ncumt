<div class="comment-replies mt-2 rounded">
    @if($replyCount == 0)
        @guest
            <div class="border border-primary rounded p-2 mb-2">
                <a class="clickable-text comment-desc mb-4"
                   href="{{ route('portal.index') }}">請先登入即可回覆此評論。（點我登入）</a>
            </div>
        @endguest
        @auth
            @if ($errors->has('content'))
                <div class="comment-desc alert alert-danger mt-2">
                    {{ $errors->first('content') }}
                </div>
            @endif
            <div class="row justify-content-center mt-2">
                <div class="col-lg-12">
                    <div class="row">
                        @if($successMessage)
                            <div class="comment-desc alert alert-success mt-1">{{ $successMessage }}</div>
                        @endif
                        <div class="col-9 mb-3">
                        <textarea class="comment-desc form-control" id="content" placeholder="留下你的回覆"
                                  wire:model.defer="content"
                                  cols="10" rows="1">
                        </textarea>
                        </div>
                        <div class="col-3">
                            <button wire:click="createRecordCommentReply" class="comment-replies-button">
                                回覆
                            </button>
                        </div>
                    </div>
                </div>
            </div><!-- End Comments Form -->
        @endauth
    @else
        <div class="row mb-2">
            <a wire:click="toggleReplies({{ $recordCommentId }})" class="clickable-text comment-desc">顯示回覆（{{
            $replyCount }}）</a>
        </div>
        <div class="row">
            @foreach($recordCommentReplies as $recordCommentReply)
                <div class="reply d-flex mb-2 bg-light" wire:key="recordCommentReply-{{ $recordCommentReply->id }}">
                    <div class="flex-grow-1 ms-2 ms-sm-3">
                        <div class="reply-meta d-flex align-items-baseline mb-2">
                            <h6 class="mb-0 me-2 comment-replies-title">{{ $recordCommentReply->user->name_zh }}</h6>
                            <span
                                class="text-muted me-2">{{ $recordCommentReply->created_at->format('Y-m-d H:i') }}</span>
                            @if(Auth::id() == $recordCommentReply->user_id)
                                <button wire:click="editRecordCommentReply({{ $recordCommentReply->id }})"
                                        class="bi bi-pencil-square me-1"></button>
                                <button onclick="confirmDelete('是否確定要刪除這則回覆？')"
                                        wire:click="deleteRecordCommentReply({{ $recordCommentReply->id }})"
                                        class="bi bi-trash"></button>
                            @endif
                        </div>
                        @if($selectedRecordCommentReplyId == $recordCommentReply->id)
                            @if ($errors->has('editContent'))
                                <div class="comment-desc alert alert-danger mt-2">
                                    {{ $errors->first('editContent') }}
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-9">
                                    <textarea wire:model.defer="editContent" class="form-control"
                                              rows="1"></textarea>
                                </div>
                                <div class="col-3">
                                    <button wire:click="saveEditRecordCommentReply({{ $recordCommentReply->id }})"
                                            class="comment-replies-button">保存
                                    </button>
                                </div>
                            </div>
                        @else
                            <div class="comment-replies-body">
                                {{ $recordCommentReply->content }}
                            </div>
                        @endif
                    </div>
                </div>
                @if($loop->index == $recordCommentReplies->count() - 1)
                    @guest
                        <div class="border border-primary rounded p-2 mb-2">
                            <a class="clickable-text comment-desc mb-4"
                               href="{{ route('portal.index') }}">請先登入即可回覆此評論。（點我登入）</a>
                        </div>
                    @endguest
                    @auth
                        @if ($errors->has('content'))
                            <div class="comment-desc alert alert-danger mt-2">
                                {{ $errors->first('content') }}
                            </div>
                        @endif
                        <div class="row justify-content-center mt-2">
                            <div class="col-lg-12">
                                <div class="row">
                                    @if($successMessage)
                                        <div class="comment-desc alert alert-success mt-1">{{ $successMessage }}</div>
                                    @endif
                                    <div class="col-9">
                                        <textarea class="comment-desc form-control" id="content" placeholder="留下你的回覆"
                                                  wire:model.defer="content"
                                                  cols="10" rows="1">
                                        </textarea>
                                    </div>
                                    <div class="col-3">
                                        <button wire:click="createRecordCommentReply"
                                                class="comment-replies-button">
                                            回覆
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Comments Form -->
                    @endauth
                @endif
            @endforeach
        </div>
    @endif
</div>
