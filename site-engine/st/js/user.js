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
                if (k > 6)
                    break;
                data[fields[field].name] = fields[field].value;
            }
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
})(User);