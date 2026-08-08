<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvestmentProjectSummaryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * Includes the fields the frontend needs for local search and filtering.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title_en' => $this->title_en,
            'title_ar' => $this->title_ar,
            'brief_description_en' => $this->brief_description_en,
            'brief_description_ar' => $this->brief_description_ar,
            'category' => $this->whenLoaded('investmentCategory', fn () => new InvestmentCategoryResource($this->investmentCategory)),
            'governorate' => $this->whenLoaded('governorate', fn () => new GovernorateResource($this->governorate)),
            'city' => $this->whenLoaded('city', fn () => new CityResource($this->city)),
            'required_capital' => $this->required_capital,
            'currency' => $this->currency,
            'capital_tier' => $this->capital_tier?->value,
            'expected_profit_rate_min' => $this->expected_profit_rate_min,
            'expected_profit_rate_max' => $this->expected_profit_rate_max,
            'expected_profit_rate_text' => $this->expectedProfitRateText(),
            'expected_return_period_months' => $this->expected_return_period_months,
            'is_quick_return' => $this->is_quick_return,
            'image_url' => $this->imageUrl(),
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
