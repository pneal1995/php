<?php

function setComments($conn) {
    if (isset($_POST['commentSubmit'])) {
        $uid = $_POST['uid'];
        $date = $_POST['date'];
        $message = $_POST['message'];

        $sql = "INSTER INTO comments (uid, date, message) VALUES ('$uid', '$date', '$message)";
        $result = mysqli_query($conn, $sql);
    }
}

function getComments($conn) {
    $sql = "SELECT * FROM comments";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $id = $row['uid'];
        $sql2 = $SELECT * FROM user where id='$id';
        $result2 = mysqli_query($conn, $sql2);
        if ($row2 = $result2->fetch_assoc()) {
            echo "<div class='comment-box'><p>"
            echo $row2['uid']."<br>";
            echo $row['date']."<br>";
            echo nl2br($row['message']);
            echo "</p>";
        if (isset($_SESSION['id'])) {
            if ($_SESSION['id'] == $row2['id']) {
                $id = $_SESSION['id'];
                echo "<form class='delete-form' method='POST' action='".deleteComments($conn, $id)."'>
                     <input type='hidden' name = 'uid' value'".$row2['uid']."'>
                     <input type='hidden' name = 'date' value'".$row['date']."'>
                     <button type='submit' name = 'commentDelete'>Delete</button>
                </form>
                <form class='delete-form' method='POST' action='editcomment.php'>
                     <input type='hidden' name = 'cid' value'".$row['cid']."'>
                     <input type='hidden' name = 'uid' value'".$row['uid']."'>
                     <input type='hidden' name = 'date' value'".$row['date']."'>
                     <input type='hidden' name = 'message' value'".$row['message']."'>
                     <button>Edit</button>
                </form>";
            } else {
                echo "<form class='edit-form' method='POST' action='".deleteComments($conn, $id)."'>
                     <input type='hidden' name = 'cid' value'".$row['cid']."'>
                     <input type='hidden' name = 'date' value'".$row['date']."'>
                     <button type='submit' name = 'commentDelete'>Delete</button>
                </form>";
            }
        } else {
            echo "<p class ='commentmessage'>You need to be logged in to reply!</p>";
        }
        echo "</div>";
        }
    }
}

function editComments($conn) {
    if (isset($_POST['commentSumbit'])) {
        $cid = $_POST['cid'];
        $uid = $_POST['uid'];
        $date = $_POST['date'];
        $message = $_POST['message'];
    }
}

?>