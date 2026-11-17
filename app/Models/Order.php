<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    public const STATUSES = [
        'menunggu_konfirmasi' => 'Menunggu Konfirmasi',
        'diproses' => 'Diproses',
        'dikirim' => 'Dikirim',
        'selesai' => 'Selesai',
        'dibatalkan' => 'Dibatalkan',
    ];

    protected $fillable = [
        'order_code',
        'customer_name',
        'customer_phone',
        'customer_email',
        'address',
        'notes',
        'total',
        'status',
    ];

    protected $casts = [
        'total' => 'integer',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getRouteKeyName(): string
    {
        return 'order_code';
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? $this->status;
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp '.number_format($this->total, 0, ',', '.');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match ($this->status) {
            'menunggu_konfirmasi' => 'bg-amber-100 text-amber-800 ring-amber-600/20',
            'diproses' => 'bg-blue-100 text-blue-800 ring-blue-600/20',
            'dikirim' => 'bg-indigo-100 text-indigo-800 ring-indigo-600/20',
            'selesai' => 'bg-emerald-100 text-emerald-800 ring-emerald-600/20',
            'dibatalkan' => 'bg-rose-100 text-rose-800 ring-rose-600/20',
            default => 'bg-slate-100 text-slate-800 ring-slate-600/20',
        };
    }

    public function scopeStatus($query, ?string $status)
    {
        return $status ? $query->where('status', $status) : $query;
    }
}
