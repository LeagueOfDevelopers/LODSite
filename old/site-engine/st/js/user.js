var User = {};

(function(obj) {
    obj.signInStart = function() {
        var login = gebi('head_form_login').value,
            password = gebi('head_form_password').value;
        User.signIn(login, password);
    };

    obj.signIn = function(login, password) {
        if (!login.length || !password.length) {
            $('.head-form-error').slideDown(100);
            return;
        }
        var obj = {};
            obj.url = "http://" + window.location.host + "/user/auth";
            obj.data = {
                login: login,
                password: password
            };
        Ajax.post(obj, User.signInResponseHandler);
    };

    obj.signInResponseHandler = function(res) {
        if (res.result) {
            window.refresh();
        } else {
            gebi('head_form_password').value = '';
            $('.head-form-error').slideDown(100);
            $('.navbar-form').addClass('has-error');
        }
    };

    obj.signUpStart = function() {
        var fields = $('#registerForm input');
        var data = {};
        var k = 0;
        try {
            for (var field in fields) {
                if (!fields.hasOwnProperty(field)) continue;
                k++;
                if (k > 14)
                    break;
                if (k == 7 || k == 8) {
                    fields[field].checked && (data[fields[field].name] = fields[field].value);
                    continue;
                }
                data[fields[field].name] = fields[field].value;
            }
            var textarea = $('#registerForm textarea')[0];
            data[textarea.name] = textarea.value;
            var select_year = $('#registerForm select')[0];
            data[select_year.name] = select_year.value;
            User.signUp(data);
        } catch (err) {
            alert(err.toString);
        }
    };

    obj.signUp = function(data) {
        var obj = {};
            obj.url = "http://" + window.location.host + "/user/signup";
            obj.data = data;
        Ajax.post(obj, User.signUpResponseHandler);
    };

    obj.signUpResponseHandler = function(res) {
        if (res.result) {
            window.refresh('http://' + window.location.host + "/user/register?success");
        }
    };

    obj.saveModifiedStart = function() {
        var fields = $('#editForm input');
        var data = {};
        var k = 0;
        try {
            for (var field in fields) {
                if (!fields.hasOwnProperty(field)) continue;
                k++;
                if (k > 10)
                    break;
                if (k == 3 || k == 4) {
                    fields[field].checked && (data[fields[field].name] = fields[field].value);
                    continue;
                }
                data[fields[field].name] = fields[field].value;
            }
            var textarea = $('#editForm textarea')[0];
            data[textarea.name] = textarea.value;
            var select_year = $('#editForm select')[0];
            data[select_year.name] = select_year.value;
            User.saveModified(data);
        } catch (err) {
            alert(err.toString);
        }
    };

    obj.saveModified = function(data) {
        var obj = {};
            obj.url = "http://" + window.location.host + "/profile/save_modified";
            obj.data = data;
        Ajax.post(obj, User.saveModifiedHandler);
    };

    obj.saveModifiedHandler = function(res) {
        if (res.result) {
            window.refresh('http://' + window.location.host + "/profile/edit?success");
        }
    };

    obj.changePassword_time = null;
    obj.changePassword = function() {
        if (parseInt(new Date().getTime() / 1000) == User.changePassword_time) {
            return;
        }
        var fields = $('#changePasswordForm input');
        var data = {};
        var k = 0;
        for (var field in fields) {
            if (!fields.hasOwnProperty(field)) continue;
            k++;
            if (k > 3)
                break;
            data[fields[field].name] = fields[field].value;
        }
        var obj = {};
            obj.url = "http://" + window.location.host + "/profile/save_new_password";
            obj.data = data;
        $('#refresh-password').css({display: 'inline'});
        User.changePassword_time = parseInt(new Date().getTime() / 1000);
        Ajax.post(obj, User.saveNewPasswordRequestHandler);
    };

    obj.saveNewPasswordRequestHandler = function(res) {
        $('#refresh-password').css({display: 'none'});
        if (res.result) {
            $('#changePasswordForm').slideUp(100);
            $('#danger-password-change').slideUp(100);
            $('#success-password-change').slideDown(100);
        } else {
            $('#danger-password-change').slideDown(100);
        }
    };

    obj.resetPassword_time = null;
    obj.resetPassword = function() {
        if (parseInt(new Date().getTime() / 1000) == User.resetPassword_time) {
            return;
        }
        var obj = {};
            obj.url = "http://" + window.location.host + "/user/act_reset_password";
            obj.data = {
                'email': document.getElementsByName('email')[0].value
            };
        User.resetPassword_time = parseInt(new Date().getTime() / 1000);
        Ajax.post(obj, User.resetPasswordRequestHandler);
    };

    obj.resetPasswordRequestHandler = function(res) {
        if (res.result) {
            $('#resetPasswordForm').slideUp(100);
            $('#danger-password-reset').stop().slideUp(100);
            $('#success-password-reset').slideDown(100);
        } else {
            $('#danger-password-reset').stop(true, true).slideDown(100);
            setInterval(function() {
                $('#danger-password-reset').stop(true, true).slideUp(100);
            }, 2000);
        }
    };

    obj.last_new_password = null;
    obj.newPassword = function() {
        if (parseInt(new Date().getTime() / 1000) == User.last_new_password) {
            return;
        }
        var fields = $('#newPasswordForm input');
        var data = {};
        var k = 0;
        for (var field in fields) {
            if (!fields.hasOwnProperty(field)) continue;
            k++;
            if (k > 2)
                break;
            data[fields[field].name] = fields[field].value;
        }
        var obj = {};
            obj.url = "http://" + window.location.host + "/user/set_new_password";
            obj.data = data;
            obj.data.key = NewPassword.key;
        User.last_new_password = parseInt(new Date().getTime() / 1000);
        Ajax.post(obj, User.newPasswordRequestHandler);
    };

    obj.newPasswordRequestHandler = function(res) {
        if (res.result) {
            $('#newPasswordForm').slideUp(100);
            $('#danger-password-new').slideUp(100);
            $('#success-password-new').slideDown(100);
        } else {
            $('#danger-password-new').slideDown(100);
        }
    };
})(User);