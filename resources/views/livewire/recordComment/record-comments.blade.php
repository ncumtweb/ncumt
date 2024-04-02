<div class="row">
    <div class="col-md-12 post-content">
        <!-- ======= Comments ======= -->
        <div class="comments">
            <h2 class="comment-title py-4">評論({{ $recordComments->count() }})</h2>
            <div class="border border-primary rounded p-4 mb-4">
                @foreach($recordComments as $recordComment)
                    <div class="comment d-flex mb-4">
                        <div class="flex-shrink-0">
                            <div class="avatar avatar-sm rounded-circle">
                                <img class="avatar-img" src={{ asset("assets/img/favicon.png") }} alt=""
                                     class="img-fluid">
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-2 ms-sm-3 ">
                            <div class="bg-light">
                                <div class="comment-meta d-flex">
                                    <h6 class="me-2">{{ $recordComment->user->name_zh }}</h6>
                                    <span class="text-muted">{{ $recordComment->created_at }}</span>
                                </div>
                                <div class="comment-body">
                                    {{ $recordComment->content }}
                                </div>
                            </div>
                            @if($recordComment->replies->count() > 0)
                                <livewire:record-comment-replies :recordCommentId="$recordComment->id"
                                                                 :replyCount="$recordComment->replies->count()"
                                                                 wire:key="$recordComment->id"/>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div><!-- End Comments -->
        <!-- ======= Comments Form ======= -->
        @guest
            <a class="mb-4" href="{{ route('portal.index') }}">請先登入才能發表評論。（點我登入）</a>
        @endguest
        @auth
            <div class="row justify-content-center mt-2">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="content">評論</label>
                            @if($successMessage)
                                <div class="alert alert-success mt-3">{{ $successMessage }}</div>
                            @endif
                            <textarea class="form-control" id="content" placeholder="留下你的評論"
                                      wire:model.defer="content"
                                      cols="10" rows="3">
                        </textarea>
                        </div>
                        <div class="col-12">
                            <button wire:click="postComment" class="btn btn-primary">發表評論</button>
                        </div>
                    </div>
                </div>
            </div><!-- End Comments Form -->
        @endauth
    </div>
</div>
