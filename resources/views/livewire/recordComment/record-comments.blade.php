<div class="row">
    <div class="col-lg-12 post-content">
        <!-- ======= Comments ======= -->
        <div class="comments">
            <h2 class="comment-title py-4">評論（{{ $recordComments->count() }}）</h2>
            <div class="border border-primary rounded p-4 mb-4">
                @foreach($recordComments as $recordComment)
                    <div class="comment d-flex mb-4" wire:key="recordComment-{{ $recordComment->id }}">
                        <div class="flex-shrink-0">
                            <div class="avatar avatar-sm rounded-circle">
                                <img class="avatar-img" src={{ asset("assets/img/favicon.png") }} alt=""
                                     class="img-fluid">
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-2 ms-sm-3">
                            <div class="bg-light">
                                <div class="comment-meta d-flex mb-2 align-items-baseline">
                                    <h6 class="mb-0 me-2 comment-title">{{ $recordComment->user->name_zh }}</h6>
                                    <span
                                        class="text-muted me-2">{{ $recordComment->created_at->format('Y-m-d H:i') }}</span>
                                    @if(Auth::id() == $recordComment->user_id)
                                        <button wire:click="editRecordComment({{ $recordComment->id }})"
                                                class="bi bi-pencil-square me-1"></button>
                                        <button onclick="confirmDelete('是否確定要刪除這則評論（回覆也會一起刪除）？')"
                                                wire:click="deleteRecordComment({{ $recordComment->id }})"
                                                class="bi bi-trash"></button>
                                    @endif
                                </div>
                                @if($selectedRecordCommentId == $recordComment->id)
                                    @if ($errors->has('editContent'))
                                        <div class="comment-desc alert alert-danger mt-2">
                                            {{ $errors->first('editContent') }}
                                        </div>
                                    @endif
                                    <textarea wire:model.defer="editContent" class="form-control"
                                              rows="3"></textarea>
                                    <button wire:click="saveEditRecordComment({{ $recordComment->id }})"
                                            class="comment-button mt-2">保存
                                    </button>
                                @else
                                    <div class="comment-body">
                                        {{ $recordComment->content }}
                                    </div>
                                @endif
                            </div>
                            @if($selectedRecordCommentId == null)
                                <livewire:record-comment.record-comment-replies :recordCommentId="$recordComment->id"
                                                                 :replyCount="$recordComment->replies->count()"
                                                                 wire:key="{{ now() }}"/>
                            @endif
                        </div>
                    </div>
                @endforeach
                <!-- ======= Comments Form ======= -->
                @guest
                    <div class="border border-primary rounded p-2 mb-2">
                        <a class="clickable-text mb-4 comment-desc"
                           href="{{ route('portal.index') }}">請先登入即可發表評論。（點我登入）</a>
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
                                <div class="comment-desc col-12 mb-3">
                                    <label for="content">評論</label>
                                    @if($successMessage)
                                        <div class="comment-desc alert alert-success mt-3">{{ $successMessage }}</div>
                                    @endif
                                    <textarea class="comment-desc form-control" id="content" placeholder="留下你的評論"
                                              wire:model.defer="content"
                                              cols="10" rows="3">
                                    </textarea>
                                </div>
                                <div class="col-12">
                                    <button wire:click="createRecordComment" class="comment-button">
                                        發表評論
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Comments Form -->
                @endauth
            </div>
        </div><!-- End Comments -->
    </div>
</div>
