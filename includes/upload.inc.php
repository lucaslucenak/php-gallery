<?php

include_once ("../db/connection/Connection.php");

if (isset($_POST['fileSubmit'])) {

    // User attributes desire
    $galleryTitle = strtolower(str_replace(" ", "-", $_POST['galleryTitle']));
    $galleryName = $_POST['galleryName'];
    echo $galleryName;
    $galleryCategory = $_POST['galleryCategory'];
    $galleryDescription = $_POST['galleryDescription'];

    // File restrictions
    $allowedFileTypes = array("image/jpeg", "image/gif", "image/png", "image/jpg");

    // Submitted file attributes, like extension and size
    $submittedFile = $_FILES['file'];
    $submittedFileName = $submittedFile["name"];
    $submittedFileFullPath = $submittedFile["full_path"];
    $submittedFileType = $submittedFile["type"];
    $submittedFileTmpName = $submittedFile["tmp_name"];
    $submittedFileError = $submittedFile["error"];
    $submittedFileSize = $submittedFile["size"];

    $errors = array();

    /* ========= Restrictions Handle ========= */

    // File properties stuff
    if (!in_array(strtolower($submittedFileType), $allowedFileTypes)) {
        echo "File not allowed";
        $errors[] = "file-extension=not-allowed";
//        exit();
    }

    if (!$submittedFileError === 0) {
        echo "You got an error";
        $errors[] = "submitting=error";
//        exit();
    }


    // Check if it has some empty field
    if (empty($galleryTitle)) {
        $errors[] = "title=empty";
    }
    if (empty($galleryName)) {
        $errors[] = "name=empty";
    }
    if (empty($galleryCategory)) {
        $errors[] = "category=empty";
    }
    if (empty($galleryDescription)) {
        $errors[] = "description=empty";
    }


    if (sizeof($errors) != 0) {
        $location = "Location: ../index.php?";
        foreach ($errors as $error) {
            $location .= $error . '&';
        }
        $location = rtrim($location, "&");
        header($location);
    }
    else {  // If is all ok
        $galleryName .= "-" . uniqid("gallery_", true) . "." . explode("/", $submittedFileType)[1];
        move_uploaded_file($submittedFileTmpName, '../assets/img/gallery/' . $galleryName);

        $connection = new Connection();
        $query = "INSERT INTO tb_gallery (title, name, category, description) VALUES ('$galleryTitle', '$galleryName', '$galleryCategory', '$galleryDescription');";
        $queryRun = mysqli_query($connection->getCon(), $query);

        header("Location: ../index.php?upload=success");

    }

}