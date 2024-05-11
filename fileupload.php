<?php
    if(isset($_FILES['image'])){
        $filename = $_FILES['image']['name'];
        $tempname = $_FILES['image']['tmp_name'];
        $folder = "images/". $filename;
        move_uploaded_file($tempname,$folder);
        echo $folder;
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
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="image" id="image">
        <button type="submit" name="submit" value="submit">Submit</button>
    </form>
</body>
</html>
