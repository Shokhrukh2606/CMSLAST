   <section class="services_page">
       <div class="container">
           @foreach($services as $key => $item)
           <div class="service-item">
               <div class="row">
                   <div class="col-md-5">
                       <a data-fancybox="m" href="{{$item->imgPath}}" class="servimg">
                           <img src="{{$item->imgPath}}" alt="">
                       </a>

                   </div>
                   <div class="col-md-7">
                       <div class="serv">
                           <h3 class="service_item_name">
                              {{getLangSpec($item->title, App::getLocale())}}
                           </h3>
                           <p class="service_item_desc">
                               {!! limiter(getLangSpec($item->short_content, App::getLocale()), 210) !!}
                           </p>
                       </div>
                   </div>

               </div>
           </div>
           @endforeach
       </div>

   </section>
