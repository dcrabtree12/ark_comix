<?php
require('connect.php');

$id = null;
$book_genre = null;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

if ($id) {
    $result = $con->query('select * from users
       where book_id =' . $id);

    if ($result) {
        $book_genre = $result->fetch_object();
    }
}

if ($book_genre) {
  $book = $book_genre->book_categories;
  $notify = $book_genre->book_message;

  echo $book;
  echo $notify;
  }

$q = 'SELECT * FROM books b join users u on u.book_id = b.book_id';

$result = $con->query($q);

if ($result) {
    while ($row = $result->fetch_object()) {
      //  echo "<tr><td>$row->book_id</td>";
        echo "<td>$row->book_categories</td>";
        echo "<td>$row->book_message</td>";
    }

} else {
    echo $con->error;
}

?>
</table>
