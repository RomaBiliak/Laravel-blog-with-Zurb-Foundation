@extends('admin.layouts.app_admin')

@section('content')
    <div class="row">
        <div class="columns small-12">
            @component('admin.components.breadcrumb')
                @slot('title') Edit category  @endslot
                @slot('parent') General  @endslot
                @slot('active') Category  @endslot
            @endcomponent
            <hr />
                @include('admin.layouts.partials.error')
                @include('admin.layouts.partials.image')
            <form class="form-horizontal" action="{{route('admin.category.update', $category)}}" method="post">
                <input type="hidden" name="_method" value="put">
                {{csrf_field()}}
                @include('admin.categories.partials.form')
            </form>
        </div>
    </div>
@endsection