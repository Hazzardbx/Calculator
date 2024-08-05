<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Calculadora</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Calculadora</h1>
        <div class="calculator">
            <input type="text" id="display" readonly>
            <div class="buttons">
                <form method="post" action="calculate.php">
                <input type="hidden" name="operation" id="operation">
                    <button type="button" value="1">1</button>
                    <button type="button" value="2">2</button>
                    <button type="button" value="3">3</button>
                    <button type="button" value="+">+</button>
                    <button type="button" value="4">4</button>
                    <button type="button" value="5">5</button>
                    <button type="button" value="6">6</button>
                    <button type="button" value="-">-</button>
                    <button type="button" value="7">7</button>
                    <button type="button" value="8">8</button>
                    <button type="button" value="9">9</button>
                    <button type="button" value="*">*</button>
                    <button type="button" value="0">0</button>
                    <button type="button" value=".">.</button>
                    <button type="button" value="/">/</button>
                    <button type="button" value="MOD">MOD</button>
                    <button type="button" id="reset">C</button>
                    <button type="submit" id="equals">=</button>
                </form>
            </div>
        </div>
    </div>
    <script src="main.js"></script>
</body>
</html>
