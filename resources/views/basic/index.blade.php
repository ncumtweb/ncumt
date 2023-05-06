@extends('basic.main')

@section('title',  '首頁')

@section('content')

  <main id="main">

    <!-- ======= Hero Slider Section ======= -->
    <section id="hero-slider" class="hero-slider">
      <div class="container-md" data-aos="fade-in">
        <div class="row">
          <div class="col-12">
            <div class="swiper sliderFeaturedPosts">
              <div class="swiper-wrapper">
                <div class="swiper-slide">
                  <a href="single-post.html" class="img-bg d-flex align-items-end" style="background-image: url('assets/img/mouse.jpg');">
                    <div class="img-bg-inner"> 
                      <h2>2023.02.26-28 鍛鍊海鼠</h2>
                      <p>
                        踏上過往太魯閣族、日本人以及榮民曾經生活過的土地，沿路都能看到他們過往生活的痕
                        跡，百年來不同族群來來去去，看著遺留下來的歷史建築、文物，不禁感慨萬千。太魯閣
                        險峻壯闊的山勢如同帶刺的玫瑰，美麗動人卻危險，一不小心失足就會跌入萬丈深淵，期
                        待下次能再來拜訪太魯閣的山，續寫下一段山中的故事。
                      </p>
                    </div>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="single-post.html" class="img-bg d-flex align-items-end" style="background-image: url('assets/img/river.jpg');">
                    <div class="img-bg-inner">
                      <h2>2023.03.05 梅花溪</h2>
                      <p>溯溪讚</p>
                    </div>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="single-post.html" class="img-bg d-flex align-items-end" style="background-image: url('assets/img/cat.jpg');">
                    <div class="img-bg-inner">
                      <h2>2023.04.08-09 龍貓公車</h2>
                      <p>龍貓公車讚</p>
                    </div>
                  </a>
                </div>

                <div class="swiper-slide">
                  <a href="single-post.html" class="img-bg d-flex align-items-end" style="background-image: url('assets/img/eight.jpg');">
                    <div class="img-bg-inner">
                      <h2>2023.02.04-06 清水台黎明神社</h2>
                      <p>
                        何其幸運，能夠一瞥這些歷史洗刷後的滄海桑田，
                        我們只不過是偶然拜訪旁觀者，嘗試推敲想像伏地索道上一批一批木材從眼前運送、
                        木馬道上火車隆隆聲、神社參拜者的莊嚴肅穆、黎明遺址宿泊所旅客的熙來攘往、
                        埋頭苦幹以石英砂岩砌出平整駁坎牆面的工人們、索道頭無止運轉的纜繩、
                        各式酒瓶散落前的觥籌交錯…
                      </p>
                    </div>
                  </a>
                </div>
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

    <!-- ======= Post Grid Section ======= -->
    <section id="posts" class="posts">
      <div class="container" data-aos="fade-up">
        <div class="row g-5">
          <div class="col-lg-4">
            <div class="post-entry-1 lg">
              <a href="single-post.html"><img src="assets/img/post-landscape-1.jpg" alt="" class="img-fluid"></a>
              <div class="post-meta"><span class="date">Culture</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
              <h2><a href="single-post.html">11 Work From Home Part-Time Jobs You Can Do Now</a></h2>
              <p class="mb-4 d-block">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Vero temporibus repudiandae, inventore pariatur numquam cumque possimus exercitationem? Nihil tempore odit ab minus eveniet praesentium, similique blanditiis molestiae ut saepe perspiciatis officia nemo, eos quae cumque. Accusamus fugiat architecto rerum animi atque eveniet, quo, praesentium dignissimos</p>

              <div class="d-flex align-items-center author">
                <div class="photo"><img src="assets/img/person-1.jpg" alt="" class="img-fluid"></div>
                <div class="name">
                  <h3 class="m-0 p-0">Cameron Williamson</h3>
                </div>
              </div>
            </div>

          </div>

          <div class="col-lg-8">
            <div class="row g-5">
              <div class="col-lg-4 border-start custom-border">
                <div class="post-entry-1">
                  <a href="single-post.html"><img src="assets/img/post-landscape-2.jpg" alt="" class="img-fluid"></a>
                  <div class="post-meta"><span class="date">Sport</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                  <h2><a href="single-post.html">Let’s Get Back to Work, New York</a></h2>
                </div>
                <div class="post-entry-1">
                  <a href="single-post.html"><img src="assets/img/post-landscape-5.jpg" alt="" class="img-fluid"></a>
                  <div class="post-meta"><span class="date">Food</span> <span class="mx-1">&bullet;</span> <span>Jul 17th '22</span></div>
                  <h2><a href="single-post.html">How to Avoid Distraction and Stay Focused During Video Calls?</a></h2>
                </div>
                <div class="post-entry-1">
                  <a href="single-post.html"><img src="assets/img/post-landscape-7.jpg" alt="" class="img-fluid"></a>
                  <div class="post-meta"><span class="date">Design</span> <span class="mx-1">&bullet;</span> <span>Mar 15th '22</span></div>
                  <h2><a href="single-post.html">Why Craigslist Tampa Is One of The Most Interesting Places On the Web?</a></h2>
                </div>
              </div>
              <div class="col-lg-4 border-start custom-border">
                <div class="post-entry-1">
                  <a href="single-post.html"><img src="assets/img/post-landscape-3.jpg" alt="" class="img-fluid"></a>
                  <div class="post-meta"><span class="date">Business</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                  <h2><a href="single-post.html">6 Easy Steps To Create Your Own Cute Merch For Instagram</a></h2>
                </div>
                <div class="post-entry-1">
                  <a href="single-post.html"><img src="assets/img/post-landscape-6.jpg" alt="" class="img-fluid"></a>
                  <div class="post-meta"><span class="date">Tech</span> <span class="mx-1">&bullet;</span> <span>Mar 1st '22</span></div>
                  <h2><a href="single-post.html">10 Life-Changing Hacks Every Working Mom Should Know</a></h2>
                </div>
                <div class="post-entry-1">
                  <a href="single-post.html"><img src="assets/img/post-landscape-8.jpg" alt="" class="img-fluid"></a>
                  <div class="post-meta"><span class="date">Travel</span> <span class="mx-1">&bullet;</span> <span>Jul 5th '22</span></div>
                  <h2><a href="single-post.html">5 Great Startup Tips for Female Founders</a></h2>
                </div>
              </div>

              <!-- Trending Section -->
              <div class="col-lg-4">

                <div class="trending">
                  <h3>Trending</h3>
                  <ul class="trending-post">
                    <li>
                      <a href="single-post.html">
                        <span class="number">1</span>
                        <h3>The Best Homemade Masks for Face (keep the Pimples Away)</h3>
                        <span class="author">Jane Cooper</span>
                      </a>
                    </li>
                    <li>
                      <a href="single-post.html">
                        <span class="number">2</span>
                        <h3>17 Pictures of Medium Length Hair in Layers That Will Inspire Your New Haircut</h3>
                        <span class="author">Wade Warren</span>
                      </a>
                    </li>
                    <li>
                      <a href="single-post.html">
                        <span class="number">3</span>
                        <h3>13 Amazing Poems from Shel Silverstein with Valuable Life Lessons</h3>
                        <span class="author">Esther Howard</span>
                      </a>
                    </li>
                    <li>
                      <a href="single-post.html">
                        <span class="number">4</span>
                        <h3>9 Half-up/half-down Hairstyles for Long and Medium Hair</h3>
                        <span class="author">Cameron Williamson</span>
                      </a>
                    </li>
                    <li>
                      <a href="single-post.html">
                        <span class="number">5</span>
                        <h3>Life Insurance And Pregnancy: A Working Mom’s Guide</h3>
                        <span class="author">Jenny Wilson</span>
                      </a>
                    </li>
                  </ul>
                </div>

              </div> <!-- End Trending Section -->
            </div>
          </div>

        </div> <!-- End .row -->
      </div>
    </section> <!-- End Post Grid Section -->

