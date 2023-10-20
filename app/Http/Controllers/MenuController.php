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
                    $menu['jobs.favorite'] = 'My Favorites';
                break;
                case 'client':
                    $menu['my.jobs'] = 'My Jobs';
                    $menu['jobs.create'] = 'Create Job';
                break;
                default :

                break;
            }
            return $menu;
        }
    }
}
