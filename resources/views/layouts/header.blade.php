  <!-- Header -->
  <div class="mobUnderlay"></div>
  <div class="mobMenu inactiveMob">
      <div class="lang">
          <span>
              <img src="{{asset("images/uz.png")}}" alt="">
          </span>
          <span>
              <img src="{{asset("images/en.png")}}" alt="">
          </span>
          <span>
              <img src="{{asset("images/ru.png")}}" alt="">
          </span>
      </div>
      <ul>
          <li><a href="{{App::make('url')->to('/'.App::getLocale())}}">Home</a></li>
          <li><a href="services.html">Услуги</a></li>
          <li><a href="contacts.html">Товары</a></li>
          <li><a href="contacts.html">Контакты</a></li>
      </ul>
  </div>
  <div class="navBar">
      <div class="container">
          <div class="row">
              <div class="col-lg-8 col-md-6 col-3 ">
                  <div class="logoNav">
                      <div class="logo">
                          <a href="{{App::make('url')->to('/'.App::getLocale())}}">

                              <img src="{{asset("logomy.svg")}}">
                          </a>
                      </div>
                      <div class="navs">
                        @foreach($menu as $key => $item)
                               <div class="nav"><a href="{{App::make('url')->to('/'.App::getLocale().'/'.$item->options)}}">{{getLangSpec($item->title, App::getLocale())}}</a></div>
                        @endforeach
                      </div>
                  </div>
              </div>
              <div class="col-lg-4 col-md-6 col-9 ">
                  <div class="notLogo">
                      <div class="language">
                          <img src="{{asset("images/ru.png")}}" alt="">
                          <img src="{{asset("icons/ic_chevron_left_24px.svg")}}" alt="">
                          <ul class="langList">
                              <li><a href="{{route('languageChange', 'uz')}}"><img src="{{asset("images/uz.png")}}" alt=""></a></li>
                              <li><a href="#"><img src="{{asset("images/en.png")}}" alt=""></a></li>
                          </ul>
                      </div>
                      <div class="call">{{getLangSpec(getOnePost(55)->short_content, 'ru')}}</div>
                      <div class="menuTrigger">
                          <div class="menu menu-1">
                              <span class="menu-item"></span>
                              <span class="menu-item"></span>
                              <span class="menu-item"></span>
                          </div>
                      </div>
                  </div>
              </div>

          </div>
      </div>

  </div>
  <!-- end Header -->
  {{--
    <div class="mobUnderlay"></div>
    <div class="mobMenu inactiveMob">
        <div class="lang">
           <span>
                <img src="images/uz.png" alt="">
           </span>
           <span>
                <img src="images/en.png" alt="">
           </span>
           <span>
                <img src="images/ru.png" alt="">
           </span> 
        </div>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="services.html">Услуги</a></li>
            <li><a href="contacts.html">Товары</a></li>
            <li><a href="contacts.html">Контакты</a></li>
        </ul>
    </div> 
    <!-- Header -->
    <div class="navBar">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6 col-3 ">
                    <div class="logoNav">
                        <div class="logo">
                            <a href="{{App::make('url')->to('/'.App::getLocale())}}">

  <img src="{{asset("logomy.svg")}}">
  </a>
  </div>
  <div class="navs">
      <div class="nav"><a href="products.html">Товары</a></div>
      <div class="nav"><a href="services.html">Услуги</a></div>
      <div class="nav"><a href="contacts.html">Контакты</a></div>
  </div>
  </div>
  </div>
  <div class="col-lg-4 col-md-6 col-9 ">
      <div class="notLogo">
          <div class="language">
              <img src="{{asset("images/ru.png")}}" alt="">
              <img src="{{asset("icons/ic_chevron_left_24px.svg")}}" alt="">
              <ul class="langList">
                  <li><a href="#"><img src="{{asset("images/uz.png")}}" alt=""></a></li>
                  <li><a href="#"><img src="{{asset("images/en.png")}}" alt=""></a></li>
              </ul>
          </div>
          <div class="call">+998 98 812 0133 </div>
          <div class="menuTrigger">
              <div class="menu menu-1">
                  <span class="menu-item"></span>
                  <span class="menu-item"></span>
                  <span class="menu-item"></span>
              </div>
          </div>
      </div>
  </div>

  </div>
  </div>

  </div>
  <!-- end Header --> --}}
