<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Шифр скитала</title>

</head>



<?php
$summary_coder = '';
$summary_decode = '';
if (isset($_GET['numrows'])) {
    $numrows = $_GET['numrows'];
} else {
    $numrows = 0;
}
if (isset($_GET['coder'])) { //кодируем
    if (isset($_GET['numrows'])) {
        $numrows = $_GET['numrows'];
    } else {
        $numrows = 0;
    }
    $coder = $_GET['coder'];
    $length = strlen($coder); //длина строки
    $coder_aray = str_split($coder, $numrows);
    $i = $length / $numrows;
    foreach ($coder_aray as $value) {
        $lengthhh = strlen($value);
        $d_aray = str_split($value, 1);
        $sucsess_aray[$i] = $d_aray;
        $i--;
    }

    //echo 'массив $sucsess_aray </br>';
    foreach ($sucsess_aray as $key2d => $value2d) { //двухмерный массив
        // echo 'Строка двухмерного массива  =   ' . $key2d . ' </br>  '; // ключ двухмерного массива $value элемент массива, тоесть массив внутри массива
        foreach ($value2d as $key => $value) { // достаем массив из двухмерного массива
            // echo $key . '   =   ' . $value2d[$key];
            // echo '</br>';
        }
        $i = 0;
        while ($i != $numrows) { //перебор массива 2d и исправление косяков
            if (empty($sucsess_aray[$key2d][$i])) {
                $sucsess_aray[$key2d][$i] = '.';
            }
            $i++;
        }
    }
    $bob = 0;

    if (($length % $numrows) != 0) {
        $count_in_sucsess_aray = count($sucsess_aray[0]);
        while ($bob != $count_in_sucsess_aray) {
            $count_sucsess_aray = count($sucsess_aray) - 1;
            while ($count_sucsess_aray != -1) {
                $summary_coder .= $sucsess_aray[$count_sucsess_aray][$bob];
                $count_sucsess_aray--;
            }
            $bob++;
        }
    } else {
        $summary_coder = 'Невозможно зашифровать если имеется признак делимости без остатка между символами и гранями. </br> Cимволов :   
        ' . $length . ' Граней : ' . $numrows;
    }

} else {
    $coder = 'empty';
}



if (isset($_GET['decoder'])) { //декодируем
    if (isset($_GET['numrows'])) {
        $numrows = $_GET['numrows'];
    } else {
        $numrows = 0;
    }
    $decoder = $_GET['decoder'];
    $length = strlen($decoder);
    $coder_aray = str_split($decoder, $numrows);
    $count_in = count($coder_aray) - 1;
    //echo $count_in;

    for ($j = 0; $j < $count_in; $j++) {
        $count_in_sucsess_aray = count($coder_aray);
        for ($i = 0; $i != $count_in_sucsess_aray; $i++) {
            $split_coder_aray = str_split($coder_aray[$i], 1);
            //print_r($split_coder_aray[0]);
            $summary_decode .= $split_coder_aray[$j];
            //  echo '</br>';
        }
    }

    //print_r($split_coder_aray[0]);









} else {
    $decoder = 'empty';
}

?>

<body>
    <form method="GET">
        <textarea type="text" name="coder" placeholder="Текст для зашифровки" required></textarea>
        <input type="number" name="numrows" placeholder="Грани" min="3" max="25" required />
        <button>Зашифровать</button>
    </form>
    <?php
    echo "</br> Изначальный текст (кодировка равна " . $numrows . ")   : </br> " . $coder . "</br>";
    echo "</br> Зашифрованный текст : </br> " . $summary_coder . " </br></br>";
    ?>


    <form method="GET">
        <input type="text" name="decoder" placeholder="Текст для расшифровки" required />
        <input type="number" name="numrows" placeholder="Грани" min="3" max="25" required />
        <button>Расшифровать</button>
    </form>
    <?php
    echo "</br> Изначальный текст (кодировка равна " . $numrows . ")   : </br> " . $decoder . "</br>";
    echo "</br> Расшифрованный текст : </br> " . $summary_decode . " </br></br>";
    ?>

</body>

</html>