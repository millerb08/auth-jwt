<?php

require_once __DIR__ .'/../inc/bootstrap.php';

$bookTitle = request()->get('title');
$bookDescription = request()->get('description');

if (addBook($bookTitle, $bookDescription)) {
    $session->getFlashBag()->add('success', 'Book Added');
    redirect('/books.php');
} else {
    $session->getFlashBag()->add('error', 'Unable to Add Book');
    redirect('/add.php');
}