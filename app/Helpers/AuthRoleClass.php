<?php
namespace App\Helpers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Str;


class AuthRoleClass {

    public static function getAuthRole()
    {
        $user = Auth::user();
        if ($user->isAdmin()) {
            $role = Str::slug('Admin', '-');
        }
  
        elseif ($user->hasRole(Str::slug('User', '-'))) {
            $role = Str::slug('user', '-');
        }
        elseif ($user->hasRole(Str::slug('pharmacist', '-'))) {
            $role = Str::slug('pharmacist', '-');
        }
        elseif ($user->hasRole(Str::slug('assistantpharmacist', '-'))) {
            $role = Str::slug('assistantpharmacist', '-');
        }
        elseif ($user->hasRole(Str::slug('storekeeper', '-'))) {
            $role = Str::slug('storekeeper', '-');
        }
        elseif ($user->hasRole(Str::slug('cashier', '-'))) {
            $role = Str::slug('cashier', '-');
        }
        elseif ($user->hasRole(Str::slug('deliverymen', '-'))) {
            $role = Str::slug('deliverymen', '-');
        }
        return $role;

    }

}

?>
