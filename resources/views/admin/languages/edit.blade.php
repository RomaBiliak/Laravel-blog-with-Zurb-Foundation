@extends('admin.layouts.app_admin')

@section('content')
    <div class="row">
        <div class="columns small-12">
            @component('admin.components.breadcrumb')
                @slot('title') Edit language  @endslot
                @slot('parent') General  @endslot
                @slot('active') Language  @endslot
            @endcomponent
            <hr />
            <form class="form-horizontal" action="{{route('admin.language.update', $language)}}" method="post">
                <input type="hidden" name="_method" value="put">
                {{csrf_field()}}
                @include('admin.languages.partials.form')
            </form>
        </div>
    </div>
@endsection