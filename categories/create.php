<?php
$name="";
$image="";
$description="";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    include_once($_SERVER["DOCUMENT_ROOT"] . "/connection.php");
    //print_r($_POST);

//    if(!isset(_FILES['image']['error']) || $_FILES['image']['error'] != 0) {
//        echo 'SERVER FILE UPLOAD ERROR';
//        exit();
//    }

    $imageFileName = "";
    //does the file exist on server in temp folder?

    echo $_FILES['categoryImage']['error'];
    if(is_uploaded_file($_FILES['categoryImage']['tmp_name'])) {
        $imageFileName = 'files/images/'.$_FILES['categoryImage']['name'];
        move_uploaded_file($_FILES['categoryImage']['tmp_name'], "./../".$imageFileName);
    } else {
        echo 'SERVER FILE UPLOAD ERROR: '.$_FILES['categoryImage']['error'];
        exit();
    }

    $name=$_POST["name"];
    $image=$imageFileName;
    $description=$_POST["description"];

    $sql = "INSERT INTO tbl_categories (name, image, description) VALUES (?,?,?)";
    $stmt= $dbh->prepare($sql);
    $stmt->execute([$name, $image, $description]);

    header("location: /");
    exit();
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


<h1 class="text-center">Додати категорій</h1>
<div class="container">
    <div class="row">
        <form method="post" enctype='multipart/form-data' class="offset-md-3 col-md-6">
            <div class="mb-3">
                <label for="name" class="form-label">Назва</label>
                <input type="text" class="form-control" value="<?php echo $name; ?>" id="name" name="name">
            </div>

            <div class="mb-3">
<!--                <input type="hidden" name="MAX_FILE_SIZE" value="1024*1024*128" />-->
                <label for="image" class="form-label">Фото</label>
                <input accept="image/*" class="form-control" type="file" name="categoryImage" id="image">
<!--                <input type="text" class="form-control" value="--><?php //echo $image; ?><!--" id="image" name="image">-->
            </div>

            <div class="mb-3">
                <label for="description">Опис</label>
                <textarea class="form-control" placeholder="Leave a comment here"
                          name="description"
                          id="description"><?php echo $description; ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Додати</button>
        </form>
    </div>
</div>
<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>