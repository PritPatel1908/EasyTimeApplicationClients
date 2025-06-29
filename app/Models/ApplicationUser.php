<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApplicationUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'client_code',
        'allow_login',
        'url',
    ];

    protected $casts = [
        'allow_login' => 'boolean',
    ];

    /**
     * Get the client that owns the application user.
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }
}
