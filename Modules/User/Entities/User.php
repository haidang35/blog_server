<?php

namespace Modules\User\Entities;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\NewAccessToken;
use Modules\Base\Traits\HandleFilterRecord;
use Modules\Site\Traits\BelongsToSite;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

/**
 *
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasPermissions, HandleFilterRecord, BelongsToSite;

    CONST ID = 'id';

    protected $guard_name = 'sanctum';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub
    }

    /**
     * @param string $name
     * @param array $abilities
     * @param DateTimeInterface|null $expiresAt
     * @return NewAccessToken
     */
    public function createToken(string $name, array $abilities = ['*'], DateTimeInterface $expiresAt = null)
    {
        $token = $this->tokens()->create([
            'name' => $name,
            'token' => hash('sha256', $plainTextToken = Str::random(200)),
            'abilities' => $abilities,
            'expires_at' => $expiresAt,
        ]);

        return new NewAccessToken($token, $token->getKey() . '|' . $plainTextToken);
    }

    protected static function newFactory()
    {
        return \Modules\User\Database\factories\UserFactory::new();
    }
}
