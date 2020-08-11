<?php

namespace lib1;

use App\Models\Project;

$projects = Project::all();

if ($projects) {
    foreach ($projects as $project) {
        echo '<li class="work-position">';
        echo '<h5>' . $project->title . '</h5>';
        echo '<p>' . $project->description . '</p>';
        echo '<p>' . '<strong>' .$project->skill . '</strong>' . '</p>';
    }
}
