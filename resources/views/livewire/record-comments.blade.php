<div class="row">
    <div class="col-md-12 post-content">
        <!-- ======= Comments ======= -->
        <div class="comments">
            <h5 class="comment-title py-4">評論</h5>
            @foreach($recordComments as $recordComment)
                <div class="comment d-flex mb-4">
                    <div class="flex-grow-1 ms-2 ms-sm-3 ">
                        <div class="comment-meta d-flex align-items-baseline">
                            <h6 class="me-2">{{ $recordComment->user->name_zh }}</h6>
                            <span class="text-muted">{{ $recordComment->created_at }}</span>
                        </div>
                        <div class="comment-body bg-light">
                            {{ $recordComment->content }}
                        </div>
                        @if($recordComment->replies->count() > 0)
                            <livewire:record-comment-replies :recordCommentId="$recordComment->id"
                                                             :replyCount="$recordComment->replies->count()"
                                                             wire:key="$recordComment->id" />
                        @endif
                    </div>
                </div>
            @endforeach
        </div><!-- End Comments -->

        <!-- ======= Comments Form ======= -->
        <div class="row justify-content-center mt-5">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-12 mb-3">
                        <label for="content">評論</label>
                        @if($successMessage)
                            <div class="alert alert-success mt-3">{{ $successMessage }}</div>
                        @endif
                        <textarea class="form-control" id="content" placeholder="留下你的評論"
                                  wire:model.defer="content"
                                  cols="20" rows="5">
                        </textarea>
                    </div>
                    <div class="col-12">
                        <button wire:click="postComment" class="btn btn-primary">Post comment</button>
                    </div>
                </div>
            </div>
        </div><!-- End Comments Form -->
    </div>
</div>
