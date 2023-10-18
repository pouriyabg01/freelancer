<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function getUserMenu()
    {
        if ($user = auth()->user()){
            $menu['dashboard'] = 'Dashboard';
            switch ($user->roleIs()) {
                case 'freelancer' :
                    $menu['profile/jobs/favorites'] = 'My Favorites';
                break;
                case 'client':
                    $menu['myjobs'] = 'My Jobs';
                    $menu['profile/jobs/create'] = 'Create Job';
                break;
                default :

                break;
            }
            return $menu;
        }
    }
}
