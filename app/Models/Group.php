<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'user_id'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'group_user');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
