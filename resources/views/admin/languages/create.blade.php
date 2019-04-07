@extends('admin.layouts.app_admin')

@section('content')
    <div class="row">
        <div class="columns small-12">
            @component('admin.components.breadcrumb')
                @slot('title') Create language  @endslot
                @slot('parent') General  @endslot
                @slot('active') Language  @endslot
            @endcomponent
            <hr />
            <form class="form-horizontal"  action="{{route('admin.language.store')}}" method="post">
                {{csrf_field()}}
                @include('admin.languages.partials.form')
            </form>
        </div>
    </div>
@endsection