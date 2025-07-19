<?php

namespace App\Models;

use App\Models\User;
use App\Models\FormData;
use App\Models\FormFields;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
        'user_id',
        'form_name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function formFields()
    {
        return $this->hasMany(FormFields::class);
    }

      public function formData()
    {
        return $this->hasMany(FormData::class);
    }
}
