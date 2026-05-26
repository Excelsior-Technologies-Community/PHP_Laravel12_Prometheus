<?php

namespace App\Http\Controllers;

use App\Models\UserActivity;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = UserActivity::oldest()->paginate(6);
        return view('activities', compact('activities'));
    }
}