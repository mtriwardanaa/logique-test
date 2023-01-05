<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $credit_card_id
 * @property integer $user_id
 * @property string $type
 * @property string $number
 * @property string $name
 * @property string $expired
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 */
class UserCreditCard extends Model
{
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'credit_card_id';

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'type', 'number', 'name', 'expired', 'ccv', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', null, 'user_id');
    }
}
