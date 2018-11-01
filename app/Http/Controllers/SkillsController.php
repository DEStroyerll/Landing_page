<?php

namespace App\Http\Controllers;

use App\Skills;
use Illuminate\Http\Request;

class SkillsController extends Controller
{
    public function execute()
    {
        if (view()->exists('admin.skills')) {
            $skills = Skills::all();
            $data = [
                'title' => 'Admin panel',
                'skills' => $skills
            ];
        return view('admin.skills', $data);
        }
    abort(404);
    }
}
