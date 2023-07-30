<?php

namespace Modules\User\Entities;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\NewAccessToken;
use Modules\Base\Enums\FilterOperator;
use Spatie\Permission\Traits\HasPermissions;
use Spatie\Permission\Traits\HasRoles;

/**
 *
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, HasPermissions;

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

    public function scopeFilterValue($query, array $filter)
    {
        foreach ($filter as $filterItem) {
            $operator = $filterItem['operator'];
            $filterValue = array_key_exists('value', $filterItem) ? $filterItem['value'] : NULL;
            $filterColumn = $filterItem['column'];
            switch ($operator) {
                case FilterOperator::CONTAINS->value:
                    $query->where($filterColumn, 'LIKE', '%' . $filterValue . '%');
                    break;
                case FilterOperator::EQUALS->value:
                    $query->where($filterColumn, '=', $filterValue);
                    break;
                case FilterOperator::STARTS_WITH->value:
                    $query->where($filterColumn, 'LIKE', $filterValue . '%');
                    break;
                case FilterOperator::ENDS_WITH->value:
                    $query->where($filterColumn, 'LIKE', '%' . $filterValue);
                    break;
                case FilterOperator::IS_EMPTY->value:
                    $query->where(function ($query) use ($filterColumn) {
                        $query->where($filterColumn, '=', '')
                            ->orWhereNull($filterColumn);
                    });
                    break;
                case FilterOperator::IS_NOT_EMPTY->value:
                    $query->whereNotNull($filterColumn);
                    break;
                default:
                    break;
            }
        }
        return $query;
    }

    public function scopeSortColumn($query, array $sort)
    {
        foreach($sort as $sortItem) {
            $query->orderBy($sortItem['column'], $sortItem['type']);
        }
        return $query;
    }
}
