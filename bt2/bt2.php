<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>

    </style>
</head>
<body>

<table style="border-collapse: collapse;margin-left: 300px;margin-top: 0" border="1">
    <?php
    //Tạo bàn cờ
    $num = 1;
    $randArray = [];
    $chessboard = array_fill(0, 8, array_fill(0, 8, 0));
    //tạo mảng chứa các số random
    while (count($randArray) < 8) {
        $randomNumber = rand(1, 64);
        if (!in_array($randomNumber, $randArray)) {
            $randArray[] = $randomNumber;
        }
    }
    //tạo mảng chứa tọa độ
    foreach ($randArray as $item) {
        $row = ceil($item / 8) - 1;
        $col = ($item - 1) % 8;
        $chessboard[$row][$col] = 1;
        echo $item . "-";
    }
    echo "<br>";
    foreach ($chessboard as $row) {
        foreach ($row as $value) {
            echo $value . "-";
        }
        echo "<br>";
    }


    function isSafe($chessboard, $row, $col): bool
    {
        if ($chessboard[$row][$col] == 1) {
            for ($k = 0; $k < 8; $k++) {
                //check hàng ngang
                if ($chessboard[$row][$col] == $chessboard[$row][$k] && $col != $k) {
                    return false;
                }

            }
            for ($k = 0; $k < 8; $k++) {
                //check hàng dọc
                if ($chessboard[$row][$col] == $chessboard[$k][$col] && $row != $k) {
                    return false;
                }
            }
            if ($row==$col){
                for ($k = 0; $k < 8; $k++) {//check đường chéo từ trái sang phải
                    if ($chessboard[$row][$col] == $chessboard[$k][$k] && $row != $k && $col != $k) {
                        return false;
                    }
                }
            }
            if ($row+$col==7){
                for ($k = 0; $k < 8; $k++) {
                    if ($chessboard[$row][$col] == $chessboard[7 - $k][$k] && $row != 7 - $k && $col != $k) {
                        return false;
                    }
                }
            }
            //check chéo trái sang phải
            if ($row > $col) {
                for ($k = 0; $k < 8 - $row+$col; $k++) {
                    if ($chessboard[$row][$col] == $chessboard[$row - $col + $k][$k] && $row != ($row - $col + $k) && $col != $k) {
                        return false;
                    }
                }
            }
            if ($col > $row) {
                for ($k = 0; $k < 8 - $col+$row; $k++) {
                    if ($chessboard[$row][$col] == $chessboard[$k][$col - $row + $k] && $row != $k && $col != ($col - $row + $k)) {
                        return false;
                    }
                }
            }
            //check chéo phải sang trái
            if ($row + $col <= 6) {
                for ($k = 0; $k <= $row + $col; $k++) {
                    if ($chessboard[$row][$col] == $chessboard[$row + $col - $k][$k] && $row != $row + $col - $k && $col != $k) {
                        return false;
                    }
                }
            }

            if ($row + $col >= 8) {
                for ($k = $row + $col - 7; $k <= 7; $k++) {
                    if ($chessboard[$row][$col] == $chessboard[$row + $col - $k][$k] && $row != $row + $col - $k && $col != $k) {
                        return false;
                    }
                }
            }
        }
        return true;
    }


    for ($row = 0; $row < 8; $row++) {
        echo "<tr>";

        for ($col = 0; $col < 8; $col++) {
            $fontweight = "";
            $color = (isSafe($chessboard, $row, $col) && $chessboard[$row][$col] === 1) ? "blue" : (($row + $col) % 2 == 0 ? "white" : "black");
            $numColor = ($row + $col) % 2 != 0 ? "white" : "black";
            foreach ($randArray as $item) {
                if ($num == $item) {
                    $numColor = "red";
                    $fontweight = "bold";
                }
            }


            echo "<td height='80px' width='80px' style='background-color: $color;font-weight:$fontweight '>
                            <span style='color: $numColor'>$num</span>
                    </td>";
            $num++;
        }

        echo "</tr>";

    }
    ?>
</table>
</body>
</html>