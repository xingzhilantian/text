<?php

namespace xingkong\composertest\Http\Models;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'admins';

    protected $fillable = ['id'];

    /**
     * 通过管理员id找到对应的用户信息
     *
     * @param  string  $admin_id
     * @return \App\User
     */
    public function findForPassport($admin_id)
    {
        return $this->where('id', $admin_id)->first();
    }

    public function getGroup()
    {
        return $this->belongsTo('App\Models\Group', 'group_id', 'id');
    }

    public function scopeGetGroup($query, $select)
    {
        return $query->with(['getGroup'=>function ($query) use ($select) {
            $query->select($select);
        }]);
    }
}
