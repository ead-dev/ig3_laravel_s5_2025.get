<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AbsenceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'token'=>$this->token,
            'inscription'=>$this->inscription,
            'semestre'=>$this->semestre,
            'mois'=>$this->mois?$this->mois:'',
            'emploi'=>$this->emploi,
            'filiere'=>$this->filiere,
            'cours'=>new CoursResource($this->cours)
        ];
    }
}
