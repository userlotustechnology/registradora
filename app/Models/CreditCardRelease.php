<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CreditCardRelease extends Model
{
    protected $fillable = [
        'uuid',
        'value_record_id',
        'end_customer_id',
        'amount',
        'installment_number',
        'scheduled_date',
        'processed',
        'processed_at',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'scheduled_date' => 'date',
        'processed' => 'boolean',
        'processed_at' => 'datetime',
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
     * Relacionamento com o registro de valor
     */
    public function valueRecord()
    {
        return $this->belongsTo(ValueRecord::class);
    }

    /**
     * Relacionamento com o cliente
     */
    public function endCustomer()
    {
        return $this->belongsTo(EndCustomer::class);
    }
}