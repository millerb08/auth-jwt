<?php
require_once __DIR__ . '/inc/bootstrap.php';
require_once __DIR__ . '/templates/header.php';
require_once __DIR__ . '/templates/nav.php';
?>
<div class="container">
    <div class="well">
        <h2>Book Voting System</h2>
        <p>Welcome to the book voting system.  Use this system to submit books you like and see if others like them as well
        by letting them upvote it.</p>
    </div>
</div>
<?php
var_dump(
  request()->cookies->has("auth_user_id"),
  request()->cookies->get("auth_roles")
);
require_once __DIR__ . '/templates/footer.php';
