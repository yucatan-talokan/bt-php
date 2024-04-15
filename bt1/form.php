<?php
$inputString = $_POST["string"];
$inputBp = (int)$_POST["bp"];
function slice($str, $bp)
{
    $words = explode(" ", $str); //TÁCH CHUỖI THÀNH MẢNG CÁC TỪ ĐƠN
    $result = []; //Mảng để hứng chuỗi sau khi tách
    $currentString = ""; //Mảng hiện tại
    foreach ($words as $word) {
        if (strlen($currentString) + strlen($word) >= $bp) { //Check xem nếu độ dài chuỗi con vượt quá breakpoint thì cắt
            $result[] = $currentString;
            $currentString = "";
        }
        $currentString .= ($currentString ? " " : "") . $word;// Nếu mảng hiện tại không null thì + khoảng trống
        // + với chuỗi con
    }
    if ($currentString) {
        $result[] = $currentString;
    }
    if (empty($result)) {
        echo "<p> There is nothing here. </p>";
    } else {
        foreach ($result as $r) {
            echo "<p> $r </p>";
        }
    }
}

?>
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
<form action="form.php" method="post">
    String: <input type="text" name="string" value="<?php echo $inputString ?>">
    Brake point: <input type="text" name="bp" value="<?php echo $inputBp ?>">
    <input type="submit" value="Slice">
</form>
<?php slice($inputString, $inputBp); ?>
</body>
</html>
