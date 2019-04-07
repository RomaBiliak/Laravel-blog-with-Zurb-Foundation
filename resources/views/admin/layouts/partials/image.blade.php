<input type="hidden" value="{{url('admin/image')}}" id="upload_url">
<input type="hidden" value="{{url('admin/image-delete')}}" id="remove_url">
<input type="hidden" value="{{asset('/')}}" id="public_dir">

    <div class="card" style="width: 300px;">
        <div class="card-divider">
            <h4>Image</h4>
        </div>
        <img width="300px" onclick="changeProfile()" id="preview_image" src=""/>
    </div>
        <a onclick="changeProfile()" class="button">
            <i class="material-icons">
                attachment
            </i>
        </a>
        <a onclick="removeFile()" id='delete_image' class="button" style="display: none">
            <i class="material-icons">
                delete
            </i>
        </a>
    <input type="file" id="file" style="display: none"/>


