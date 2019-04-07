@extends('admin.layouts.app_admin')

@section('content')
    <div class="row">
        <div class="columns small-12">
            @component('admin.components.breadcrumb')
                @slot('title') Languages  @endslot
                @slot('parent') General  @endslot
                @slot('active') Languages  @endslot
            @endcomponent
            <hr />
                <a href="{{route('admin.language.create')}}" class="button float-right">
                    <i class="material-icons">
                        note_add
                    </i>
                    Create language
                </a>

                <table>
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th width="200">Status</th>
                        <th width="200">Main</th>
                        <th width="200">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($languages as $language)
                    <tr>
                        <td>{{$language->name}}</td>
                        <td>{{$language->status}}</td>
                        <td>{{$language->main}}</td>
                        <td>
                            <div class="button-group">

                            <a href="{{route('admin.language.edit', $language)}}" class="button" title="edit">
                                <i class="material-icons">
                                    edit
                                </i>
                            </a>
                            <form onsubmit="if(confirm('Delete?')) return true; else return false;" action="{{route('admin.language.destroy', $language)}}" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                {{csrf_field()}}
                                <button type="submit" class="button">
                                    <i class="material-icons">
                                        delete_forever
                                    </i></button>
                            </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" ><h2>Data is absent</h2></td>
                    </tr>
                    @endforelse
                </tbody>
                </table>
         </div>
    </div>
@endsection