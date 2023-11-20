<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ftpServer = "ftp.regasioh.com";
    $ftpUsername = $_POST["TransferUser"];
    $ftpPassword = $_POST["Wordpass123!"];
    $ftpPath = "/inetpub/ftproot/uploads/";

    $fileName = basename($_FILES["file"]["name"]);
    $targetFile = $ftpPath . $fileName;

    $ftpConnection = ftp_connect($ftpServer);
    $loginResult = ftp_login($ftpConnection, $ftpUsername, $ftpPassword);

    if ($ftpConnection && $loginResult) {
        if (ftp_put($ftpConnection, $targetFile, $_FILES["file"]["tmp_name"], FTP_BINARY)) {
            echo "File uploaded successfully!";
        } else {
            echo "Error uploading file.";
        }
    } else {
        echo "FTP connection failed.";
    }

    ftp_close($ftpConnection);
}

