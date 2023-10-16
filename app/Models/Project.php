<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;


protected $casts=[

    "publication_date"=>"date",
    
    ];

protected $fillable=[
    "title",
    "description",
    "url_link",
    "publication_date",
    "slug",
    "image",
    "type_id"
];

public function type() {
    return $this->belongsTo(Type::class);
}

public function tecnologies() {
    return $this->belongsToMany(Tecnology::class);
}

}