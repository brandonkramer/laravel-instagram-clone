<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    /**
     * @var array
     */
    protected $guarded = [];


    public function profileImage ()
    {
        $imagePath = $this->image ? $this->image :
            'profile/O4jEFwBgAgMy0YmQ6EF71jqYBpdp8Rfgg87sY1j2.png';
        return '/storage/' . $imagePath;
    }

    public function followers ()
    {
        return $this->belongsToMany( User::class );
    }

    public function user ()
    {
        return $this->belongsTo( User::class );
    }
}
