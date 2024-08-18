<?php 
session_start();
echo $_SESSION['id'];

if (isset($_GET['logout'])) {
    echo 'logout';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="get">
        <button type="submit" name="logout">logout</button>
    </form>
</body>
</html>