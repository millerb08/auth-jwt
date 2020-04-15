        <div class="media well">
            <div class="media-left">
                <div class="btn-group-vertical" role="group">
                    <a href="/procedures/vote.php?vote=up&bookId=<?php echo $book['id']; ?>">
                    <span class="glyphicon glyphicon-triangle-top"></span></a>
                    <span><?php if (isset($book['score'])) echo $book['score']; else echo '0'; ?></span>
                    <a href="/procedures/vote.php?vote=down&bookId=<?php echo $book['id']; ?>">
                    <span class="glyphicon glyphicon-triangle-bottom"></span></a>
                </div>
            </div>
            <div class="media-body">
              <h4 class="media-heading"><?php echo $book['name']; ?></h4>
              <p><?php echo $book['description']; ?></p>
                <p>
                <span><a href="/edit.php?bookId=<?php echo $book['id']; ?>">Edit</a> | </span>
                <span><a href="/procedures/deleteBook.php?bookId=<?php echo $book['id']; ?>">Delete</a></span>
                </p>
            </div>
        </div>