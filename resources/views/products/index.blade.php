
<div class="products-page">
    <div class="container">
        <div class="row">
            <nav class="col-xl-3 col-md-4 col-12" id="myScrollspy">
                <ul class="nav nav-pills flex-column">
                    @foreach($tags as $item)
                    <li class="nav-item">
                        <a class="nav-link" href="#section{{$item->id}}">{{getLangSpec($item->title, App::getLocale())}}</a>
                    </li>
                    @endforeach
                </ul>
            </nav>

            <div class="col-xl-9 col-md-8 col-12">
            <?php
                foreach($tags as $item){
                    $subProducts=getTagPosts($item->id, 'products');
                    $firstP=array();
                    $otherP=array();
                    //$counter=0;
                    foreach($subProducts as $key=>$item){
                        if($item->options=='yes'){
                             array_push($firstP,$item);
                        }else{
                            array_push($otherP,$item);
                        }
                        //$counter++; 
                    }
                    if(count($firstP)>0){
                        foreach($firstP as $bigB){
                    ?>
                    <div id="section{{$bigB->tags}}" class="longcard">
                        <div class="img">
                            <a data-fancybox="gallery" href="{{$bigB->imgPath}}" data-caption="Lorem ipsum dolor">
                                <img src="{{$bigB->imgPath}}" alt="">
                            </a>
                        </div>
                        <div class="content">
                            <h2><a href="{{route('products.view', ['lang'=>App::getLocale(),'alias'=>$bigB->alias])}}"> {{getLangSpec($bigB->title, App::getLocale())}}</a></h2>
                            <p>
                                {!! limiter(getLangSpec($bigB->short_content, App::getLocale()), 210) !!}
                            </p>
                        </div>
                    </div>
                <?php } } ?>
                <div id="section{{$item->tags}}" class="smallcard">
                    <h2>{{getLangSpec($item->title, App::getLocale())}}</h2>
                    <div class="row">
                    <?php foreach($otherP as $smallB){?>
                            <div class="col-lg-4 col-sm-6">
                                <div class="mycard">
                                    <a data-fancybox="gallery" href="{{$smallB->imgPath}}" data-caption="Lorem ipsum dolor">
                                        <img src="{{$smallB->imgPath}}" alt="">
                                    </a>
                                    <p> <a href="{{route('products.view', ['lang'=>App::getLocale(),'alias'=>$smallB->alias])}}"> {{getLangSpec($smallB->title, App::getLocale())}}</a></p>
                                </div>
                            </div>
                    <?php }?>
                    </div>
                </div>
                <?php  } ?>
            </div>
        </div>
    </div>
 </div>
