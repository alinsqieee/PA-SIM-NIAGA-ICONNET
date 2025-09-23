<?php
include "../db/db.php";

if(isset($_POST['id_chat'])){
    $id_chat = $_POST['id_chat'];
    $update = mysqli_query($koneksi, "UPDATE tchat SET status='read' WHERE id_chat='$id_chat'");
    if($update){
        echo "success";
    } else {
        echo "error";
    }
}
?>
