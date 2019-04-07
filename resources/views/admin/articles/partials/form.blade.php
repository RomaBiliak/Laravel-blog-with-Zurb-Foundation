<label for="">
    <input type="hidden" id="file_name" class="form-control" name="image" placeholder="URI" value="{{isset($image) ? $image : 'images/no-image.jpg' }} {{old('image') && empty($image) ? old('image') : '' }}" >
</label>
<label for="published">Status</label>

    <select name="published" id="published" class="form-control">
        @if(isset($article->id))
            <option value="0" @if($article->published == 0)selected @endif>Did not published</option>
            <option value="1" @if($article->published == 1)selected @endif>Published</option>
        @else
            <option value="0">Did not published</option>
            <option value="1">Published</option>
        @endif
    </select>

<label>Category
    <select name="categories[]" multiple>
        @include('admin.articles.partials.categories', ['categories'=>$categories])
    </select>
</label>
<ul class="tabs" data-tabs id="tabs">
    @foreach($languages as $language)
        <li class="tabs-title" ><a href="#panel{{$language->id}}">{{$language->name}}</a></li>
    @endforeach
</ul>


<div class="tabs-content" data-tabs-content="tabs">
    @foreach($languages as $language)
    <div class="tabs-panel" id="panel{{$language->id}}">
        <input type="hidden" class="form-control" name="data[{{$language->id}}][language_id]" value="{{$language->id}}" >
        <input type="hidden" class="form-control" name="data[{{$language->id}}][article_id]" value="{{isset($article->id) ? $article->id  : '' }}" >
        <label for="">Title
            <input type="text" class="form-control" name="data[{{$language->id}}][title]" placeholder="Name" value="{{isset($article_descriptions[$language->id]->title) ? $article_descriptions[$language->id]->title : ''}}" required>
        </label>

        <label for="">Slug
            <input type="text" class="form-control" name="data[{{$language->id}}][slug]" placeholder="Name" value="{{isset($article_descriptions[$language->id]->slug) ? $article_descriptions[$language->id]->slug : ''}}" required>
        </label>
        <label for="">Meta title
            <input type="text" class="form-control" name="data[{{$language->id}}][meta_title]" placeholder="Meta title" value="{{isset($article_descriptions[$language->id]->meta_title) ? $article_descriptions[$language->id]->meta_title : ''}}" required>
        </label>

        <label for="">Meta desctiption
            <input type="text" class="form-control" name="data[{{$language->id}}][meta_description]" placeholder="Meta desctiption" value="{{isset($article_descriptions[$language->id]->meta_description) ? $article_descriptions[$language->id]->meta_description : ''}}" required>
        </label>

        <label for="">Meta keyword
            <input type="text" class="form-control" name="data[{{$language->id}}][meta_keyword]" placeholder="Meta keyword" value="{{isset($article_descriptions[$language->id]->meta_keyword) ? $article_descriptions[$language->id]->meta_keyword: ''}}" required>
        </label>

        <label>
            Description short
            <textarea name="data[{{$language->id}}][description_short]">{{isset($article_descriptions[$language->id]->description_short) ? $article_descriptions[$language->id]->description_short: ''}}</textarea>
        </label>
        <label>
            Description
            <textarea name="data[{{$language->id}}][description]">{{isset($article_descriptions[$language->id]->description) ? $article_descriptions[$language->id]->description: ''}}</textarea>
        </label>

    </div>
    @endforeach

</div>


<hr />
<button class="button" title="save">
    <i class="material-icons">
        save
    </i>
</button>
<script>
    $(document).ready(function(){
        $('#tabs').foundation('selectTab', 'panel1');
    });
</script>