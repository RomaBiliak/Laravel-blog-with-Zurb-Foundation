<h2>{{$title}}</h2>
<nav aria-label="You are here:" role="navigation">
  <ul class="breadcrumbs">
    <li><a href="{{route('admin.index')}}">{{$parent}}</a></li>
    <li>
      {{$active}}
    </li>
  </ul>
</nav>