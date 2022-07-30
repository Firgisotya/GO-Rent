<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kyc extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'kyc';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
