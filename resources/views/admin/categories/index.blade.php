@extends('admin.layouts.app_admin')

@section('content')
    <div class="row">
        <div class="columns small-12">
            @component('admin.components.breadcrumb')
                @slot('title') Categories  @endslot
                @slot('parent') General  @endslot
                @slot('active') Categories  @endslot
            @endcomponent
            <hr />
                <a href="{{route('admin.category.create')}}" class="button float-right">
                    <i class="material-icons">
                        note_add
                    </i>
                    Create category
                </a>

                <table>
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th width="200">Status</th>
                        <th width="200">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td>{{$category->descriptions->first()->title}}</td>
                        <td>{{$category->published}}</td>
                        <td>
                            <div class="button-group">

                            <a href="{{route('admin.category.edit', $category)}}" class="button" title="edit">
                                <i class="material-icons">
                                    edit
                                </i>
                            </a>
                            <form onsubmit="if(confirm('Delete?')) return true; else return false;" action="{{route('admin.category.destroy', $category)}}" method="POST">
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
                <tfoot>
                <tr>
                    <th colspan="3">
                        <nav aria-label="Pagination">
                            {{$categories->links('admin.components.pagination.foundation-6')}}
                        </nav>
                    </th>
                </tr>
                </tfoot>
                </table>
         </div>
    </div>
@endsection