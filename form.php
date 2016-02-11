<?php
setcookie('TEST', 'This is my value');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form action="test/testResponse.php" method="post">
    <input type="text" name="field1" id="">
    <button type="submit">Send</button>
</form>

</body>
</html>