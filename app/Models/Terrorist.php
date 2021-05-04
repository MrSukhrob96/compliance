<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Terrorist extends Model
{
    use HasFactory;

    protected $fillable = array(
        "status_id", "post_type", "fio", "date_birth", "date_add", "document_type", "document_number", 'comment'
    );
}
