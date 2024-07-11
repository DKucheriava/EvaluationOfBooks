# EvaluationOfBooks

#### Installation

1. Clone the repository:
   ```
   git clone <repository-url>
   ```

2. Install dependencies:
   ```
   cd project-directory
   composer install
   npm install
   ```

3. Set up environment variables:
    - Rename `.env.example` to `.env`
    - Configure your database and other necessary environment variables

4. Run migrations:
   ```
   php artisan migrate
   ```

5. Compile assets:
   ```
   npm run dev
   ```

6. Start the development server:
   ```
   php artisan serve
   ```

#### Manual Testing Steps

1. Homepage Access

- Open your web browser.
- Navigate to http://127.0.0.1:8000/sort-books (or your configured URL if different).

2. Register a User

- Click on "Register" or navigate to the registration page.
- Fill out the registration form with valid data.
- Submit the form and verify that the user is registered successfully.

3. Login

- Navigate to the login page.
- Enter the registered credentials and click "Login".
- Verify that you are redirected to the homepage and can see authenticated user options.

4. Add a Book

- Click on "Add new book" button.
- Fill out the book details form, including an image upload.
- Submit the form and verify that the book is added successfully.
- Check the database to ensure the book record exists with the correct details and image path.

5. View Books List

- Navigate to the books list page (/books-list).
- Verify that all added books are displayed correctly.
- Check that each book card displays its title, author, and a functional link to view more details.

6. Search for a Book

- Use the search input to enter a keyword (e.g., a book title or author's name).
- Click on the "Search" button.
- Verify that the search results display relevant books matching the keyword.

7. Sort Books

- Use the sort buttons (e.g., ascending or descending) to sort the books list by title or any other sortable field.
- Verify that the books list updates according to the selected sort order.

8. Update Books List Automatically

- Observe that the books list automatically updates every 1 minute without requiring manual refresh.
- Check that the displayed books change or shuffle based on the random order query.

9. Logout

- Click on "Logout" to log out of the application.
Verify that authenticated user options are no longer visible.
