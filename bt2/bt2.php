<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
        echo $item."-";
    }

    for ($row=0;$row<8;$row++){
        for ($col=0;$col<8;$col++){
            if ($chessboard[$row][$col] === 1) {
                for ($k = 0; $k < 8; $k++) {
                    //check đường ngang
                    if ($k != $col) {
                        $chessboard[$row][$k] = 2;
                    }
                    //check đường dọc
                    if ($k != $row) {
                        $chessboard[$k][$col] = 2;
                    }
                    //check đường chéo
                    $diagonal1 = $row - $col + $k;
                    $diagonal2 = $row + $col - $k;
                    if ($diagonal1 >= 0 && $diagonal1 < 8 && $diagonal1 != $row && $diagonal1 != $col) {
                        $chessboard[$diagonal1][$k] = 2;

                    }
                    if ($diagonal2 >= 0 && $diagonal2 < 8 && $diagonal2 != $row && $diagonal2 != $col) {
                        $chessboard[$diagonal2][$k] = 2;
                    }
                }
            }
        }
    }

    for ($row = 0; $row < 8; $row++) {
        echo "<tr>";

        for ($col = 0; $col < 8; $col++) {
            $color = ($row + $col) % 2 == 0 ? "white" : "black";
            $numColor = ($row + $col) % 2 != 0 ? "white" : "black";

            if ($chessboard[$row][$col] === 1) {
                $color="red";
            }


            echo "<td height='80px' width='80px' style='background-color: $color'>
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
