<?php
$start = microtime(true);
$res = "Результаты:<br>";
if (isset($_GET['x']) && count($_GET['x']) == 1 && is_numeric($_GET['x']['0']) && ($_GET['x']['0'] == -3 || $_GET['x']['0'] == -2 || $_GET['x']['0'] == -1 || $_GET['x']['0'] == 0 || $_GET['x']['0'] == 1 || $_GET['x']['0'] == 2 || $_GET['x']['0'] == 3 || $_GET['x']['0'] == 4 || $_GET['x']['0'] == 5)) {
    if(isset($_GET['y']) && preg_match('/-[1-5]|0|[1-3]/m', $_GET['y']) && is_numeric($_GET['y']) && $_GET['y'] >= -5 && $_GET['y'] <= 3) {
        if(isset($_GET['r']) && is_numeric($_GET['r']) && ($_GET['r'] == 1 || $_GET['r'] == 1.5 || $_GET['r'] == 2 || $_GET['r'] == 2.5 || $_GET['r'] == 3)){
            $x = $_GET['x']['0'];
            $y = $_GET['y'];
            $r = $_GET['r'];
            $isIn = FALSE;
            if ($x >= 0 && $y >= 0 && $y <= $r/2 && $x <= $r) {
                $isIn = TRUE;
            } elseif ($x <= 0 && $y <= 0 && $y >= -($x+$r)/2) {
                $isIn = TRUE;
            } elseif ($x <= 0 && $y <= 0 && $y <= sqrt($r*$r/4 - $x*$x)) {
                $isIn = TRUE;
            }
            
            $time = number_format(microtime(true)-$start,6);
            //echo($res."<label class=\"info\">Время выполнения: $time c</label>");
            echo "<table border=\"1\"> <tr> <th> X </th> <th> Y </th> <th> R </th> <th> Результат </th> </tr>
                    <tr> <th> $x </th> <th> $y </th> <th> $r </th> <th>".($isIn ? "+" : "-")."</th> </tr> </table>";
        } else {
            die($res."<label class=\"error\">Выберите корректное значение R</label>");
        }
    } else {
        die($res."<label class=\"error\">Введите корректное значение Y</label>");
    }
} else {
    die($res."<label class=\"error\">Выберите одно значение X</label>");
}

?>