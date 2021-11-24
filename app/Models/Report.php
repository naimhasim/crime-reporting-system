<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Users;
class Report extends Model
{
    use HasFactory;

    protected $table='report';
    protected $fillable =[
        'report_title',
        'report_desc',
        'report_media',
        'crime_category',
        'latitude',
        'longitude',
        'location',
    ];

    public function users()
    {
        return $this->belongsTo(Users::class);
    }
}
