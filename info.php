<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("location: error.php");
    exit;
}

include("head.php");
include("menu.php");
include("footer.php")
?>

<main class="usuario">
    <h1>Classic editor</h1>
    <div id="editor">
        <p>This is some sample content.</p>
    </div>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'))
            .catch(error => {
                console.error(error);
            });
    </script>
</main>