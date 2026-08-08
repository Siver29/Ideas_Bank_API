<?php

namespace App\Models;

use Database\Factories\MachineryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Machinery extends Model
{
    /** @use HasFactory<MachineryFactory> */
    use HasFactory;

    /**
     * The table associated with the model.
     */
    protected $table = 'machinery';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name_en',
        'name_ar',
        'description_en',
        'description_ar',
    ];

    public function investmentProjects(): BelongsToMany
    {
        return $this->belongsToMany(InvestmentProject::class, 'investment_project_machinery')
            ->withPivot('quantity', 'notes_en', 'notes_ar')
            ->withTimestamps();
    }
}
