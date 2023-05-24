<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    // By including these attributes in the $fillable array, you are indicating that these attributes can be mass assigned using methods like create() or update() on the model. All other attributes not listed in $fillable will be guarded and cannot be mass assigned.
    protected $fillable = ['name', 'description', 'start_date', 'end_date', 'status', 'type_id'];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function technologies()
    {
        // Many-to-Many relationship between projects and technologies
        // The pivot table is called projects_technologies
        // each project can have multiple technologies (Technology entity here)
        return $this->belongsToMany(Technology::class);
    }
}
