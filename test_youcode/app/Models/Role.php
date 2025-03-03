<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Get the users for this role.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
    
    /**
     * Check if the role has a specific name.
     */
    public function isAdmin()
    {
        return $this->name === 'admin';
    }
    
    public function isStudent()
    {
        return $this->name === 'student';
    }
    
    public function isStaff()
    {
        return $this->name === 'staff';
    }
}