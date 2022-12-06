// Disable Right Click
// document.addEventListener('contextmenu', event => event.preventDefault());

// Disable Ctrl + C, Ctrl + U, F12
$(document).keydown(function(e) {
    if (e.ctrlKey && (e.keyCode == 67 || e.keyCode == 85) || e.keyCode == 123) {
        // window.location.href = "";
        // return false;
    }
});

// Hide View Password
$('#oldpassEye').click(function() {
    let input = $('#oldpass');
    let eye = $('#oldpassEye');
    if (input.attr('type') == 'password') {
        input.attr('type','text');
        eye.removeClass('bi-eye').addClass('bi-eye-slash');
    } else {
        input.attr('type','password');
        eye.removeClass('bi-eye-slash').addClass('bi-eye');
    }
});
$('#passwordEye').click(function() {
    let input = $('#password');
    let eye = $('#passwordEye');
    if (input.attr('type') == 'password') {
        input.attr('type','text');
        eye.removeClass('bi-eye').addClass('bi-eye-slash');
    } else {
        input.attr('type','password');
        eye.removeClass('bi-eye-slash').addClass('bi-eye');
    }
});
$('#passconfEye').click(function() {
    let input = $('#passconf');
    let eye = $('#passconfEye');
    if (input.attr('type') == 'password') {
        input.attr('type','text');
        eye.removeClass('bi-eye').addClass('bi-eye-slash');
    } else {
        input.attr('type','password');
        eye.removeClass('bi-eye-slash').addClass('bi-eye');
    }
});

// Image Preview
function preview() {
    frame.src=URL.createObjectURL(event.target.files[0]);
}

function numberFormat(number) {
    return number.toLocaleString().replace(/,/g, '.');
}