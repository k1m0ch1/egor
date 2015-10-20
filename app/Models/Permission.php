<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
  public function getRules(){
      $results = array();
      $results = [
          'name' => 'required'
      ];
      return $results;
  }
}
