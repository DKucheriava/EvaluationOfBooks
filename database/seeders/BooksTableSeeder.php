<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $books = [
            ["id" => 1, "title" => "To Kill a Mockingbird", "author" => "Harper Lee", "publication_year" => 1960, "genre" => json_encode(["Fiction","Classic"]), "description" => "A classic novel depicting racial injustice in the American South.", "cover_image" => "https://fakeimg.pl/667x1000/cc6600", "rating" => 4.5],
            ["id" => 2, "title" => "1984", "author" => "George Orwell", "publication_year" => 1949, "genre" => json_encode(["Dystopian","Science Fiction"]), "description" => "A dystopian novel portraying a totalitarian society.", "cover_image" => "https://fakeimg.pl/667x1000/cc6600", "rating" => 4.4],
            ["id" => 3, "title" => "Pride and Prejudice", "author" => "Jane Austen", "publication_year" => 1813, "genre" => json_encode(["Classic","Romance"]), "description" => "A classic novel exploring themes of love, marriage, and social norms.", "cover_image" => "https://fakeimg.pl/667x1000/cc6600", "rating" => 4.3],
            ["id" => 4, "title" => "The Great Gatsby", "author" => "F. Scott Fitzgerald", "publication_year" => 1925, "genre" => json_encode(["Fiction","Classic"]), "description" => "A tale of the American Dream, wealth, and love during the Roaring Twenties.", "cover_image" => "https://fakeimg.pl/667x1000/cc6600", "rating" => 4.2],
            ["id" => 5, "title" => "Moby-Dick", "author" => "Herman Melville", "publication_year" => 1851, "genre" => json_encode(["Fiction","Adventure"]), "description" => "The epic tale of Captain Ahab's obsession with the white whale.", "cover_image" => "https://fakeimg.pl/667x1000/cc6600", "rating" => 4.1],
            ["id" => 6, "title" => "The Lord of the Rings", "author" => "J.R.R. Tolkien", "publication_year" => 1954, "genre" => json_encode(["Fantasy","Adventure"]), "description" => "An epic fantasy saga about the quest to destroy the One Ring.", "cover_image" => "https://fakeimg.pl/667x1000/cc6600", "rating" => 4.8],
            ["id" => 7, "title" => "The Catcher in the Rye", "author" => "J.D. Salinger", "publication_year" => 1951, "genre" => json_encode(["Fiction","Coming-of-age"]), "description" => "A classic coming-of-age novel following Holden Caulfield's journey.", "cover_image" => "https://fakeimg.pl/667x1000/cc6600", "rating" => 4.0],
            ["id" => 8, "title" => "The Hobbit", "author" => "J.R.R. Tolkien", "publication_year" => 1937, "genre" => json_encode(["Fantasy","Adventure"]), "description" => "The prequel to The Lord of the Rings, following Bilbo Baggins' journey.", "cover_image" => "https://fakeimg.pl/667x1000/cc6600", "rating" => 4.7],
            ["id" => 9, "title" => "One Hundred Years of Solitude", "author" => "Gabriel Garcia Marquez", "publication_year" => 1967, "genre" => json_encode(["Magical Realism","Literary Fiction"]), "description" => "A multi-generational saga of the Buendía family in the fictional town of Macondo.", "cover_image" => "https://fakeimg.pl/667x1000/cc6600", "rating" => 4.6],
            ["id" => 10, "title" => "War and Peace", "author" => "Leo Tolstoy", "publication_year" => 1869, "genre" => json_encode(["Historical Fiction","Epic"]), "description" => "A monumental work depicting the events of Russian society during the Napoleonic era.", "cover_image" => "https://fakeimg.pl/667x1000/cc6600", "rating" => 4.5],
            ["id" => 11, "title" => "The Odyssey", "author" => "Homer", "publication_year" => -800, "genre" => json_encode(["Epic","Mythology"]), "description" => "An ancient Greek epic poem recounting Odysseus' ten-year journey home after the Trojan War.", "cover_image" => "https://fakeimg.pl/667x1000/cc6600", "rating" => 4.4],
            ["id" => 12, "title" => "The Divine Comedy", "author" => "Dante Alighieri", "publication_year" => 1320, "genre" => json_encode(["Epic","Poetry"]), "description" => "An epic poem that follows the journey of the soul through Hell, Purgatory, and Heaven.", "cover_image" => "https://fakeimg.pl/667x1000/cc6600", "rating" => 4.3],
            ["id" => 13, "title" => "The Brothers Karamazov", "author" => "Fyodor Dostoevsky", "publication_year" => 1880, "genre" => json_encode(["Classic","Philosophical Fiction"]), "description" => "A complex novel exploring themes of spirituality, morality, and human nature.", "cover_image" => "https://fakeimg.pl/667x1000/cc6600", "rating" => 4.2],
            ["id" => 14, "title" => "Crime and Punishment", "author" => "Fyodor Dostoevsky", "publication_year" => 1866, "genre" => json_encode(["Classic","Psychological Fiction"]), "description" => "A psychological thriller revolving around guilt, conscience, and redemption.", "cover_image" => "https://fakeimg.pl/667x1000/cc6600", "rating" => 4.1],
            ["id" => 15, "title" => "The Picture of Dorian Gray", "author" => "Oscar Wilde", "publication_year" => 1890, "genre" => json_encode(["Gothic","Philosophical Fiction"]), "description" => "A novel about a man whose portrait ages while he retains his youth and beauty.", "cover_image" => "https://fakeimg.pl/667x1000/cc6600", "rating" => 4.0],
            ["id" => 16, "title" => "Brave New World", "author" => "Aldous Huxley", "publication_year" => 1932, "genre" => json_encode(["Dystopian","Science Fiction"]), "description" => "A dystopian vision of a future society obsessed with technology and control.", "cover_image" => "https://fakeimg.pl/667x1000/cc6600", "rating" => 4.5],
            ["id" => 17, "title" => "Wuthering Heights", "author" => "Emily Brontë", "publication_year" => 1847, "genre" => json_encode(["Classic","Gothic Fiction"]), "description" => "A tale of intense and tragic love set against the wild Yorkshire moors.", "cover_image" => "https://fakeimg.pl/667x1000/cc6600", "rating" => 4.4],
            ["id" => 18, "title" => "Frankenstein", "author" => "Mary Shelley", "publication_year" => 1818, "genre" => json_encode(["Horror","Science Fiction"]), "description" => "A novel about a scientist who creates a sentient being and faces the consequences.", "cover_image" => "https://fakeimg.pl/667x1000/cc6600", "rating" => 4.3]
        ];

        DB::table('books')->insert($books);
    }
}
