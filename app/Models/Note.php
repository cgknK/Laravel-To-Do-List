<?php

/*
 * -m argümanı kullanılmasaydı?(create_notes_table.php?)
php artisan make:model Note -m

INFO  Model [app/Models/Note.php] created successfully.

INFO  Migration [database/migrations/2024_02_08_222404_create_notes_table.php] created successfully.

*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        'title',
        'description',
        'user_id',
        'is_remember',
        'remember_date',
        'deleted_at',
    ];

    /*
    public function user()//id2name
    {
        return $this->belongsTo(User::class);
    }
    */
}
