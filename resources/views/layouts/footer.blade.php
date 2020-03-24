<!-- Footer -->
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="logoTextSocial">
                    <img src="{{asset("logomy.svg")}}" alt="logo" class="footerLogo">
                    <div class="description">
                       {{getLangSpec(getOnePost(60)->short_content, App::getLocale())}}
                    </div>
                    <div class="social">
                        <a href="{{getLangSpec(getOnePost(59)->short_content, 'ru')}}"><img src="{{asset("icons/awesome-facebook.svg")}}" alt="facebook"></a> 
                       <a href="{{getLangSpec(getOnePost(56)->short_content, 'ru')}}"> <img src="{{asset("icons/feather-instagram.svg")}}" alt="instagram"></a> 
                       <a href="{{getLangSpec(getOnePost(58)->short_content, 'ru')}}"> <img src="{{asset("icons/awesome-youtube.svg")}}" alt="youtube"></a> 
                       <a href="{{getLangSpec(getOnePost(55)->short_content, 'ru')}}"> <img src="{{asset("icons/awesome-telegram.svg")}}" alt="telegram"></a> 
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <ul class="pages">
                    @foreach($menu as $key => $item)
                        <li><a href="{{App::make('url')->to('/'.App::getLocale().'/'.$item->options)}}">{{getLangSpec($item->title, App::getLocale())}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-4">
                <ul class="contacts">
                    <li>
                        <div><img src="{{asset("icons/ionic-ios-time.svg")}}" alt="clock"></div>
                        <div>{{getLangSpec(getOnePost(52)->short_content, App::getLocale())}}</div>
                    </li>
                    <li>
                        <div><img src="{{asset("icons/material-location-on.svg")}}" alt="location"></div>
                        <div>{{getLangSpec(getOnePost(53)->short_content, App::getLocale())}}
                        </div>
                    </li>
                    <li>
                        <div><img src="{{asset("icons/awesome-phone.svg")}}" alt="phone number"></div>
                        <a tel="{{getLangSpec(getOnePost(55)->short_content, 'ru')}}">{{getLangSpec(getOnePost(55)->short_content, 'ru')}}</a>
                    </li>
                    <li>
                        <div><img src="{{asset("icons/material-email.svg")}}" alt=""></div>
                        <a mailto="{{getLangSpec(getOnePost(54)->short_content, 'ru')}}">{{getLangSpec(getOnePost(54)->short_content, App::getLocale())}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<div class="bottomFooter">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                &copy; Loctech.uz. Все права защищены
            </div>
            <div class="col-md-8"></div>
        </div>
    </div>
</div>
<!-- EndFooter -->