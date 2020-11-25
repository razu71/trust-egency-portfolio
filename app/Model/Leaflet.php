<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Leaflet extends Model
{
    //
    public function getLeafletPage()
    {
        return $this->hasMany(LeafletPage::class,'leaflet_id');
    }
}
