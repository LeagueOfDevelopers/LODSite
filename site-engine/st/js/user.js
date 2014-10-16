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
})(User);