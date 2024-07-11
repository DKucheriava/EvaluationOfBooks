<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
<nav class="navbar fixed-top navbar-light bg-light">
    <div class="container-fluid">
        <a href="/books-list" class="navbar-brand">
            <img  id="logo" src="{{ asset('img/book-outline.svg') }}" alt="Books List">
            <strong>Books</strong>
        </a>
    </div>
</nav>
<div class="container">
    <h1 class="text-center">Register</h1>
    <form id="registrationForm">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
            <div id="emailError" style="color: red;"></div>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
            <div id="passwordHelpBlock" class="form-text text-muted">
                Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
            </div>
            <div id="passwordError" style="color: red;"></div>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
            <div id="passwordConfirmError" style="color: red;"></div>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
    <div id="responseMessage" class="mt-3"></div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    document.getElementById('registrationForm').addEventListener('submit', function(e) {
        e.preventDefault();

        document.getElementById('emailError').innerText = '';
        document.getElementById('passwordError').innerText = '';
        document.getElementById('passwordConfirmError').innerText = '';

        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;
        const password_confirmation = document.getElementById('password_confirmation').value;

        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        if (!emailPattern.test(email)) {
            document.getElementById('emailError').innerText = 'Invalid email address';
            return;
        }

        if (password.length < 8) {
            document.getElementById('passwordError').innerText = 'Password must be at least 8 characters long';
            return;
        }

        if (password !== password_confirmation) {
            document.getElementById('passwordConfirmError').innerText = 'Passwords do not match';
            return;
        }

        const formData = {
            name: name,
            email: email,
            password: password,
            password_confirmation: password_confirmation,
        };

        fetch('/register', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(formData),
        })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                document.getElementById('responseMessage').innerText = data.message;
                if (data.message === 'Registration successful!') {
                    window.location.href = '/books-list';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                if (error.errors && error.errors.email) {
                    document.getElementById('emailError').innerText = error.errors.email[0];
                } else {
                    document.getElementById('responseMessage').innerText = error.message;
                }
            });
    });
</script>
</body>
</html>
