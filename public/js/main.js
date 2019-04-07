
$(document).ready(function(){
    $('textarea').ckeditor();
});
$(document).foundation();


$(document).ready(function(){
    $('#preview_image').attr('src',  $('#public_dir').val() + $('input[name=\'image\']').val());
});
function changeProfile() {
    $('#file').click();
}
$('#file').change(function () {
    if ($(this).val() != '') {
        upload(this);
    }
});
function upload(img) {
    var form_data = new FormData();
    form_data.append('file', img.files[0]);
    form_data.append('_token', $('input[name=\'_token\']').val());
    $('#loading').css('display', 'block');
    $.ajax({
        url: $('#upload_url').val(),
        data: form_data,
        type: 'POST',
        contentType: false,
        processData: false,
        success: function (data) {
            if (data.fail) {
                $('#preview_image').attr('src', $('input[name=\'image\']').val());
                alert(data.errors['file']);
            }
            else {
                $('#file_name').val(data);
                $('#preview_image').attr('src', $('#public_dir').val() + data);
                $('#delete_image').show();
            }
            $('#loading').css('display', 'none');
        },
        error: function (xhr, status, error) {
            alert(xhr.responseText);
            $('#preview_image').attr('src', $('#public_dir').val() + $('input[name=\'image\']').val());
        }
    });
}
function removeFile() {
    if ($('#file_name').val() != '')
        if (confirm('Are you sure want to remove profile picture?')) {
            $('#loading').css('display', 'block');
            var form_data = new FormData();
            form_data.append('_method', 'DELETE');
            form_data.append('image', $('#file_name').val());
            form_data.append('_token', $('input[name=\'_token\']').val());
            $.ajax({
                url: $('#remove_url').val(),
                data: form_data,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#preview_image').attr('src', '');
                    $('#file_name').val('');
                    $('#delete_image').hide();
                    $('#file_name').val('');
                },
                error: function (xhr, status, error) {
                    alert(xhr.responseText);
                }
            });
        }
}