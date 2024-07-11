<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
    <h1 class="text-center">Login</h1>
    <form id="loginForm">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <div id="responseMessage" class="mt-3"></div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = {
            email: document.getElementById('email').value,
            password: document.getElementById('password').value,
        };

        fetch('/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify(formData),
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                document.getElementById('responseMessage').innerText = data.message;
                if (data.message === 'Login successful!') {
                    window.location.href = '/books-list'; // Redirect to dashboard on successful login
                }
                if (data.message === 'Error') {
                    alert('Error!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
</script>
</body>
</html>
