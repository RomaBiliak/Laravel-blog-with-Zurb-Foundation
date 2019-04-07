@extends('admin.layouts.app_admin')

@section('content')
    <div class="row">
        <div class="columns small-12">
            @component('admin.components.breadcrumb')
                @slot('title') Articles  @endslot
                @slot('parent') General  @endslot
                @slot('active') Articles  @endslot
            @endcomponent
            <hr />
                <a href="{{route('admin.article.create')}}" class="button float-right">
                    <i class="material-icons">
                        note_add
                    </i>
                    Create article
                </a>

                <table>
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th width="200">Published</th>
                        <th width="200">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($articles as $article)
                    <tr>
                        <td>{{$article->descriptions->first()->title}}</td>
                        <td>{{$article->published}}</td>
                        <td>
                            <div class="button-group">

                            <a href="{{route('admin.article.edit', $article)}}" class="button" title="edit">
                                <i class="material-icons">
                                    edit
                                </i>
                            </a>
                            <form onsubmit="if(confirm('Delete?')) return true; else return false;" action="{{route('admin.article.destroy', $article)}}" method="POST">
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