@extends('admin.layouts.app_admin')

@section('content')
    <div class="row">
        <div class="columns small-12">
            @component('admin.components.breadcrumb')
                @slot('title') Edit article  @endslot
                @slot('parent') General  @endslot
                @slot('active') Article  @endslot
            @endcomponent
            <hr />
                @include('admin.layouts.partials.error')
                @include('admin.layouts.partials.image')
            <form class="form-horizontal" action="{{route('admin.article.update', $article)}}" method="post">
                <input type="hidden" name="_method" value="put">
                {{csrf_field()}}
                @include('admin.articles.partials.form')
            </form>
        </div>
    </div>
@endsection