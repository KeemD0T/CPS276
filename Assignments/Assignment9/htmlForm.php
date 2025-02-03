<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Add Note</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
  <div id="wrapper">
    <h1>Add Note</h1>
    <form id="noteForm" method="post">
      <div class="form-group">
        <label for="datetime">Date and Time</label>
        <input type="datetime-local" id="datetime" name="datetime" class="form-control"><br>
        <label for="note">Note</label>
        <textarea id="note" name="note" class="form-control"></textarea>
        <br>
        <input type="button" id="addNote" class="btn btn-primary" value="Add Note">
        <div id="message" class="alert alert-danger" style="display: none;"></div>
      </div>
    </form>
  </div>

  <script src="js/Util.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="js/main.js"></script>
</body>
</html>
