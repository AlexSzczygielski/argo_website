<body>
    <form method="POST" enctype="multipart/form-data">
        <p>Password: </p>
        <textarea name="psswd"></textarea>

        <br>
        <input type="submit" value="Submit"></input>
    </form>
    
</body>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $psswd   = $_POST['psswd'];
    echo password_hash($psswd, PASSWORD_BCRYPT);
}
?>