<?php

namespace App\Models;

use App\Models\Form;
use Illuminate\Database\Eloquent\Model;

class FormData extends Model
{
    protected $fillable = [
        'form_id',
        'formdata',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
