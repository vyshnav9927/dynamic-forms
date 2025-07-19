<?php

namespace App\Models;

use App\Models\Form;
use Illuminate\Database\Eloquent\Model;

class FormFields extends Model
{
    protected $fillable = [
        'form_id',
        'field_label',
        'field_type',
        'field_options'
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
}
