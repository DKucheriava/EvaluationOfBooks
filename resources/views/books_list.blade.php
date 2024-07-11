<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
@include('components.navbar')
<div class="container">
    <h1 class="text-center">Books</h1>
        <div class="row justify-content-between mb-4">
            <div class="col-auto align-self-start">
                <div class="sort-container">
                    <span>Sort</span>
                    <form class="form-inline my-2 mr-2 my-lg-0" id="sort" action="{{ route('sortBooks') }}" method="POST">
                        @csrf
                        <div class="btn-group-vertical">
                        <button id="sortAscButton" name="sortOption" value="asc" class="btn btn-outline-success btn-sm" type="submit">^</button>
                        <button id="sortDescButton" name="sortOption" value="desc" class="btn btn-outline-success btn-sm" type="submit">v</button>
                        </div>
                    </form>
                    <button id="refreshBooksButton" class="btn btn-primary" onclick="refreshBooks(10)">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-repeat" viewBox="0 0 16 16">
                            <path d="M11.534 7h3.932a.25.25 0 0 1 .192.41l-1.966 2.36a.25.25 0 0 1-.384 0l-1.966-2.36a.25.25 0 0 1 .192-.41m-11 2h3.932a.25.25 0 0 0 .192-.41L2.692 6.23a.25.25 0 0 0-.384 0L.342 8.59A.25.25 0 0 0 .534 9"/>
                            <path fill-rule="evenodd" d="M8 3c-1.552 0-2.94.707-3.857 1.818a.5.5 0 1 1-.771-.636A6.002 6.002 0 0 1 13.917 7H12.9A5 5 0 0 0 8 3M3.1 9a5.002 5.002 0 0 0 8.757 2.182.5.5 0 1 1 .771.636A6.002 6.002 0 0 1 2.083 9z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="col-auto ml-auto align-self-end">
                <div class="btn-container">
                    @auth
                        <button type="submit" class="btn btn-primary ml-2 mr-2" data-toggle="modal" data-target="#addBook">Add new book</button>
                    @endauth
                    <form class="form-inline my-2 my-lg-0" id="search" action="{{ route('searchBook') }}" method="POST">
                        @csrf
                        <input id="keyWord" name="keyWord" class="form-control mr-sm-2" type="search" placeholder="Search">
                        <button id="searchButton" class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            </div>
    </div>
    <div class="row" id="cardContainer">
        @if(!($books))
            <div class="container my-4">
                <h2 class="text-center form-text text-muted">No books found</h2>
            </div>
        @endif
        @foreach($books as $book)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card">
                <img class="bookImg" src="img/red-hardcover-book-front-cover.png" alt="{{ $book->title }}">
                <div class="book-body">
                    <h5 class="book-title">{{ $book->title }}</h5>
                    <a class="btn btn-primary" href="/book-info/{{ $book->id }}" id="aboutBook">More</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="addBook" tabindex="-1" role="dialog" aria-labelledby="addBookLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Book</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="addBookForm" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="form-group">
                        <label for="author">Author</label>
                        <input type="text" class="form-control" id="author" name="author" required>
                    </div>
                    <div class="form-group">
                        <label for="year">Publication Year</label>
                        <input type="number" class="form-control" id="year" name="year" required>
                    </div>
                    <div class="form-group">
                        <label for="genre">Genre</label>
                        <input type="text" class="form-control" id="genre" name="genre" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <input type="text" class="form-control" id="description" name="description" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Cover Image</label>
                        <input type="file" class="form-control-file" id="image" name="image" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    document.getElementById('logoutButton').addEventListener('click', function() {
        fetch('/logout', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data)
                document.getElementById('registerButton').classList.remove('hidden');
                document.getElementById('loginButton').classList.remove('hidden');
                document.getElementById('logoutButton').classList.add('hidden');
                alert(data.message);
                window.location.assign(window.location.href);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });

    document.getElementById('addBookForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = document.getElementById('addBookForm');
        const formData = new FormData(form);

        fetch('/add-new-book', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData,
        })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                if (data.message === 'Book added successfully!') {
                    alert('Book added successfully!')
                    $('#addBookModal').modal('hide');
                    window.location.href = '/books-list';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                if (error.errors) {
                    alert('Validation Error: ' + JSON.stringify(error.errors));
                } else {
                    alert('An error occurred: ' + error.message);
                }
            });
    });

    function refreshBooks(limit) {
        fetch(`{{ route('refreshBookList', ['limit' => '']) }}/${limit}`)
            .then(response => response.json())
            .then(data => {
                const bookContainer = document.getElementById('cardContainer');
                if (bookContainer) {
                    bookContainer.innerHTML = '';

                    data.books.forEach(book => {
                        const bookHtml = `
                            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                                <div class="card">
                                    <img class="bookImg" src="img/red-hardcover-book-front-cover.png" alt="${book.title}">
                                    <div class="book-body">
                                        <h5 class="book-title">${book.title}</h5>
                                        <a class="btn btn-primary" href="/book-info/${book.id}" id="aboutBook">More</a>
                                    </div>
                                </div>
                            </div>
                        `;
                        bookContainer.innerHTML += bookHtml;
                    });
                }
            })
            .catch(error => {
                console.error('Error refreshing books:', error);
            });
    }

    setInterval(() => {
        refreshBooks(10);
    }, 10000);
</script>
</body>
</html>

