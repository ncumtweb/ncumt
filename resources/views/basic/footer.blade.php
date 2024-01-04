@php
    use App\Models\Record;
    $records = Record::orderBy('start_date','desc')->take(5)->get();
    $category_array = ["中級山", "高山", "溯溪"];
@endphp


<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="footer-content">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6">
                    <h3 class="footer-heading">中央大學登山社</h3>
                    <p>
                        中大登山社於民國 64 年創立，
                        幹部、社員人數眾多，從平易近人的高山百岳和歷史古道、專精的技能訓練與實作到深度探勘原始山林皆有涉略，
                        亦有從事攀岩、溯溪、單車等活動。 在山社裡將可以交到一群能患難與共、一同歡笑、一同去挑戰自我的朋友，因愛山而相遇、
                        因愛山而成為了幹部，希望能夠把山的美好傳承下去。歡迎各位加入我們的登山行列，漫遊台灣山林，與我們在山林中飽覽大自然令人驚嘆的美、
                        體驗冒險帶來的樂趣、挑戰從未探索的新事物。若想瞭解更多歡迎關注我們的 FB 粉絲團及 Instagram！
                    </p>
                    <p><a href="{{ url('/aboutus') }}" class="footer-link-more">關於我們</a></p>
                </div>
                <div class="col-6 col-lg-2">
                    <h3 class="footer-heading">其他連結</h3>
                    <ul class="footer-links list-unstyled">
                        <li><a href="/"><i class="bi bi-chevron-right"></i> 首頁 </a></li>            
                        <li><a href="{{ route('course.index') }}"><i class="bi bi-chevron-right"></i> 社課影片 </a></li>
                        <li><a href="{{ url('/judgement') }}"><i class="bi bi-chevron-right"></i> 評分系統 </a></li>
                        <li><a href="{{ route('record.index') }}"><i class="bi bi-chevron-right"></i> 行程記錄 </a></li>
                        <li><a href="{{ url('/aboutus') }}"><i class="bi bi-chevron-right"></i> 關於我們 </a></li>
                        <li><a href="https://www.facebook.com/ncumountaineeringclub" target="_blank"><i class="bi bi-chevron-right"></i> 聯絡我們 </a></li>
                        <li><a href="{{ route('faq.index') }}"><i class="bi bi-chevron-right"></i> FAQ </a></li>
                    </ul>
                </div>
                <!-- <div class="col-6 col-lg-2">
                    <h3 class="footer-heading">Categories</h3>
                    <ul class="footer-links list-unstyled">
                        <li><a href="category.html"><i class="bi bi-chevron-right"></i> Business</a></li>
                        <li><a href="category.html"><i class="bi bi-chevron-right"></i> Culture</a></li>
                        <li><a href="category.html"><i class="bi bi-chevron-right"></i> Sport</a></li>
                        <li><a href="category.html"><i class="bi bi-chevron-right"></i> Food</a></li>
                        <li><a href="category.html"><i class="bi bi-chevron-right"></i> Politics</a></li>
                        <li><a href="category.html"><i class="bi bi-chevron-right"></i> Celebrity</a></li>
                        <li><a href="category.html"><i class="bi bi-chevron-right"></i> Startups</a></li>
                        <li><a href="category.html"><i class="bi bi-chevron-right"></i> Travel</a></li>

                    </ul>
                </div> -->
            
                <div class="col-lg-4">
                    <h3 class="footer-heading">近期紀錄</h3>
                    <ul class="footer-links footer-blog-entry list-unstyled">
                        @foreach($records as $record)
                            <li>
                            <a href="{{ route('record.show', $record->id )}}" class="d-flex align-items-center">
                                <img src="{{ asset($record->image) }}" alt="" class="img-fluid me-3">
                                <div>
                                <div class="post-meta d-block">
                                    <span class="date">{{ $category_array[$record->category] }}</span> 
                                    <span class="mx-1">&bullet;</span>
                                     <span>{{ $record->start_date }}-{{ $record->end_date }}</span></div>
                                <span>{{ $record->name }}</span>
                                </div>
                            </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-legal">
        <div class="container">
            <div class="row justify-content-between">
                    <div class="copyright">
                        © Copyright <strong><span>ZenBlog</span></strong>. All Rights Reserved <br>
                    </div>

                    <div class="credits">
                        <!-- All the links in the footer should remain intact. -->
                        <!-- You can delete the links only if you purchased the pro version. -->
                        <!-- Licensing information: https://bootstrapmade.com/license/ -->
                        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/herobiz-bootstrap-business-template/ -->
                        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="social-links mb-3 mb-lg-0 text-center text-md-end">
                        <a href="https://www.facebook.com/ncumountaineeringclub" target = "_blank" class="facebook"><i class="bi bi-facebook"></i></a>
                        <a href="https://www.instagram.com/ncumountaineeringclub/" target = "_blank" class="instagram"><i class="bi bi-instagram"></i></a>
                        <a href="https://github.com/ncumtweb/ncumt" target = "_blank" class="github"><i class="bi bi-github"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

<a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
<script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>


<!-- Template Main JS File -->
<script src="{{ asset('assets/js/main.js') }}"></script>
<script src="{{ asset('assets/js/snowstorm.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>

