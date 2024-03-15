<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deposit Form</title>
</head>

<body>
    <h1>Deposit Form</h1>
    <form action="{{ route('deposit.process') }}" method="post">
        @csrf
        <label for="amount">Amount:</label>
        <input type="number" name="amount" id="amount" required>
        <button type="submit">Deposit</button>
    </form>


</body>

</html>
