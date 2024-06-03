<?php
require_once "connect.php";
require_once "menu.php";

// požiadavka 01
$sql_zakaznici = "SELECT * FROM Customers";
$result_zakaznici = $conn->query($sql_zakaznici);

$sql_objednavky = "SELECT * FROM Orders";
$result_objednavky = $conn->query($sql_objednavky);

$sql_dodavatelia = "SELECT * FROM Suppliers";
$result_dodavatelia = $conn->query($sql_dodavatelia);

// požiadavka 02
$sql_abecedne_zakaznici = "SELECT * FROM Customers ORDER BY Country, CompanyName";
$result_abecedne_zakaznici = $conn->query($sql_abecedne_zakaznici);

// požiadavka 03
$sql_objednavky_datum = "SELECT * FROM Orders ORDER BY OrderDate";
$result_objednavky_datum = $conn->query($sql_objednavky_datum);

// požiadavka 04
$sql_pocet_objednavok_1997 = "SELECT COUNT(*) as pocet FROM Orders WHERE YEAR(OrderDate) = 1997";
$result_pocet_objednavok_1997 = $conn->query($sql_pocet_objednavok_1997);
$row_pocet_objednavok_1997 = $result_pocet_objednavok_1997->fetch_assoc();

// požiadavka 05
$sql_manazeri = "SELECT ContactName FROM Employees WHERE Title LIKE '%Manager%' ORDER BY ContactName";
$result_manazeri = $conn->query($sql_manazeri);

// požiadavka 06
$sql_objednavky_19_maj_1997 = "SELECT * FROM Orders WHERE OrderDate = '1997-05-19'";
$result_objednavky_19_maj_1997 = $conn->query($sql_objednavky_19_maj_1997);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uloha01</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="wrapper">
        <div class="messages">
            <?php
            if (!empty($success_message)) {
                echo "<p class='success-message'>$success_message</p>";
            }
            if (!empty($error_message)) {
                echo "<p class='error-message'>$error_message</p>";
            }
            ?>
        </div>

        <h1>požiadavka 01</h1>
        <h2>Zákazníci</h2>
        <table>
            <thead>
                <tr>
                    <?php
                    $fields = $result_zakaznici->fetch_fields();
                    foreach ($fields as $field) {
                        echo "<th>{$field->name}</th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result_zakaznici->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>{$value}</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <h2>Objednávky</h2>
        <table>
            <thead>
                <tr>
                    <?php
                    $fields = $result_objednavky->fetch_fields();
                    foreach ($fields as $field) {
                        echo "<th>{$field->name}</th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result_objednavky->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>{$value}</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <h2>Dodávatelia</h2>
        <table>
            <thead>
                <tr>
                    <?php
                    $fields = $result_dodavatelia->fetch_fields();
                    foreach ($fields as $field) {
                        echo "<th>{$field->name}</th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result_dodavatelia->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>{$value}</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <h1>požiadavka 02</h1>
        <table>
            <thead>
                <tr>
                    <?php
                    $fields = $result_abecedne_zakaznici->fetch_fields();
                    foreach ($fields as $field) {
                        echo "<th>{$field->name}</th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result_abecedne_zakaznici->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>{$value}</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <h1>požiadavka 03</h1>
        <table>
            <thead>
                <tr>
                    <?php
                    $fields = $result_objednavky_datum->fetch_fields();
                    foreach ($fields as $field) {
                        echo "<th>{$field->name}</th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result_objednavky_datum->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>{$value}</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <h1>požiadavka 04</h1>
        <p>Počet všetkých objednávok uskutočnených v roku 1997: <?php echo $row_pocet_objednavok_1997['pocet']; ?></p>

        <h1>požiadavka 05</h1>
        <table>
            <thead>
                <tr>
                    <th>Meno</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result_manazeri->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['ContactName']}</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <h1>požiadavka 06</h1>
        <table>
            <thead>
                <tr>
                    <?php
                    $fields = $result_objednavky_19_maj_1997->fetch_fields();
                    foreach ($fields as $field) {
                        echo "<th>{$field->name}</th>";
                    }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = $result_objednavky_19_maj_1997->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>{$value}</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
