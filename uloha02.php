<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Úloha 02</title>
</head>
<body>

<?php
require_once "connect.php";
?>

<h1>požiadavka 01</h1>
<?php
$sql = "
    SELECT o.OrderID, o.OrderDate, c.CustomerID, c.CompanyName 
    FROM orders o
    JOIN customers c ON o.CustomerID = c.CustomerID
    WHERE YEAR(o.OrderDate) = 1996
";
$result = $conn->query($sql);
echo "<table>";
echo "<tr><th>Order ID</th><th>Order Date</th><th>Customer ID</th><th>Company Name</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['OrderID']}</td><td>{$row['OrderDate']}</td><td>{$row['CustomerID']}</td><td>{$row['CompanyName']}</td></tr>";
}
echo "</table>";
?>

<h1>požiadavka 02</h1>
<?php
$sql = "
    SELECT COUNT(e.EmployeeID) as employee_count, COUNT(c.CustomerID) as customer_count, e.City 
    FROM employees e 
    LEFT JOIN customers c ON e.City = c.City 
    GROUP BY e.City
";
$result = $conn->query($sql);
echo "<table>";
echo "<tr><th>City</th><th>Employee Count</th><th>Customer Count</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['City']}</td><td>{$row['employee_count']}</td><td>{$row['customer_count']}</td></tr>";
}
echo "</table>";
?>

<h1>požiadavka 03</h1>
<?php
$sql = "
    SELECT COUNT(e.EmployeeID) as employee_count, COUNT(c.CustomerID) as customer_count, c.City 
    FROM customers c 
    LEFT JOIN employees e ON c.City = e.City 
    GROUP BY c.City
";
$result = $conn->query($sql);
echo "<table>";
echo "<tr><th>City</th><th>Employee Count</th><th>Customer Count</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['City']}</td><td>{$row['employee_count']}</td><td>{$row['customer_count']}</td></tr>";
}
echo "</table>";
?>

<h1>požiadavka 04</h1>
<?php
$sql = "
    SELECT city, 
    SUM(CASE WHEN source = 'employee' THEN 1 ELSE 0 END) as employee_count, 
    SUM(CASE WHEN source = 'customer' THEN 1 ELSE 0 END) as customer_count
    FROM (
    SELECT City, 'employee' as source FROM employees
    UNION ALL
    SELECT City, 'customer' as source FROM customers
    ) as combined
    GROUP BY city
";
$result = $conn->query($sql);
echo "<table>";
echo "<tr><th>City</th><th>Employee Count</th><th>Customer Count</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['city']}</td><td>{$row['employee_count']}</td><td>{$row['customer_count']}</td></tr>";
}
echo "</table>";
?>

<h1>požiadavka 05</h1>
<?php
$date = '1995-09-28';
$sql = "
    SELECT o.OrderID, o.OrderDate, e.EmployeeID, e.LastName, e.FirstName
    FROM orders o
    JOIN employees e ON o.EmployeeID = e.EmployeeID
    WHERE o.OrderDate > '$date'
";
$result = $conn->query($sql);
echo "<table>";
echo "<tr><th>Order ID</th><th>Order Date</th><th>Employee ID</th><th>Employee Name</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['OrderID']}</td><td>{$row['OrderDate']}</td><td>{$row['EmployeeID']}</td><td>{$row['LastName']} {$row['FirstName']}</td></tr>";
}
echo "</table>";
?>

<h1>požiadavka 06</h1>
<?php
$sql = "
    SELECT ProductID, SUM(Quantity) as total_quantity
    FROM `order details`
    GROUP BY ProductID
    HAVING total_quantity < 200
";
$result = $conn->query($sql);
echo "<table>";
echo "<tr><th>Product ID</th><th>Total Quantity</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['ProductID']}</td><td>{$row['total_quantity']}</td></tr>";
}
echo "</table>";
?>

<h1>požiadavka 07</h1>
<?php
$date = '1994-12-31';
$sql = "
    SELECT c.CustomerID, c.CompanyName, COUNT(o.OrderID) as order_count
    FROM customers c
    LEFT JOIN orders o ON c.CustomerID = o.CustomerID
    WHERE o.OrderDate > '$date'
    GROUP BY c.CustomerID
    HAVING order_count > 15
";
$result = $conn->query($sql);
echo "<table>";
echo "<tr><th>Customer ID</th><th>Company Name</th><th>Order Count</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['CustomerID']}</td><td>{$row['CompanyName']}</td><td>{$row['order_count']}</td></tr>";
}
echo "</table>";
?>

<?php $conn->close(); ?>

</body>
</html>
