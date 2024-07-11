document.getElementById('loginButton').addEventListener('click', function() {
    location.href = "/login";
});
document.getElementById('registerButton').addEventListener('click', function() {
    location.href = "/register";
});

document.addEventListener('DOMContentLoaded', function() {
    fetch('/check-auth', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
    })
        .then(response => response.json())
        .then(data => {
            const registerButton = document.getElementById('registerButton');
            const loginButton = document.getElementById('loginButton');
            const logoutButton = document.getElementById('logoutButton');

            if (data.authenticated) {
                registerButton.classList.add('hidden');
                loginButton.classList.add('hidden');
                logoutButton.classList.remove('hidden');
                logoutButton.classList.add('fade', 'show');
            } else {
                logoutButton.classList.add('hidden');
                registerButton.classList.remove('hidden');
                loginButton.classList.remove('hidden');
                registerButton.classList.add('fade', 'show');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});
