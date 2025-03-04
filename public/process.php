<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $email = htmlspecialchars($_POST["email"]);

    echo "<h2>Полученные данные:</h2>";
    echo "Имя: " . $name . "<br>";
    echo "Телефон: " . $phone . "<br>";
    echo "Email: " . $email . "<br>";
} else {
    echo "Ошибка: данные переданы неверным способом.";
}
?>
