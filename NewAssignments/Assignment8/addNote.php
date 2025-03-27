<?php
require_once "Notes.php";

$notes = new Notes();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $notes->addNote($_POST['dateTime'], $_POST['note']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Note</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Add Note</h1>
        <?php if ($notes->getMessage()): ?>
            <div class="alert alert-info">
                <?php echo htmlspecialchars($notes->getMessage()); ?>
            </div>
        <?php endif; ?>
        <form method="post" action="addNote.php" class="p-4 border rounded shadow-sm">
            <div class="mb-3">
                <label for="dateTime" class="form-label">Date and Time:</label>
                <input type="datetime-local" class="form-control" id="dateTime" name="dateTime" required>
            </div>
            <div class="mb-3">
                <label for="note" class="form-label">Note:</label>
                <textarea id="note" name="note" rows="4" class="form-control" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary w-100">Add Note</button>
        </form>
        <div class="text-center mt-3">
            <a href="displayNotes.php" class="btn btn-secondary">View Notes</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>