$(function(){
    var btnUpload = $('#upload-button');
    if (btnUpload.length) {
        (new AjaxUpload(btnUpload, {
            action: '/profile/upload_image',
            name: 'upload_img',
            enctype: 'multipart/form-data',
            onSubmit: function(file, ext){
                if (!(ext && /^(jpg|png|jpeg|gif)$/.test(ext))){
                    return false;
                }
                $('#refresh-panel').css({display: 'block'});
            },
            onComplete: function(file, res){
                res = $.parseJSON(strip_tags(res));
                if (res.result){
                    var profile_image = $('#profile-image');
                    profile_image.css({backgroundImage: 'url(' + res.image_link + ')'});
                }
                $('#refresh-panel').css({display: 'none'});
            },
            onError: function() {
                $('#refresh-panel').css({display: 'none'});
            }
        }));
    }
});