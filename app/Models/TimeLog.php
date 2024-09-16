<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $project_id
 * @property \Illuminate\Support\Carbon $start_time
 * @property \Illuminate\Support\Carbon $stop_time
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Project $project
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\TimeLogFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|TimeLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TimeLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TimeLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|TimeLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimeLog whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimeLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimeLog whereProjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimeLog whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimeLog whereStopTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimeLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TimeLog whereUserId($value)
 * @mixin \Eloquent
 */
class TimeLog extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'project_id',
        'start_time',
        'stop_time',
        'description',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'project_id' => 'integer',
        'start_time' => 'datetime',
        'stop_time' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
