<?php

namespace App\Models;

use App\Enums\CapitalTier;
use Database\Factories\InvestmentProjectFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class InvestmentProject extends Model
{
    /** @use HasFactory<InvestmentProjectFactory> */
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'investment_category_id',
        'governorate_id',
        'city_id',
        'title_en',
        'title_ar',
        'brief_description_en',
        'brief_description_ar',
        'full_details_en',
        'full_details_ar',
        'required_capital',
        'currency',
        'capital_tier',
        'expected_profit_rate_min',
        'expected_profit_rate_max',
        'expected_return_period_months',
        'location_description_en',
        'location_description_ar',
        'latitude',
        'longitude',
        'is_quick_return',
        'image_path',
        'is_active',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'required_capital' => 'decimal:2',
            'expected_profit_rate_min' => 'decimal:2',
            'expected_profit_rate_max' => 'decimal:2',
            'latitude' => 'decimal:7',
            'longitude' => 'decimal:7',
            'is_quick_return' => 'boolean',
            'is_active' => 'boolean',
            'capital_tier' => CapitalTier::class,
        ];
    }

    public function investmentCategory(): BelongsTo
    {
        return $this->belongsTo(InvestmentCategory::class);
    }

    public function governorate(): BelongsTo
    {
        return $this->belongsTo(Governorate::class);
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function machinery(): BelongsToMany
    {
        return $this->belongsToMany(Machinery::class, 'investment_project_machinery')
            ->withPivot('quantity', 'notes_en', 'notes_ar')
            ->withTimestamps();
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    /**
     * Return the full public URL for the project image, or null when absent.
     */
    public function imageUrl(): ?string
    {
        if ($this->image_path === null) {
            return null;
        }

        $url = config('filesystems.disks.public.url');

        return rtrim((string) $url, '/').'/'.ltrim($this->image_path, '/');
    }

    /**
     * Build a human-readable expected profit rate string.
     *
     * Examples: "20-30%", "20%", or null when both bounds are absent.
     */
    public function expectedProfitRateText(): ?string
    {
        $min = $this->expected_profit_rate_min;
        $max = $this->expected_profit_rate_max;

        if ($min === null && $max === null) {
            return null;
        }

        if ($max === null || $min === null) {
            return $this->formatRate($min ?? $max).'%';
        }

        return $this->formatRate($min).'-'.$this->formatRate($max).'%';
    }

    /**
     * Format a numeric profit rate without trailing zeros.
     */
    private function formatRate(mixed $value): string
    {
        $number = (float) $value;

        return rtrim(rtrim(number_format($number, 2, '.', ''), '0'), '.');
    }
}
