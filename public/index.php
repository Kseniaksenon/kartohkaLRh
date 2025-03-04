<?php
// Подключение к базе данных
$servername = "localhost"; // Адрес сервера (чаще всего localhost)
$username = "root";        // Имя пользователя (по умолчанию root)
$password = "123456789_K"; // Пароль (по умолчанию пустой)
$dbname = "product_rental"; // Имя базы данных

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка подключения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Обработка выбранной даты
$selected_date = isset($_POST['issue_date']) ? $_POST['issue_date'] : '';

// Если дата выбрана, выполняем SQL-запрос
if ($selected_date) {
    // Подготовка и выполнение запроса
    $sql = "SELECT * FROM `clients` WHERE `issue_date` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $selected_date);
    $stmt->execute();
    $result = $stmt->get_result();

    // Проверка, есть ли записи
    if ($result->num_rows > 0) {
        // Вывод данных в таблицу
        echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Фамилия</th>
                    <th>Серия и номер паспорта</th>
                    <th>Адрес</th>
                    <th>Наименование товара</th>
                    <th>Дата выдачи</th>
                    <th>Дата возврата</th>
                    <th>Стоимость проката (за сутки)</th>
                </tr>";

        // Вывод каждой записи
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["id"] . "</td>
                    <td>" . $row["last_name"] . "</td>
                    <td>" . $row["passport_series_and_number"] . "</td>
                    <td>" . $row["address"] . "</td>
                    <td>" . $row["item_name"] . "</td>
                    <td>" . $row["issue_date"] . "</td>
                    <td>" . $row["return_date"] . "</td>
                    <td>" . $row["rental_cost_per_day"] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "Нет записей, соответствующих запросу.";
    }
} else {
    echo "Пожалуйста, выберите дату.";
}

// Закрытие соединения
$conn->close();
?>

<!-- Форма для выбора даты -->
<form method="post" action="">
    <label for="issue_date">Выберите дату выдачи:</label>
    <input type="date" id="issue_date" name="issue_date" value="2016-12-12">
    <button type="submit">Показать данные</button>
</form>
