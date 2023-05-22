<?php
function parseArrayFile($name): array
{
    $arr = explode('|[1]|', (file_get_contents($name)));
    $obj = []; foreach ($arr as $line)
    {
        $obj[explode('|[>]|', $line)[0]] = explode('|[>]|', $line)[1];
    } return $obj;
}
function localeArr($id = '.'): array
{
    $dir = '.'; $list = str_replace($dir.'/','',(glob($dir.'/*.locale')));
    $summable = ['body','feet']; $arr = []; foreach ($list as $key=>$value)
    {
        $localeID = basename($value, '.locale'); $localeData = getArrFromFile($value);
        $arr[] = $localeID; foreach ($localeData as $entry=>$data)
        {
            $infinitive = intval(!in_array($entry, $summable));
            $putData = (is_numeric($data)) ? $data : $infinitive;
            file_put_contents($id.'/'.$localeID.'.'.$entry, $putData);
            chmod($id.'/'.$localeID.'.'.$entry, 0777);
        }
    } return $arr;
}
$paradigm = (file_exists('paradigm')) ? file_get_contents('paradigm') : 'system';
$paradigmData = json_decode(file_get_contents($paradigm.'.paradigm.json'), true);
$today = (file_exists('year')) ? file_get_contents('year') : $paradigmData['default_year'];
$locale = (file_exists('locale')) ? file_get_contents('locale') : array_key_first(localeArr());
$lingua = $locale; include $lingua.'.diction.php'; include $lingua.'.metro.php';
$action = $_REQUEST['action'];
$host = ($_REQUEST['host']) ? $_REQUEST['host'] : 'https://github.com';
$pkg = $_REQUEST['pkg'];
$repo = $_REQUEST['repo'];
$branch = ($_REQUEST['branch']) ? $_REQUEST['branch'] : '';
$user = $_REQUEST['user'];
if ($action == 'i' || $action == 's' || $action == 'o') {
    if ($pkg == "from" && $repo != "" && $user != "") {
        if (file_exists($repo)) {
            exec('chmod -R 777 .'); exec('rm -rf '.$repo);
        }
        if ($branch != '') {
            exec('git clone -b '.$branch.' '.$host.'/'.$user.'/'.$repo);
        } else {
            exec('git clone '.$host.'/'.$user.'/'.$repo);
        }
        chmod($repo, 0777); exec('chmod -R 777 .');
        if (file_exists($repo.'/'.$repo.'.data')) {
            $profLoadArr = parseArrayFile($repo.'/'.$repo.'.data');
            foreach ($profLoadArr as $key=>$value)
            {
                file_put_contents($repo.'/'.$key, $value); chmod($repo.'/'.$key, 0777);
            }
        }
        if (file_exists($repo.'/'.$lingua.'.'.$repo.'.quotes')) {
            $profQuotesArr = parseArrayFile($repo.'/'.$lingua.'.'.$repo.'.quotes');
            foreach ($profQuotesArr as $key=>$value)
            {
                $gheader = (isset($profLoadArr['name'])) ? $profLoadArr['name'] : $diction[$lingua]['name'][rand(0, count($diction[$lingua]['name']) - 1)];
                $gletter = $value;
                file_put_contents($repo.'/'.$lingua.'.'.$key.'.art', $gheader.'|[1]|'.$gletter);
                chmod($repo.'/'.$lingua.'.'.$key.'.art', 0777);
            }
        }
        file_put_contents($repo.'/coord', $paradigmData['default_coord']);
        chmod($repo.'/coord', 0777);
        file_put_contents($repo.'/mode', $paradigmData['default_mode']);
        chmod($repo.'/mode', 0777);
        file_put_contents($repo.'/rating', $paradigmData['default_rating']);
        chmod($repo.'/rating', 0777);
        file_put_contents($repo.'/score', $paradigmData['default_score']);
        chmod($repo.'/score', 0777);
        file_put_contents($repo.'/money', $paradigmData['default_money']);
        chmod($repo.'/money', 0777);
        file_put_contents($repo.'/born', $today);
        chmod($repo.'/born', 0777);
        file_put_contents($repo.'/locale', $lingua);
        chmod($repo.'/locale', 0777);
        localeArr($repo);
    }
} elseif ($action == 'r' || $action == 'p' || $action == 'm') {
    if ($pkg != "" && $repo != "" && $user != "") {
        if (file_exists($pkg)) {
            exec('chmod -R 777 .'); exec('rm -rf '.$pkg);
        }
        header('Location: getdir.php?key=i&host='.$host.'&pkg=from&repo='.$repo.'&branch='.$branch.'&user='.$user);
    }
} elseif ($action == 'd' || $action == 'u' || $action == 'x') {
    if ($pkg != "" && $repo == 'from' && $user == 'here') {
        if (file_exists($pkg)) {
            exec('chmod -R 777 .'); exec('rm -rf '.$pkg);
        }
    }
}
