<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 3/6/17
 * Time: 11:19 AM
 */

class FileUploader
{
    private $mediaType;
    private $filePath;

    public function __construct($mediaType)
    {
        $this->mediaType = $mediaType;

    }

    /**
     * @return mixed
     */
    public function getFilePath()
    {
        return $this->filePath;
    }

    /**
     * @param mixed $filePath
     */
    public function setFilePath($filePath)
    {
        $this->filePath = $filePath;
    }



    public function uploadFile($target_dir, $form_name){
        /*
         * Check the media type
         */
        $mediaType = $this->mediaType;
        if ($mediaType == 'image'){

            $extension = explode(".", $_FILES[$form_name]["name"]);
            $new_file_name = md5(uniqid('image', true)).".".$extension[1];

            $target_file = $target_dir.$new_file_name;
            $uploadOk = 1;
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

            //Check if image file is a actual image or fake image
            $check = getimagesize($_FILES[$form_name]["tmp_name"]);
            if ($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }
            // Check file size
            if ($_FILES[$form_name]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }
            // Allow certain file formats
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"

            ) {
                echo "Sorry, only JPG, JPEG, PNG  files are allowed.";
                $uploadOk = 0;
            }
            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                return false;
                // if everything is ok, try to upload file
            } else {

                echo "new filename is ".$new_file_name."\n";
                if (move_uploaded_file($_FILES[$form_name]["tmp_name"], $target_file)) {

                    $this->setFilePath($target_file);
                    return true;
                } else {
                    echo "Sorry, there was an error uploading your file.";
                    return false;

                }
            }
        }
    }
}