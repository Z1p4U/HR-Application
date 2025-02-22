<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetPasswordCode extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'code',
        'created_at',
        'updated_at',
    ];

    /**
     * check if the code is expire then delete
     *
     * @return void
     */
    public function isExpire()
    {
        if ($this->created_at > now()->addHour()) {
            $this->delete();
        }
    }
}
