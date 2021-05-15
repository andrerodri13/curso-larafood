<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPlan extends Model
{
    protected $table = 'details_plan';

    protected $fillable = [
        'name',
        'plan_id'
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
