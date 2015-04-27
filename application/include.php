<?php
function __autoload($className) {
    $className = ltrim($className, '\\');
    $namespace = '';
    //$fileName = 'application' . DIRECTORY_SEPARATOR . 'controllers' . DIRECTORY_SEPARATOR;
    $fileName = '';
    if ($nsPos = strripos($className, '\\')) {
        $namespace = substr($className, 0, $nsPos);
        $className = substr($className, $nsPos+1);
        $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    require($fileName . $className . '.php');
}

function errorLog($no, $str, $file, $line) {
    /**
    *Обработчик ошибок - пишу в файл лог - в TAB SEPARATED VALUES
     */
    /**
     *При достижении файла логов размена ИКС(100 мб) пишим в новый файл
     */
    $logDir = $_SERVER['DOCUMENT_ROOT'].DIRECTORY_SEPARATOR.'calc'.DIRECTORY_SEPARATOR.'log'.DIRECTORY_SEPARATOR;
    $num = count(scandir($logDir)) - 2;
    if ($num == 0) {
        $fileNum = $num + 1;
    } else {
        $fileNum = $num;
    }
    $file = 'error'.$fileNum.'.txt';
    $logFile = $logDir.$file;
    if (filesize($logFile) > 104857600) {
        $fileNum += 1;
        $file = 'error'.$fileNum.'.txt';
        $logFile = $logDir.$file;
    }
    $res = fopen($logFile, 'a');
    if (!$res) {
        $err = "Файл: ".__FILE__.
            ". Строка: ".__LINE__.
            ". Исключительная ситуация - не открылса файл для записи логов";
        trigger_error($err);
        return false;
    }
    $log = date('h:i:s d.m.Y').'    '.
        'Error number: '.$no.'    '.
        'Error: '.$str.'    '.
        'in file: '.$file.'    '.
        'on line: '.$line."\n";
    fwrite($res, $log);
    fclose($res);
}
