<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InvestmentProjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
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
            'full_details_en' => $this->full_details_en,
            'full_details_ar' => $this->full_details_ar,
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
            'location_description_en' => $this->location_description_en,
            'location_description_ar' => $this->location_description_ar,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'is_quick_return' => $this->is_quick_return,
            'image_url' => $this->imageUrl(),
            'machinery' => ProjectMachineryResource::collection($this->whenLoaded('machinery')),
            'created_at' => $this->created_at?->toISOString(),
            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}
