<?php
require_once __DIR__ . '/../inc/bootstrap.php';

$book = getBook(request()->get('bookId'));

if (deleteBook($book['id'])) {
    $session->getFlashBag()->add('success', 'Book Deleted');
} else {
    $session->getFlashBag()->add('error', 'Unable to Delete Book');
}
redirect('/books.php');