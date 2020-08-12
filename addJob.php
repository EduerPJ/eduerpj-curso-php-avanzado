<?php
use App\Models\Job;

if (!empty($_POST)) {
    $job  = new Job();
    $job->title = $_POST['title'];
    $job->description = $_POST['description'];
    $job->visible = true;
    $job->months = 16;
    $job->save();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="index_files/bootstrap.css" integrity="sha384-Smlep5jCw/wG7hdkwQ/Z5nLIefveQRIY9nfy6xoR1uRYBtpZgI6339F5dgvm/e9B" crossorigin="anonymous">
  <link rel="stylesheet" href="index_files/style.css">

  <title>Add Job</title>
</head>
<body>
  <h1>Add Job</h1>
  <form action="addJob.php" method="POST">
    <label for="title">Title: </label>
    <input type="text" name="title"> <br>

    <label for="description">Description:</label>
    <input type="text" name="description">
    <input type="submit" value="Save">
  </form>
</body>
</html>