@foreach($categories as $category_list){
<option value="{{isset($category_list->id) ? $category_list->id :  "" }}"

    @isset($category->id)
        @if($category->parent_id == $category_list->id)
            selected=""
        @endif

        @if($category->id == $category_list->id)
             hidden=""
        @endif
    @endisset
>
    {!! $delimiter or "" !!} {{isset($category_list->descriptions->first()->title) ? $category_list->descriptions->first()->title :  ""}}
</option>
    @if(count($category_list->children)>0)
        @include('admin.categories.partials.categories', ['categories'=>$category_list->children,
        'delimiter'=>' - '.$delimiter
        ])
    @endif
@endforeach