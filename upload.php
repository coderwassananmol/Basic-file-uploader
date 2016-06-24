<?php

ini_set("post_max_size", "30M");
ini_set("upload_max_filesize", "30M");
ini_set("memory_limit", "20000M");
include 'formforupload.php';
$locationimg = 'uploads/images/';
$locationdoc = 'uploads/documents/';
$possibleimgtype = array(
    'image/jpeg',
    'image/png',
    'image/gif',
    );
$possibleimgext = array(
    'jpg',
    'jpeg',
    'png',
    'gif');
$possibledocext = array(
    'pdf',
    'doc',
    'docx');
$possibledoctype = array(
    'application/pdf',
    'application/msword',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document');
if (isset($_POST['submit']))
{
    $nameimg = $_FILES['fileimg']['name'];
    $namedoc = $_FILES['filedoc']['name'];
    $tempimg = $_FILES['fileimg']['tmp_name'];
    $tempdoc = $_FILES['filedoc']['tmp_name'];
    $sizeimg = $_FILES['fileimg']['size'];
    $sizedoc = $_FILES['filedoc']['size'];
    $typeimg = $_FILES['fileimg']['type'];
    $typedoc = $_FILES['filedoc']['type'];
    $extensionimg = strtolower(substr($nameimg, strpos($nameimg, '.') + 1));
    $extensiondoc = strtolower(substr($namedoc, strpos($namedoc, '.') + 1));
    $maxsizeimg = 2097152;
    $maxsizedoc = 5242880;
    if (isset($nameimg))
    {
        if (empty($nameimg))
        {
            echo 'Image file not uploaded.<br>';
        }
        if ($sizeimg > $maxsizeimg)
        {
            echo 'Image file max size exceeds. Please re-upload. <br>';
        } else
            if (!in_array($typeimg, $possibleimgtype) || !in_array($extensionimg, $possibleimgext) &&
                !empty($nameimg))
            {
                echo 'Invalid image file. Please re-upload. <br>';
            } else
            {
                echo 'Image file uploaded succesfully. <br>';
                move_uploaded_file($tempimg,$locationimg.$nameimg);
            }
    } else
    {
        echo 'There was some error uploading the image file. <br>';
    }
    if (isset($namedoc))
    {
        if (empty($namedoc))
        {
            echo 'Document file not uploaded.<br>';
        }
        if ($sizedoc > $maxsizedoc)
        {
            echo 'Doc file max size exceeds. Please re-upload. <br>';
        } else
            if (!in_array($typedoc, $possibledoctype) || !in_array($extensiondoc, $possibledocext) &&
                !empty($namedoc))
            {
                echo 'Invalid document file. Please re-upload. <br>';
            } else
            {
                echo 'Document file uploaded successfully. <br>';
                move_uploaded_file($tempdoc,$locationdoc.$namedoc);
            }
    } else
    {
        echo 'There was some error uploading the document file.';
    }

}

?>