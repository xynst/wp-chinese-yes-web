<?php
session_start();
$session_id = session_id();
session_write_close();

if (!key_exists('file', $_FILES)) {
    echo -3;
    exit;
}

$info = shell_exec(sprintf('ps -ef | grep %s | grep /root/chinese-yes/chinese-yes.py | grep -v "grep "', $session_id));
if ($info != "") {
    echo -1;
    exit;
}

if (!file_exists('package/' . $session_id)) {
    mkdir('package/' . $session_id,0777);
}

$file = $_FILES['file'];
$filename = time() . rand(0, 1000) . '.zip';

if (!move_uploaded_file($file['tmp_name'], 'upload/' . $filename)) {
    echo -2;
    exit;
}

$abs_path_for_package = __DIR__ . '/upload/' . $filename;

$info = shell_exec(sprintf('/root/chinese-yes/chinese-yes.py %s %s > /root/chinese-yes/log/%s-error 2>&1',
    $abs_path_for_package,
    $session_id,
    $session_id
));

echo $info;
