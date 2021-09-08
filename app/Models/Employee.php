<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function employeeLeaves()
    {
        return $this->hasMany(EmployeeLeave::class);
    }
}
