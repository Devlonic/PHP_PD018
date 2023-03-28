<?php
$name="";
$image="";
$description="";
$imageFileName = "";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    include_once($_SERVER["DOCUMENT_ROOT"] . "/connection.php");
    $id=$_GET["id"];

    //does the file exist on server in temp folder?

    $name=$_POST["name"];
    $description=$_POST["description"];

    echo $_FILES['categoryImage']['error'];
    if(is_uploaded_file($_FILES['categoryImage']['tmp_name'])) {
        $imageFileName = 'files/images/'.$_FILES['categoryImage']['name'];
        move_uploaded_file($_FILES['categoryImage']['tmp_name'], "./../".$imageFileName);

        $image=$imageFileName;

        $sql = "UPDATE `tbl_categories` SET `name` = ?, `image` = ?, `description` = ? WHERE `tbl_categories`.`id` = ?;";
        $stmt= $dbh->prepare($sql);
        $stmt->execute([$name, $image, $description, $id]);
    } else {
        $sql = "UPDATE `tbl_categories` SET `name` = ?, `description` = ? WHERE `tbl_categories`.`id` = ?;";
        $stmt= $dbh->prepare($sql);
        $stmt->execute([$name, $description, $id]);
    }





    header("location: /");
    exit();
}
else {
    include_once($_SERVER["DOCUMENT_ROOT"] . "/connection.php");
    $id=$_GET["id"];
    $sql = "SELECT * FROM tbl_categories where id=".$id;
    $command = $dbh->query($sql);
    foreach($command as $row) {
        $image = $row["image"];
        $name = $row["name"];
        $description = $row["description"];
        break;
    }

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Головна сторінка</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<?php include_once($_SERVER["DOCUMENT_ROOT"] . "/_header.php"); ?>


<h1 class="text-center">Зміна категорій</h1>
<div class="container">
    <div class="row">
        <form method="post" enctype='multipart/form-data' class="offset-md-3 col-md-6">
            <div class="mb-3">
                <label for="name" class="form-label">Назва</label>
                <input type="text" class="form-control" value="<?php echo $name; ?>" id="name" name="name">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Фото</label>
                <input accept="image/*" class="form-control" type="file" name="categoryImage" id="image">
            </div>

            <div class="mb-3">
                <label for="description">Опис</label>
                <textarea class="form-control" placeholder="Leave a comment here"
                          name="description"
                          id="description"><?php echo $description; ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Зберегти</button>
        </form>
    </div>

</div>


<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>