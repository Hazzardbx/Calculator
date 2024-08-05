<?php

ini_set('memory_limit', '512M');

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['operation'])) {
    $operation = $_POST['operation'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $timestamp = time();

    function calculate($operation) {
        $pattern = '/(\d+\.?\d*)([\+\-\*\/%])(\d+\.?\d*)/';
        if (preg_match($pattern, $operation, $matches)) {
            $num1 = floatval($matches[1]);
            $operator = $matches[2];
            $num2 = floatval($matches[3]);

            switch ($operator) {
                case '+':
                    return $num1 + $num2;
                case '-':
                    return $num1 - $num2;
                case '*':
                    return $num1 * $num2;
                case '/':
                    if ($num2 == 0) {
                        return 'ERROR';
                    }
                    return $num1 / $num2;
                case '%':
                    return $num1 % $num2;
                default:
                    return 'ERROR';
            }
        }
        return 'ERROR';
    }

    $result = calculate($operation);

    if ($result === 'ERROR') {
        echo json_encode(['result' => $result, 'bonus' => 0]);
        exit();
    }

    $bonus = rand(1, 100) == 50 ? 1 : 0;

    $sql = "SELECT hash FROM calculations ORDER BY id DESC LIMIT 1";
    $result_last = $conn->query($sql);

    if ($result_last) {
        $last_hash = $result_last->num_rows > 0 ? $result_last->fetch_assoc()['hash'] : '0000000000000000000000000000000000000000';
        $result_last->free();
    } else {
        $last_hash = '0000000000000000000000000000000000000000';
    }

    $hash = sha1($ip . $timestamp . $operation . $result . $bonus);

    $stmt = $conn->prepare("INSERT INTO calculations (ip, timestamp, operation, result, bonus, hash, parent_hash) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        $stmt->bind_param("sisdiss", $ip, $timestamp, $operation, $result, $bonus, $hash, $last_hash);
        $stmt->execute();
        $stmt->close();
    } else {
        echo json_encode(['result' => 'ERROR', 'bonus' => 0]);
        exit();
    }

    $conn->close();

    echo json_encode(['result' => $result, 'bonus' => $bonus]);

} else {
    echo json_encode(['error' => 'Invalid request']);
}
?>
