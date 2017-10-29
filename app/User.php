<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'tenant_id', 'full_name', 'avatar'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The account is created by this user. One-to-many relationship.
     */
    public function accounts()
    {
        return $this->hasMany('App\Models\Account');
    }

    /**
     * Ticket is assigned to this user.
     */
    public function tickets()
    {
        return $this->hasMany('App\Models\Ticket', 'user_id');
    }

    /**
     * User belongs to this tenant.
     */
    public function tenant()
    {
        return $this->belongsTo('App\Models\Tenant', 'tenant_id');
    }
}
