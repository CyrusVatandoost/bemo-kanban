<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'column_id',
        'title',
        'description',
        'order',
    ];

    public function column()
    {
        return $this->belongsTo(Column::class);
    }
}
