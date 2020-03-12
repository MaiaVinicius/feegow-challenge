<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Schedule extends Model
{
    protected $table = 'schedules';

    protected $fillable = ["specialty_id", "professional_id", "name","cpf","source_id","birth_date"];


    public function validateAndSave(Request $request)
    {
        $request->validate([
            'specialty_id' => 'required|integer',
            'professional_id' => 'required|integer',
            'name' => 'required|string',
            'cpf' => 'required|string',
            'source_id' => 'required',
            'birth_date' => 'required|date',
        ]);

        $this->fill([
            "specialty_id" => $request->specialty_id,
            "professional_id" => $request->professional_id,
            "name" => $request->name,
            "cpf" => $request->cpf,
            "source_id" => $request->source_id,
            "birth_date" => $request->birth_date
        ]);
        return $this->save();
    }

}
