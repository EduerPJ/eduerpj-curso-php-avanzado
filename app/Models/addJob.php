<?php
require_once '../../vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as Capsule;
use App\Models\Job;

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'cursophp',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

$userValidator = v::attribute('name', v::stringType()->length(1, 32))
                  ->attribute('birthdate', v::date()->minAge(18));

$userValidator->validate($user); // true

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