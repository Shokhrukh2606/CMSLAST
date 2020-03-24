<nav class="navbar navbar-default">
    <div class="container-fluid">
        <ul class="nav navbar-nav">
            <li class="<?=(Request::is('programs'))?'active':''?>"><a href="{{route('programs_list', ['status'=>'active'])}}">Передачи</a></li>
            <li class="<?=(Request::is('slots'))?'active':''?>"><a href="{{route('slots_list', ['status'=>'active'])}}">Типичные дни</a></li>
            <li class="<?=(Request::is('assigns'))?'active':''?>"><a href="{{route('assigns_list')}}">Ежедневные программы</a></li>
        </ul>
    </div>
</nav>
