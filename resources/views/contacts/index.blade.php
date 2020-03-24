 <!-- Contacts -->
 <section class="contacts-page">
     <div class="container">
         <div class="contacts-main">
             <div class="row align-items-center">
                 <div class="col-12 col-md-12 col-lg-8">
                     <div class="contacts-map">
                         <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2999.7066997802467!2d69.29944055151553!3d41.249946379175434!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38ae5fc49dc75199%3A0xf236738131b103c0!2z0YPQu9C40YbQsCDQr9C90LPQuCDQmtGD0LnQu9GO0LosINCi0LDRiNC60LXQvdGCLCDQo9C30LHQtdC60LjRgdGC0LDQvQ!5e0!3m2!1sru!2s!4v1584803106698!5m2!1sru!2s" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                         <div class="contacts">
                             <ul>
                                 <li>
                                     <span>
                                         <img src="{{asset("icons/material-email.svg")}}" class="ic" alt="">
                                     </span>
                                     <a href="mailto:{{getLangSpec(getOnePost(54)->short_content, 'ru')}}">{{getLangSpec(getOnePost(54)->short_content, 'ru')}}</a>
                                 </li>
                                 <li>
                                     <span>
                                         <img src="{{asset("icons/awesome-phone.svg")}}" class="ic" alt="">
                                     </span>
                                     <a href="tel:{{getLangSpec(getOnePost(55)->short_content, 'ru')}}">{{getLangSpec(getOnePost(55)->short_content, 'ru')}}</a>
                                 </li>
                                 <li>
                                     <span><img src="{{asset("icons/material-location-on.svg")}}" alt=""> </span>
                                     <a>{{getLangSpec(getOnePost(53)->short_content, App::getLocale())}}</a>
                                 </li>
                                 <li>
                                     <span><img src="{{asset("icons/ionic-ios-time.svg")}}" alt=""> </span>
                                     <a>
                                         {{getLangSpec(getOnePost(52)->short_content, App::getLocale())}}</a>

                                 </li>
                             </ul>
                         </div>
                     </div>
                 </div>
                 <div class="col-12 col-md-12 col-lg-4">
                     <form class="form-horizontal ">
                         <fieldset>

                             <!-- Form Name -->

                             <legend>Обратная связь</legend>



                             <!-- Text input-->
                             <div class="form-group">
                                 <label class="col-md-12 control-label" for="name">Имя *</label>
                                 <div class="col-12 col-md-8 col-lg-12">
                                     <input id="name" name="name" type="text" placeholder="" class="form-control input-md" required="">

                                 </div>
                             </div>

                             <!-- Text input-->
                             <div class="form-group">
                                 <label class="col-md-12 control-label" for="email">E-mail *</label>
                                 <div class="col-12 col-md-8 col-lg-12">
                                     <input id="email" name="email" type="text" placeholder="" class="form-control input-md" required="">

                                 </div>
                             </div>

                             <!-- Text input-->
                             <div class="form-group">
                                 <label class="col-md-12 control-label" for="theme">Тема *</label>
                                 <div class="col-12 col-md-8 col-lg-12">
                                     <input id="theme" name="theme" type="text" placeholder="" class="form-control input-md" required="">

                                 </div>
                             </div>

                             <!-- Text input-->
                             <div class="form-group">
                                 <label class="col-md-12 control-label" for="message">Сообщение *</label>
                                 <div class="col-12 col-md-8 col-lg-12">
                                     <input id="message" name="message" type="text" placeholder="" class="form-control input-md" required="">

                                 </div>
                             </div>

                             <!-- Text input-->


                             <!-- Button -->
                             <div class="form-group">
                                 <label class="col-md-12 control-label" for="submitButton"></label>
                                 <div class="col-12 col-md-8 col-lg-12">
                                     <button id="submitButton" name="submitButton" class="btn btn-primary float-right">Отправить</button>
                                     <div class="clearfix"></div>
                                 </div>
                             </div>

                         </fieldset>
                     </form>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!-- end Contacts -->
