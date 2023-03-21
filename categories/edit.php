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

<h1 class="text-center">Edit category</h1>
<div class="container">
    <div class="row">
        <form method="POST" action="edit_sql.php" class="offset-md-3 col-md-6">
            <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'] ?>">

            <div class="mb-3">
                <label for="name" class="form-label">Назва</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $_GET['name'] ?>">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Фото(Адрес)</label>
                <input type="url" class="form-control" id="image" name="image" value="<?php echo $_GET['image'] ?>">
            </div>

            <div class="mb-3">
                <label for="description">Опис</label>
                <textarea class="form-control" placeholder="Leave a comment here" name="description"
                          id="description"><?php echo $_GET['description'] ?></textarea>
            </div>

            <button type="submit" class="btn btn-dark">Submit editing</button>
            <a class="btn btn-secondary" href="/">Cancel</a>
        </form>
    </div>

</div>


<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>