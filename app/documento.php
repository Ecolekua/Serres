<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Conner\Tagging\Taggable;

class documento extends Model
{
    use Taggable;

    protected $guarded =[];


        public function estructura(){
            return $this->belongsTo(estructura::class);
        }

}
