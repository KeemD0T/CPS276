<?php
require_once "Notes.php";

$notes = new Notes();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['begDate']) && !empty($_POST['endDate'])) {
    $notes->getNotes($_POST['begDate'], $_POST['endDate']);
} else {
    $notes->getNotes();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Notes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Display Notes</h1>
        
        <?php if ($notes->getMessage()): ?>
            <div class="alert alert-danger">
                <?php echo htmlspecialchars($notes->getMessage()); ?>
            </div>
        <?php endif; ?>

        <form method="POST" class="mb-4 p-4 border rounded shadow-sm">
            <div class="row">
                <div class="col-md-5">
                    <div class="mb-3">
                        <label for="begDate" class="form-label">Beginning Date:</label>
                        <input type="date" class="form-control" id="begDate" name="begDate">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="mb-3">
                        <label for="endDate" class="form-label">Ending Date:</label>
                        <input type="date" class="form-control" id="endDate" name="endDate">
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Get Notes</button>
                </div>
            </div>
        </form>

        <?php if (count($notes->getNotesList()) > 0): ?>
            <div class="list-group">
                <?php foreach($notes->getNotesList() as $note): ?>
                    <div class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong><?php echo date('m/d/Y h:i A', strtotime($note['date_time'])); ?></strong>
                                <p class="mb-0"><?php echo htmlspecialchars($note['note']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-info">
                No notes found.
            </div>
        <?php endif; ?>

        <div class="text-center mt-3">
            <a href="addNote.php" class="btn btn-primary">Add Note</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>