<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_Tag extends Model
{
    use HasFactory;

    protected $fillable = ['post_id' , 'tag_id'];
    protected $table = 'post_tag';
    protected $primaryKey = ['post_id', 'tag_id'];
    public $incrementing = false;
}
