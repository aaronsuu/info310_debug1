<?php

include __DIR__ . '/../components/loggly-logger.php';


if (isset($_GET['file']) && isset($_GET['vault_id'])) {
    $filePath = $_GET['file'];
    #echo "File path: " . $filePath;



    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filePath));

        ob_clean();
        flush();

        readfile($filePath);
        $ip = $_SERVER['REMOTE_ADDR'];
        $logger->info("User downloaded file: $filePath. Username='$username', IP=$ip");
        exit;
    } else {
        echo $filePath;
        die('File not found.');
    }
} else {
    die('Invalid file request.');
}

header("/vault_details.php");
exit();

?>
