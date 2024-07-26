<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use App\Models\Groups;

class Helper{
  
        public static function  get_group_name($id) {
          $group = Groups::where('id', $id)->first();
          //$group =  Groups::where('id', $id)->select(['name'])->first();
          rerurn $group->name;
   }

}

