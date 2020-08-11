<?php
namespace App\Models;

use App\Models\Job;

$jobs = Job::all();

// $project1 = new Project('Project 1', 'Description 1');

function printElement($job)
{
    if ($job->visible == false) {
        return;
    }
}
if ($jobs) {
    foreach ($jobs as $job) {
        echo '<li class="work-position">';
        echo '<h5>' . $job->title . '</h5>';
        echo '<p>' . $job->description . '</p>';
        // echo '<p>' . $job->gerDurationAsString() . '</p>';
        echo '<strong>Achievements:</strong>';
        echo '<ul>';
        echo '<li> Estoy destinado a ser exitoso en mi vida. Eduer </li>';
        echo '<li> Estoy destinado a ser exitoso en mi vida. Eduer </li>';
        echo '<li> Estoy destinado a ser exitoso en mi vida. Eduer </li>';
        echo '</ul>';
    }
}
