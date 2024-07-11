<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
@include('components.navbar')
<head>
    <title>{{ $book->title }}</title>
</head>
<body>
<div class="container">
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-4">
                <img src="{{ asset('img/red-hardcover-book-front-cover.png') }}" class="card-img bookImg">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $book->title }}</h5>
                    <p class="mt-2"> <strong>Rating: {{ $rating }}</strong></p>
                    <p class="card-text"><strong>Author:</strong> {{ $book->author }}</p>
                    <p class="card-text"><strong>Publication Year:</strong> {{ $book->publication_year }}</p>
                    <p class="card-text"><strong>Genre:</strong> {{ is_array($book->genre) ? implode(', ', $book->genre) : $book->genre }}</p>
                    <p class="card-text"><strong>Description:</strong> {{ $book->description }}</p>
                    <p class="card-text small">{{ $book->created_at }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="comments-section">
        <h3>Comments</h3>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @auth
            <form action="{{ route('comments.store', $book) }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <div class="form-group">
                        <label for="rating">Rating:</label>
                        <select class="form-control" id="rating" name="rating">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                    </div>
                    <label for="comment">Add a comment:</label>
                    <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        @else
            <p>Please <a href="/login">login</a> to add a comment.</p>
        @endauth

        <div class="comments-list mt-4">
            @foreach($book->comments as $comment)
                <div class="comment">
                    <p><strong>{{ $comment->user->name }}</strong>:
                        {{ $comment->content }} </p>
                </div>
            @endforeach
        </div>
    </div>
    <div class="row" id="cardContainer">
        @foreach($books as $book)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card">
                    <img class="bookImg" src="{{ asset('img/red-hardcover-book-front-cover.png') }}" alt="{{ $book->title }}">
                    <div class="book-body">
                        <h5 class="book-title">{{ $book->title }}</h5>
                        <a class="btn btn-primary" href="/book-info/{{ $book->id }}" id="aboutBook">More</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
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
            .then(response => response.json())
            .then(data => {
                document.getElementById('registerButton').classList.remove('hidden');
                document.getElementById('loginButton').classList.remove('hidden');
                document.getElementById('logoutButton').classList.add('hidden');
                alert(data.message);
                window.location.assign(window.location.href);
            })
            .catch(error => {
                console.error('Error:', error);
                window.location.assign(window.location.href);
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
                                    <img class="bookImg" src="{{ asset('img/red-hardcover-book-front-cover.png') }}" alt="${book.title}">
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
        refreshBooks(5);
    }, 10000);
</script>
</body>
</html>
