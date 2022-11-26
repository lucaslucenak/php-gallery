<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Album example · Bootstrap v5.2</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/album/">
    <?php include("../includes/bootstrap/bootstrapCss.php") ?>
    <link rel="stylesheet" href="styles/styles.css">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .gallery-img {
            width: 100%;
            height: 100%;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>
<body>
<?php
    ?>
    <form action="../includes/update.inc.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="galleryId" value="<?=$_POST['galleryId']?>">
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Title</span>
            <input type="text" class="form-control" name="galleryTitle" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?=$_POST['galleryTitle']?>" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
            <input type="text" class="form-control" name="galleryName" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?=explode("-", $_POST['galleryName'])[0]?>" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Category</span>
            <input type="text" class="form-control" name="galleryCategory" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?=$_POST['galleryCategory']?>" required>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Description</span>
            <input type="text" class="form-control" name="galleryDescription" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?=$_POST['galleryDescription']?>" required>
        </div>
        <div class="mb-3">
            <input class="form-control" name="file" type="file" id="formFile">
        </div>
        <button class="btn btn-secondary my-2" type="submit" name="fileUpdate">Update File</button>
    </form>
    <?php
?>

<?php include("../includes/bootstrap/bootstrapScripts.php") ?>
</body>
</html>