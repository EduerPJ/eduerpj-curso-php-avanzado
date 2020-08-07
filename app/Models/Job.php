<?php
namespace App\Models;
require_once '../../vendor/autoload.php';


use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
  protected $table = 'jobs';

  // public function getDurationAsString(){
  //   $year = floor($this->months / 12);
  //   $extraMonths = $this->months & 12;
    
  //   return "Job duration: $years years $extraMonths months";
  // }
}
