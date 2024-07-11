<nav class="navbar fixed-top navbar-light bg-light">
    <div class="container-fluid">
        <a href="/books-list" class="navbar-brand">
            <img  id="logo" src="{{ asset('img/book-outline.svg') }}" alt="Books List">
            <strong>Books</strong>
        </a>
        <div class="d-flex align-items-center">
            <div class="d-flex">
                <button id="loginButton" type="button" class="btn btn-outline-primary me-2 hidden">Login</button>
                <button id="registerButton" type="button" class="btn btn-primary me-2 hidden">Sign-up</button>
                <button id="logoutButton" type="button" class="btn btn-danger hidden me-2">Logout</button>
            </div>
        </div>
    </div>
</nav>
<script type="module" src="{{ asset('js/auth.js') }}"></script>
