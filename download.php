<?php

    $file = filter_input(INPUT_GET, 'video_url');

    if ($file === null) {
        die('Cannot find the video_url URL parameter');
    }

    $headers = array_change_key_case(get_headers($file, true));

    $fileSize = (array)$headers['content-length'];

    if (count($fileSize) === 0) {
        die('Cannot fetch the file size');
    }

    if (strpos('404 Not Found', $headers[0]) === false) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=videoplayback.mp4');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . $fileSize[count($fileSize)-1]);
        echo "downloading";
        ob_clean();
        flush();
        readfile($file);
        exit;
    } else {
        die($file . " is not found...\n");
    }

    while(true) {
        echo "\n";
        if (connection_status() != 0) {
            die;
        }
    }