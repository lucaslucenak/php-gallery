<?php

include_once ("../db/connection/Connection.php");

if (isset($_POST['fileSubmit'])) {

    // User attributes desire
    $galleryTitle = strtolower(str_replace(" ", "-", $_POST['galleryTitle']));
    $galleryName = $_POST['galleryName'];
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
        $errors[] = "Not allowed file extension";
//        exit();
    }

    if (!$submittedFileError === 0) {
        echo "You got an error";
        $errors[] = "Error at submitting file";
//        exit();
    }


    // Check if it has some empty field
    if (empty($galleryTitle)) {
        $errors[] = "Title field empty";
    }
    if (empty($galleryName)) {
        $errors[] = "Name field empty";
    }
    if (empty($galleryCategory)) {
        $errors[] = "Category field empty";
    }
    if (empty($galleryDescription)) {
        $errors[] = "Description field empty";
    }

    // If is all ok
    if (in_array(strtolower($submittedFileType), $allowedFileTypes) && $submittedFileError === 0 && $submittedFileSize < 2000000) {
        $galleryName .= "-" . uniqid("gallery_", true) . "." . explode("/", $submittedFileType)[1];
    }




    print_r($galleryName);
    print_r($errors);

}