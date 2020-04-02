<?php

namespace App\Http\Requests\Department;

class CreateDepartmentRequest extends BaseDepartmentRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            'name'          => 'required',
            'description'   => 'required',
            'employees'     => 'required',
            'city_id'       => 'required',
            ]);
    }
}
