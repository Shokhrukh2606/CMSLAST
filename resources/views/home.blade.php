	<!-- MainSlider  -->
	<section class="mainSliderWrapper">
	    <div class="mainSlider owl-carousel owl-theme">
	        @foreach($sliders as $item)
	        <div class="item">
	            <div class="overlay"></div>
	            <div class="content">
	                <div class="container">
	                    <div class="row">
	                        <div class="col-md-6">
	                            <div class="description">
	                                <h2>
	                                    {!! limiter(getLangSpec($item->title, App::getLocale()), 40) !!}
	                                </h2>
	                                <p>
	                                    {!! limiter(getLangSpec($item->short_content, App::getLocale()), 210) !!}
	                                </p>
	                                <div class="moreButton">
	                                    <button>
	                                        подробнee
	                                    </button>
	                                </div>
	                            </div>
	                        </div>
	                        <div class="col-md-6">
	                            <div class="imgWrapper">
	                                <img src="{{$item->imgPath}}">
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        @endforeach
	    </div>
	</section>
	<!-- end mainSLider -->
	<!-- Services -->
	<!-- end Services -->
	<!-- Skills -->
	<section class="skills">
	    <div class="video">
	        <video width="400" id="video" poster="{{$about->imgPaths[0]}}">
	            <source src="{{$about->imgPaths[1]}}" type="video/mp4">
	            <!-- <source src="mov_bbb.ogg" type="video/ogg"> -->
	            Your browser does not support HTML5 video.
	        </video>
	        <img src="{{asset("images/video-play.png")}}" alt="video-play" class="video-play">
	    </div>
	    <div class="about-us">
	        <h2>{{getLangSpec($about->title,App::getLocale())}}</h2>
	        <p>{{getLangSpec($about->short_content,App::getLocale())}}</p>
	        <?php 
				$first=getOnePost(25);
				$second=getOnePost(26);
				$third=getOnePost(27);
			?>
	        <div class="title">{{getLangSpec($first->title,App::getLocale())}}</div>
	        <div class="progress">
	            <div class="progress-bar" style="width:{{getLangSpec($first->short_content,'ru')}}%">
	                <span></span>
	            </div>
	        </div>
	        <div class="title">{{getLangSpec($second->title,App::getLocale())}}</div>
	        <div class="progress">
	            <div class="progress-bar" style="width:{{getLangSpec($second->short_content,'ru')}}%">
	                <span></span>
	            </div>
	        </div>
	        <div class="title">{{getLangSpec($third->title,App::getLocale())}}</div>
	        <div class="progress">
	            <div class="progress-bar" style="width:{{getLangSpec($third->short_content,'ru')}}%">
	                <span></span>
	            </div>
	        </div>
	    </div>
	</section>
	<!-- end Skills -->
	<div class="services">
	    <h2>НАШИ УСЛУГИ</h2>
	    <div class="services-box">
	        <div class="container">
	            <div class="row">
	                @foreach($services as $item)
	                <div class="col-md-4">
	                    <div class="service-card">
	                        <img src="{{$item->imgPath}}" alt="not found">
	                        <div class="description">
	                            {{getLangSpec($item->title,App::getLocale())}}
	                        </div>
	                    </div>
	                </div>
	                @endforeach
	            </div>
	        </div>
	    </div>
	    <div class="seeMore">
	        <a href="#">Все услуги</a>
	    </div>
	</div>
	<!-- end Services -->
	<!-- Products -->
	<section class="products">
	    <div class="products-slider owl-carousel owl-theme">
	        @foreach($sliders as $item)
	        <div class="item">
	            <div class="container">
	                <div class="row">
	                    <div class="col-md-12">
	                        <div class="content">
	                            <h2> {!! limiter(getLangSpec($item->title, App::getLocale()), 40) !!}</h2>
	                            <p>{!! limiter(getLangSpec($item->short_content, App::getLocale()), 210) !!}</p>
	                        </div>
	                        <div class="img">
	                            <img src="{{$item->imgPath}}" alt="products">
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	        @endforeach
	    </div>
	    <!-- <img src="images/products-bg.png" alt="productsBg" class="products-bg"> -->
	</section>
	<!-- end Products -->
	<!-- Products -->
	<section class="product-cards">
	    <div class="container">
	        <div class="row">
	            <div class="col-lg-3">
	                <div class="product-card">
	                    <img src="{{asset("images/broilers.jpg")}}" alt="">
	                    <a href="#">Бройлеры</a>
	                </div>
	            </div>
	            <div class="col-lg-3">
	                <div class="product-card">
	                    <img src="{{asset("images/product-3.jpg")}}" alt="">
	                    <a href="#">7-дневные цыплята</a>
	                </div>
	            </div>
	            <div class="col-lg-3">
	                <div class="product-card">
	                    <img src="{{asset("images/product-4.jpg")}}" alt="">
	                    <a href="#">Курицы несушки</a>
	                </div>
	            </div>
	            <div class="col-lg-3">
	                <div class="product-card">
	                    <img src="{{asset("images/eggs.jpeg")}}" alt="">
	                    <a href="#">Яйца</a>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="seeMore">
	        <a href="#">Все товары</a>
	    </div>
	</section>
	<!-- end Products -->
	<!-- Clients -->
	<section class="clients">
	    <h3>Наши партнеры</h3>
	    <div class="container">
	        <div class="clients-slider owl-carousel owl-theme">
	            @foreach($partners as $item)
	            <div class="item">
	                <a href="{{getLangSpec($item->short_content, 'ru')}}" target="_blank">
	                    <img src="{{$item->imgPath}}" alt="">
	                </a>
	            </div>
	            @endforeach
	        </div>
	    </div>
	</section>
	<!-- end Clients -->
