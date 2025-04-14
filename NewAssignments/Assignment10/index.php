<?php
$output = "";
$acknowledgement = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'php/rest_client.php';
    $result = getWeather();
    $acknowledgement = $result[0];
    $output = $result[1];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Information</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Enter Zip Code to Get City Weather</h1>
        
        <form method="POST" action="" class="mb-4">
            <div class="mb-3">
                <label for="zip_code" class="form-label">Zip Code:</label>
                <input type="text" class="form-control" id="zip_code" name="zip_code" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    <?php if ($acknowledgement): ?>
        <p><?php echo $acknowledgement; ?></p>
    <?php endif; ?>

    <?php if ($output): ?>
        <?php echo $output; ?>
    <?php endif; ?>
</body>
</html>