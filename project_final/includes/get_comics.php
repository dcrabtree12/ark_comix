<table>
  <!--
    <tr>
        <th>Category</th>
        <th>Message</th>
    </tr>
  -->
<?php
require_once('connect.php');
$q = 'SELECT * FROM users u
JOIN comics c ON c.comic_id = u.comic_id';

$result = $con->query($q);

if ($result) {
    while ($row = $result->fetch_object()) {
        //echo "<tr><td>$row->comic_id</td></tr>";
    }
} else {
    echo $con->error;
}

?>
</table>
