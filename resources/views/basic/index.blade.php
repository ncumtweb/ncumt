@extends('basic.main')

@section('title',  '首頁')

@section('content')
<!-- ======= Hero Slider Section ======= -->
<section id="hero-slider" class="hero-slider">
  <div class="container-md" data-aos="fade-in">
    <div class="row">
      <div class="col-12">
        <div class="swiper sliderFeaturedPosts">
          <div class="swiper-wrapper">
          @foreach($records as $record)
            <div class="swiper-slide">
                <a href="{{ route('record.show', $record->id )}}" class="img-bg d-flex align-items-end" style="background-image: url({{ asset($record->image) }});">
                  <div class="img-bg-inner"> 
                    <h2>{{ $record->start_date . "-" . $record->end_date }}</h2>
                    <h2>{{ $record->name }}</h2>
                    <p>{{ $record->description }}</p> 
                  </div>
                </a>              
            </div>
          @endforeach
          </div>
          <div class="custom-swiper-button-next">
            <span class="bi-chevron-right"></span>
          </div>
          <div class="custom-swiper-button-prev">
            <span class="bi-chevron-left"></span>
          </div>

          <div class="swiper-pagination"></div>
        </div>
      </div>
    </div>
  </div>
</section><!-- End Hero Slider Section -->

@if (session('status'))
  <div class="col-lg-12 text-center mb-5">
    <h6 class="alert alert-success">{{ session('status') }}</h6>
  </div>
@endif

<!-- start post -->
<section class="signa-table-section clearfix">
      <div class="container">
         <div class="row">
            <div class="col-lg">
              <table id="post-table" class="table table-hover">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">公告類別</th>
                    <th scope="col">公告</th>
                    <th scope="col">發布者</th>
                    <!-- 幹部才能編輯 -->
                    @auth
                      @if(Auth::user()->role > 0)  
                        <th scope="col">編輯/刪除</th>
                      @endif
                    @endauth
                  </tr>
                </thead>
                <tbody>
                    @if($posts->count() > 0)
                      @foreach($posts as $post)
                        <!-- 置頂 -->
                        @if($post->pin == 1)  
                          <tr data-bs-toggle="modal" data-bs-target="#x{{ $post->id }}">  
                            <td class="postshow" data-toggle="modal" data-target="#Modal"><i class="bi bi-pin-angle-fill"></i> {{ $loop->index + 1 }} </td>
                            <td> <span class="{{ $tag_array[$post->type] }}">{{ $type_array[$post->type] }}</span></td>
                            <td> {{ $post->title }}</td>
                            
                            <td> {{ $post->user->name_zh }}</td>
                            @auth
                              @if(Auth::user()->role > 0) 
                                <td>
                                  <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                                    <button type = "button" class="bi bi-pencil-square" onclick="window.location='{{ route('post.edit', $post->id) }}'"></button>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bi bi-trash"></button>
                                  </form>
                                </td>
                              @endif
                            @endauth
                          </tr>
                        <!-- 非置頂 -->
                        @else
                          <tr data-bs-toggle="modal" data-bs-target="#x{{ $post->id }}">  
                            <td class="postshow" data-toggle="modal" data-target="#Modal"><i class="bi bi-card-text"></i> {{ $loop->index + 1 }} </td>
                            <td> <span class="{{ $tag_array[$post->type] }}">{{ $type_array[$post->type] }}</span></td>
                            <td> {{ $post->title }}</td>
                            <td> {{ $post->user->name_zh }}</td>
                            @auth
                              @if(Auth::user()->role > 0) 
                                <td>
                                  <form action="{{ route('post.destroy', $post->id) }}" method="POST">
                                    <button type = "button" class="bi bi-pencil-square" onclick="window.location='{{ route('post.edit', $post->id) }}'"></button>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bi bi-trash"></button>
                                  </form>
                                </td>
                              @endif
                            @endauth
                          </tr>
                        @endif
                          <!-- Modal -->
                          <div class="modal fade" id="x{{ $post->id }}" tabindex="-1"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel">{{ $post->title }}</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                  {!!  $post->content !!}
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
                                </div>
                              </div>
                            </div>
                          </div>
                      @endforeach
                    @else
                      <tr>
                        <td colspan = '4'>目前暫無公告</td>
                      </tr>
                    @endif
                </tbody>
              </table>
            </div>
         </div>
      </div>
    </section>
<!-- end post -->

@endsection
