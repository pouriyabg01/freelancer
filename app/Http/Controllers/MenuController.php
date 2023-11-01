<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function getMenu()
    {
        if ($user = auth()->user()){
            $menu['dashboard'] = 'Dashboard';
            switch ($user->roleIs()) {
                case 'freelancer' :
                    $menu['jobs.favorite'] = 'My Favorites';
                    $menu['jobs.messages'] = 'My Messages';
                break;
                case 'client':
                    $menu['my.jobs'] = 'My Jobs';
                    $menu['jobs.messages'] = 'My Messages';
                    $menu['jobs.create'] = 'Create Job';
                break;
                default :

                break;
            }
            return $menu;
        }
    }
}
