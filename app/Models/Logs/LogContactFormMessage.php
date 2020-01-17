<?php

namespace App\Models\Logs;

use Illuminate\Database\Eloquent\Model;

class LogContactFormMessage extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'log_contact_form_messages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['data'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['data' => 'array'];
}
