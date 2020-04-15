<?php
require __DIR__ . '/../inc/bootstrap.php';

vote(request()->get('bookId'), request()->get('vote'));

redirect('/books.php');