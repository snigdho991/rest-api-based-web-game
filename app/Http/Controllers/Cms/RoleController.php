<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function generate_role()
    {
    	// $role = Role::create(['name' => 'Administrator']);
    	// $role = Role::create(['name' => 'Local Administrator']);
    	// $role = Role::create(['name' => 'User']);
    	return true;
    }
}
