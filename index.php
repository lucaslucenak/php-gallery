<?php
$_SESSION['usernameSession'] = 'Admin';
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.104.2">
    <title>Album example · Bootstrap v5.2</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/album/">
    <?php include("includes/bootstrap/bootstrapCss.php") ?>
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

<!-- ===================== HEADER ===================== -->
<header>
    <div class="bg-dark collapse" id="navbarHeader" style="">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-white">About</h4>
                    <p class="text-muted">Add some information about the album below, the author, or any other
                        background context. Make it a few sentences long so folks can pick up some informative tidbits.
                        Then, link them off to some social networking sites or contact information.</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                    <h4 class="text-white">Contact</h4>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Follow on Twitter</a></li>
                        <li><a href="#" class="text-white">Like on Facebook</a></li>
                        <li><a href="#" class="text-white">Email me</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor"
                     stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2"
                     viewBox="0 0 24 24">
                    <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path>
                    <circle cx="12" cy="13" r="4"></circle>
                </svg>
                <strong>Album</strong>
            </a>
            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>

<main>
    <!-- ===================== BANNER ===================== -->
    <section class="py-5 text-center container" id="banner">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Album example</h1>
                <p class="lead text-muted">Something short and leading about the collection below—its contents, the
                    creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it
                    entirely.</p>
                <a href="#" class="btn btn-primary my-2">Main call to action</a>

                <!-- FILE UPLOAD -->
                <?php
                if (isset($_SESSION['usernameSession'])) {
                    echo '<form action="includes/upload.inc.php" method="post" enctype="multipart/form-data">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Title</span>
                            <input type="text" class="form-control" name="galleryTitle" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Name</span>
                            <input type="text" class="form-control" name="galleryFileName" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Category</span>
                            <input type="text" class="form-control" name="galleryCategory" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                        </div>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="inputGroup-sizing-default">Description</span>
                            <input type="text" class="form-control" name="galleryDescription" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
                        </div>
                        <div class="mb-3">
                            <input class="form-control" name="file" type="file" id="formFile" required>
                        </div>
                        <button class="btn btn-secondary my-2" type="submit" name="fileSubmit">Submit File</button>
                    </form>';
                }
                ?>

            </div>
        </div>
    </section>

    <!-- ===================== GALLERY ===================== -->
    <section class="gallery">
        <div class="album py-5 bg-light" id="gallery">
            <div class="container">

                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    <!-- GALLERY FILE -->
                    <?php
                    include_once('db/connection/Connection.php');
                    $con = new Connection();
                    $query = "SELECT * FROM tb_gallery";
                    $queryRun = mysqli_query($con->getCon(), $query);
                    foreach ($queryRun as $gallery) {
                        ?>
                        <div class="col">
                            <div class="card shadow-sm">
                                <img src="assets/img/gallery/<?=$gallery['file_name']?>" class="gallery-img">
    
                                <div class="card-body">
                                    <h1><?=$gallery['title']?></h1>
                                    <p class="card-text"><?=$gallery['description']?></p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-sm btn-outline-secondary" name="view">View</button>
<!--                                            UPDATE GALLERY-->
                                            <form action="pages/update-file.php" method="post">
                                                <input type="hidden" name="galleryId" value="<?=$gallery['id']?>">
                                                <input type="hidden" name="galleryTitle" value="<?=$gallery['title']?>">
                                                <input type="hidden" name="galleryFileName" value="<?=$gallery['file_name']?>">
<!--                                                <input type="hidden" name="galleryNameId" value="--><?//=$gallery['file_name_id']?><!--">-->
                                                <input type="hidden" name="galleryCategory" value="<?=$gallery['category']?>">
                                                <input type="hidden" name="galleryDescription" value="<?=$gallery['description']?>">
                                                <button type="submit" class="btn btn-sm btn-outline-secondary" name="update">Update</button>
                                            </form>
                                        </div>
<!--                                        <small class="text-muted">9 mins</small>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

</main>

<!-- ===================== FOOTER ===================== -->
<footer class="text-muted py-5" id="footer">
    <div class="container">
        <p class="float-end mb-1">
            <a href="#">Back to top</a>
        </p>
        <p class="mb-1">Album example is © Bootstrap, but please download and customize it for yourself!</p>
        <p class="mb-0">New to Bootstrap? <a href="/">Visit the homepage</a> or read our <a
                    href="/docs/5.2/getting-started/introduction/">getting started guide</a>.</p>
    </div>
</footer>

<?php include("includes/bootstrap/bootstrapScripts.php") ?>
</body>
</html>