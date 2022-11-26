<?php
include_once("../db/connection/Connection.php");

if(isset($_POST['fileUpdate'])) {
    $galleryId = $_POST['galleryId'];
    $galleryTitle = strtolower(str_replace(" ", "-", $_POST['galleryTitle']));
    $galleryOldName = $_POST['galleryOldName'];
    $galleryNewName = $_POST['galleryNewName'];
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
    if (empty($galleryNewName)) {
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
            $location .= $error . "&";
        }
        $location = rtrim($location, "&");
        header($location);
    }
    else {
        $galleryNewName .= "-" . uniqid("gallery_", true) . "." . explode("/", $submittedFileType)[1];
        move_uploaded_file($submittedFileTmpName, "../assets/img/gallery/" . $galleryNewName);
        $con = new Connection();
        $query = "UPDATE tb_gallery SET title = '$galleryTitle', name = '$galleryNewName', category = '$galleryCategory', description = '$galleryDescription' WHERE id = $galleryId";
        $queryRun = mysqli_query($con->getCon(), $query);
        unlink("../assets/img/gallery/$galleryOldName");

        header("Location: ../index.php?update=success");
    }
}