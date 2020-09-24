<?php
namespace App\Controllers;

use App\Models\Job;
use App\Models\Project;
use App\Controllers\BaseController;

class IndexController extends BaseController
{
    public function indexAction()
    {
        $jobs = Job::all();
        $project1 = new Project();
        $projects = [
      $project1
      ];

        $name = 'Eduer Pallares';
        $limitMonths = 2000;
        return $this->renderHTML('index.twig', [
          'name' => $name,
          'limitMonths' => $limitMonths,
          'jobs' => $jobs
        ]);
    }
}
