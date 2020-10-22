grecaptcha.ready(function() {
    grecaptcha.execute('6Lf8pNkZAAAAAKemZhCtJS5RGbXu-1cYGbmNCker', { action: 'signup' }).then(function(token) {
        var recaptchaResponse = document.getElementById('recaptchaResponse');
        recaptchaResponse.value = token;
    });
});