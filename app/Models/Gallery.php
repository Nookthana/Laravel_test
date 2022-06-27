<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    /**
 * The table associated with the model.
 *
 * @var string
 */
    protected $table = 'gallery';
    protected $fillable = ['categories_id','user_id','src','size','mine'];

}
