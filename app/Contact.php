<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = ['title', 'first_name', 'last_name', 'email',
        'contact_number', 'gender', 'address', 'owner_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Get contact's full name
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->attributes['title'] . ' '.
        $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }
}
