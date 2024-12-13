<?php

namespace App\Exports;

// use App\Models\Permission;  here need a Spatie permission.... not App\Models\Permission 
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Concerns\FromCollection;

class PermissionExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Permission::select('name','group_name')->get();
    }
}
