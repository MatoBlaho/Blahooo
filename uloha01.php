<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Úloha 01</title>
    <link rel="stylesheet" href="uloha01.css">
</head>
<body>

<?php
require_once "connect.php";
?>

<h1>požiadavka 01</h1>
<?php
$sql = "
    SELECT * FROM customers;
    SELECT * FROM orders;
    SELECT * FROM suppliers;
";
$conn->multi_query($sql);
do {
    if ($result = $conn->store_result()) {
        echo "<table>";
        while ($fieldinfo = $result->fetch_field()) {
            echo "<th>{$fieldinfo->name}</th>";
        }
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            foreach ($row as $cell) {
                echo "<td>{$cell}</td>";
            }
            echo "</tr>";
        }
        echo "</table><br>";
        $result->free();
    }
} while ($conn->next_result());
?>

<h1>požiadavka 02</h1>
<?php
$sql = "SELECT * FROM customers ORDER BY Country, CompanyName";
$result = $conn->query($sql);
echo "<table>";
while ($fieldinfo = $result->fetch_field()) {
    echo "<th>{$fieldinfo->name}</th>";
}
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    foreach ($row as $cell) {
        echo "<td>{$cell}</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>

<h1>požiadavka 03</h1>
<?php
$sql = "SELECT * FROM orders ORDER BY OrderDate";
$result = $conn->query($sql);
echo "<table>";
while ($fieldinfo = $result->fetch_field()) {
    echo "<th>{$fieldinfo->name}</th>";
}
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    foreach ($row as $cell) {
        echo "<td>{$cell}</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>

<h1>požiadavka 04</h1>
<?php
$sql = "SELECT COUNT(*) as order_count FROM orders WHERE YEAR(OrderDate) = 1995";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
echo "<p>Počet objednávok uskutočnených v roku 1995: {$row['order_count']}</p>";
?>

<h1>požiadavka 05</h1>
<?php
$sql = "SELECT ContactName FROM customers WHERE ContactTitle = 'Marketing Manager' ORDER BY ContactName";
$result = $conn->query($sql);
echo "<table>";
echo "<tr><th>Contact Name</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['ContactName']}</td></tr>";
}
echo "</table>";
?>

<h1>požiadavka 06</h1>
<?php
$sql = "SELECT * FROM orders WHERE OrderDate = '1995-09-28'";
$result = $conn->query($sql);
echo "<table>";
while ($fieldinfo = $result->fetch_field()) {
    echo "<th>{$fieldinfo->name}</th>";
}
while ($row = $result->fetch_assoc()) {
    echo "<tr>";
    foreach ($row as $cell) {
        echo "<td>{$cell}</td>";
    }
    echo "</tr>";
}
echo "</table>";
?>

<?php $conn->close(); ?>

</body>
</html>
