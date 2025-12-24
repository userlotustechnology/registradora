<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class EndCustomer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'partner_id',
        'name',
        'document',
        'available_balance',
        'credit_balance',
        'credit_card_receipt_type',
        'credit_card_days',
    ];

    protected $casts = [
        'available_balance' => 'decimal:2',
        'credit_balance' => 'decimal:2',
        'credit_card_days' => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * Relacionamento com parceiro
     */
    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    /**
     * Relacionamento com registros de valores
     */
    public function valueRecords()
    {
        return $this->hasMany(ValueRecord::class);
    }

    /**
     * Relacionamento com liberações agendadas de cartão de crédito
     */
    public function creditCardReleases()
    {
        return $this->hasMany(CreditCardRelease::class);
    }
}
