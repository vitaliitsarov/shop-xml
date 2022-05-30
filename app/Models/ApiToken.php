<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ApiToken extends Model
{
    use SoftDeletes;

    const ATTRIBUTE_ID          = 'id';
    const ATTRIBUTE_TOKEN       = 'token';
    const ATTRIBUTE_STATUS      = 'status';

    /**
     * @var string
     */
    protected $primaryKey = self::ATTRIBUTE_ID;

    /**
     * @var string
     */
    protected $table = "api_tokens";

    protected $fillable = [
        self::ATTRIBUTE_ID,
        self::ATTRIBUTE_TOKEN,
        self::ATTRIBUTE_STATUS,
    ];

    protected $casts = [
        self::ATTRIBUTE_STATUS  => 'boolean',
        self::ATTRIBUTE_TOKEN   => 'string',
    ];

    /**
     * getToken
     *
     * @return string
     */
    public function getToken(): string
    {
        return (string) $this->getAttribute(self::ATTRIBUTE_TOKEN);
    }

    /**
     * setToken
     *
     * @param  mixed $value
     * @return ApiToken
     */
    public function setToken($value): ApiToken
    {
        return $this->setAttribute(self::ATTRIBUTE_TOKEN, $value);
    }

    /**
     * getStatus
     *
     * @return 
     */
    public function getStatus()
    {
        return $this->getAttribute(self::ATTRIBUTE_STATUS);
    }

    /**
     * setStatus
     *
     * @param  mixed $value
     * @return ApiToken
     */
    public function setStatus($value): ApiToken
    {
        return $this->setAttribute(self::ATTRIBUTE_STATUS, $value);
    }

}
