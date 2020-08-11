<?php
namespace App\Models;

require_once '../../vendor/autoload.php';

  use Illuminate\Database\Capsule\Manager as Capsule;
  use App\Models\Project;

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




if (!empty($_POST)) {
    $project = new Project;
    $project->title = $_POST['title'];
    $project->description = $_POST['description'];
    $project->skill = $_POST['skill'];
    $project->save();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=h1, initial-scale=1.0">
  <title>Add Project</title>
</head>
<body>
  <h1>Add Project</h1>
  <form action="addProject.php" method="post">
    <p>
      <label for="title">Title</label>
      <input type="text" name="title" id="title">
    </p>

    <p>
      <label for="description">Description</label>
      <textarea name="description" id="description" cols="30" rows="10"></textarea>
    </p>

    <p>
      <label for="skil">Skill</label>
      <input type="text" name="skill" id="skill">
    </p>

    <p>
      <input type="submit" value="Send">
    </p>
  </form>
</body>
</html>
