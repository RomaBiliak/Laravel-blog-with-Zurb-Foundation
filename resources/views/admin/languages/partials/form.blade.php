<label for="">Status</label>
<select name="status" id="" class="form-control">
    @if(isset($language->id))
        <option value="0" @if($language->status == 0)selected @endif>Did not published</option>
        <option value="1" @if($language->status == 1)selected @endif>Published</option>
    @else
        <option value="0">Did not published</option>
        <option value="1">Published</option>
    @endif
</select>
<label for="">Name</label>
<input type="text" class="form-control" name="name" placeholder="Name" value="{{isset($language->name) ? $language->name : ''}}" required>

<label for="">Code</label>
<input type="text" class="form-control" name="code" placeholder="Code"  value="{{isset($language->code) ? $language->code : ''}}" required>

<hr />
<button class="button" title="save">
    <i class="material-icons">
        save
    </i>
</button>
