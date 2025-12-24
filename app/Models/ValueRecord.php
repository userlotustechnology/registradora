<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ValueRecord extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid',
        'partner_id',
        'end_customer_id',
        'total_amount',
        'transaction_type',
        'installments',
        'installment_amount',
        'description',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'installment_amount' => 'decimal:2',
        'installments' => 'integer',
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
     * Relacionamento com cliente final
     */
    public function endCustomer()
    {
        return $this->belongsTo(EndCustomer::class);
    }
}
