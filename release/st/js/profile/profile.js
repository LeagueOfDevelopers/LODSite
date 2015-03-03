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

var Profile = {
    resizeFull: function(target) {
        var overlay = $('#photo-overlay');
        if (overlay) {
            overlay.css({display: 'block'}).animate({opacity: '1'}, 100);
            overlay.on('click', Profile.resizeSmall);
            $('.photo-container-wrapper').on('click', Profile.resizeSmall);
        }

        var container = $('.photo-container');
        container.on('click', function(e) {
            e.stopPropagation();
        });
        var wrapper = $('.photo-container-wrapper');
        wrapper.css({display: 'block'});

        $('.resize-full').css({display: 'none'});
        $('.resize-small').css({display: 'block'});

        container.empty();

        $('.profile-img').clone().appendTo('.photo-container');
        $('.photo-container > .profile-img > #profile-image').css({height: '250px', width: '250px'});
        $('.photo-container > .profile-img > #upload-button').remove();
        $('.photo-container > .profile-img > .resize-small').css({top: '0'});
        $('.photo-container a').css({display: 'none'});

        container.animate({top: '0px'}, 100);
    },
    resizeSmall: function(target) {
        var overlay = $('#photo-overlay');
        overlay.off();
        $('.photo-container-wrapper').off();
        if (overlay) {
            overlay.animate({opacity: '0'}, 100, function() {
                overlay.css({display: 'none'});
            });
        }

        var container = $('.photo-container');
        var wrapper = $('.photo-container-wrapper');
        wrapper.css({display: 'none'});
        container.css({top: '-20px'});

        $('.resize-small').css({display: 'none'});
        $('.resize-full').css({display: 'block'});
    }
};