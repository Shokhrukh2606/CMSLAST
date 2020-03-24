 <section class="content">
        <div class="top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="title">
                            <h2>{{getLangSpec($post->title, App::getLocale())}}</h2>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="inner-slider owl-carousel owl-theme">
                        @foreach($post->imgPaths as $key => $i)
                            <div>
                                <a href="{{$i}}" data-fancybox="inner">
                                    <img src="{{$i}}" alt="">
                                </a>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="desc">
                {!!getLangSpec($post->content, App::getLocale())!!}
                <img src="{{asset("images/graph.jpg")}}" alt="">
                <img src="{{asset("images/graph-2.jpg")}}" alt="">
                <img src="{{asset("images/graph-3.jpg")}}" alt="">
                <!-- <h3>Технический параметр</h3>
                <h3>Длина: 3000 мм ширина: 1820 мм высота: 765 мм</h3> -->

            </div>

        </div>
    </section>