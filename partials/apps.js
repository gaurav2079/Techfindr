function validate() {
    var username = document.getElementById('username').value;
    var email = document.getElementById('email').value;
    var number = document.getElementById('number').value;
    var password = document.getElementById('password').value;
    var cpassword = document.getElementById('cpassword').value;

    var usernameErr = document.getElementById('username_err');
    var emailErr = document.getElementById('email_err');
    var numberErr = document.getElementById('number_err');
    var passwordErr = document.getElementById('password_err');
    var cpasswordErr = document.getElementById('cpassword_err');

    // Validate Username
    if (username.trim() === '') {
        usernameErr.innerText = 'Username is required.';
    } else if (/\d/.test(username.trim())) {
        usernameErr.innerText = 'Username must contain only alphabetic characters.';
    } else {
        usernameErr.innerText = '';
    }

    // Validate Email
    if (email.trim() === '') {
        emailErr.innerText = 'Email is required.';
    } else {
        emailErr.innerText = '';
    }

    // Validate Phone Number
    if (number.trim() === '') {
        numberErr.innerText = 'Phone number is required.';
    } else {
        numberErr.innerText = '';
    }

    // Validate Password
    if (password.trim() === '') {
        passwordErr.innerText = 'Password is required.';
    } else {
        passwordErr.innerText = '';
    }

    // Validate Confirm Password
    if (cpassword.trim() === '') {
        cpasswordErr.innerText = 'Confirm Password is required.';
    } else if (cpassword !== password) {
        cpasswordErr.innerText = 'Passwords do not match.';
    } else {
        cpasswordErr.innerText = '';
    }
}

// Real-time validation on keyup
document.getElementById('username').addEventListener('keyup', function () {
    validate();
});

document.getElementById('email').addEventListener('keyup', function () {
    validate();
});

document.getElementById('number').addEventListener('keyup', function () {
    validate();
});

document.getElementById('password').addEventListener('keyup', function () {
    validate();
});

document.getElementById('cpassword').addEventListener('keyup', function () {
    validate();
});
