<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public $table = 'categories';

    public function getName() {
        return $this->name;
    }

    public function getDocumentations() {
        $documentations = Galery::where('category_id', $this->id)->where('source_id', '!=', null)
        ->select('galeries.id', 'galeries.description', 'sources.path', 'sources.type', 'galeries.created_at')
        ->join('sources', 'galeries.source_id', '=', 'sources.id');
        return $documentations->get();
    }
}
