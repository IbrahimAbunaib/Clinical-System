<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "payment_database";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $notes = $_POST['notes'];
    $payment_method = $_POST['payment_method'];

    $sql = $conn->prepare("INSERT INTO payments (name, amount, date, notes, payment_method) VALUES (?, ?, ?, ?, ?)");
    $sql->bind_param("sdsss", $name, $amount, $date, $notes, $payment_method);

    if ($sql->execute()) {
        echo "Payment recorded successfully!";
    } else {
        echo "Error: " . $sql->error; 
        
    }

    $sql->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <style>
        body {
            display: flex;
            justify-content: center; 
            align-items: center;     
            min-height: 100vh;        
            margin: 0;             
            font-family: sans-serif; 
        }

        .container {
            width: 300px; 
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); 
            background-color: #f616d4; 
        }

        .container h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .container input,
        .container textarea,
        .container select,
        .container button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; 
        }

        .container button {
            background-color: #4CAF50; 
            color: white;
            cursor: pointer;
            transition: background-color 0.3s; 
        }

        .container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form action="paymentphp.php" method="post">
        <div class="container">
            <h1 class="word">Payment</h1>

            <input type="text" name="id" placeholder="ID" required>
            <br>

            <input type="text" name="name" placeholder="Name" required>
            <br>

            <input type="number" name="amount" placeholder="Amount Paid" required>
            <br>

            <label for="date">Expiry Date:</label>
            <input type="datetime-local" name="date" id="date" required>
            <br>

            <textarea name="notes" placeholder="Notes" rows="4"></textarea> 
            <br>

            <p>Payment method</p>
            <select name="payment_method" required>
                <option value="Credit_card">Credit card</option>
                <option value="Cash">Cash</option>
            </select>
            <br>

            <button type="submit">Done</button>
        </div>
    </form>
</body>
</html>
