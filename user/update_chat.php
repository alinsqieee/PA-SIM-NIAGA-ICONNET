<?php
include "../db/db.php";

if(isset($_POST['id_chat'])){
    $id = intval($_POST['id_chat']);
    mysqli_query($koneksi, "UPDATE tchat SET status='read' WHERE id_chat=$id");
    echo "ok";
}
?>
