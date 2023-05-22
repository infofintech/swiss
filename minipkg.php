<?php
function parseArrayFile($name): array
{
    $arr = explode('|[1]|', (file_get_contents($name)));
    $obj = []; foreach ($arr as $line)
    {
        $obj[explode('|[>]|', $line)[0]] = explode('|[>]|', $line)[1];
    } return $obj;
}
$action = $_REQUEST['action'];
$host = ($_REQUEST['host']) ? $_REQUEST['host'] : 'https://github.com';
$pkg = $_REQUEST['pkg'];
$repo = $_REQUEST['repo'];
$branch = ($_REQUEST['branch']) ? $_REQUEST['branch'] : '';
$user = $_REQUEST['user'];
if ($action == 'i' || $action == 's' || $action == 'o') {
    if ($pkg == "from" && $repo != "" && $user != "") {
        $fileback = str_replace('./','',(glob('./*.art')));
        foreach ($fileback as $key=>$file) {
            if (file_exists($file)) {
                chmod($file, 0777);
                rename($file, $file.'.bak');
                chmod($file.'.bak', 0777);
            }
        }
        if (file_exists($repo.'.pkg')) {
            $package = parseArrayFile($repo.'.pkg');
            $list = $package['files'];
            $files = explode(';', $list);
            foreach ($files as $key=>$file) {
                if (file_exists($file)) {
                    chmod($file, 0777);
                    unlink($file);
                }
            }
            chmod($repo.'.pkg', 0777);
            unlink($repo.'.pkg');
        }
        if (file_exists($repo)) {
            chmod($repo, 0777);
            rename($repo, $repo.'.d');
        }
        $request = $host.'/'.$user.'/'.$repo;
        if ($branch != '') {
            exec('git clone -b '.$branch.' '.$request);
        } else {
            exec('git clone '.$request);
        }
        chmod($repo, 0777);
        exec('mv '.$repo.'/* $PWD');
        exec('chmod -R 777 .');
        exec('rm -rf '.$repo);
        if (file_exists($repo.'.d')) {
            chmod($repo.'.d', 0777);
            rename($repo.'.d', $repo);
        }
        $filepass = str_replace('./','',(glob('./*.md')));
        foreach ($filepass as $key=>$file) {
            if (file_exists($file)) {
                chmod($file, 0777);
                unlink($file);
            }
        }
        $filerest = str_replace('./','',(glob('./*.art.bak')));
        foreach ($filerest as $key=>$file) {
            if (file_exists($file)) {
                chmod($file, 0777);
                rename($file, str_replace('.art.bak', '.art', $file));
                chmod(str_replace('.art.bak', '.art', $file), 0777);
            }
        }
    }
} elseif ($action == 'r' || $action == 'p' || $action == 'm') {
    if ($pkg != "" && $repo != "" && $user != "") {
        if (file_exists($pkg.'.pkg')) {
            $package = parseArrayFile($pkg.'.pkg');
            $list = $package['files'];
            $files = explode(";", $list);
            foreach ($files as $key=>$file) {
                if (file_exists($file)) {
                    chmod($file, 0777);
                    unlink($file);
                }
            }
            chmod($pkg.'.pkg', 0777);
            unlink($pkg.'.pkg');
        }
        header('Location: get.php?action=i&host='.$host.'&pkg=from&repo='.$repo.'&branch='.$branch.'&user='.$user);
    }
} elseif ($action == 'd' || $action == 'u' || $action == 'x') {
    if ($pkg != "" && $repo == 'from' && $user == 'here') {
        if (file_exists($pkg.'.pkg')) {
            $package = parseArrayFile($pkg.'.pkg');
            $list = $package['files'];
            $files = explode(";", $list);
            foreach ($files as $key=>$file) {
                if (file_exists($file)) {
                    chmod($file, 0777);
                    unlink($file);
                }
            }
            chmod($pkg.'.pkg', 0777);
            unlink($pkg.'.pkg');
        }
    }
}
