<?php

namespace App\Http\Controllers;

use App\Skills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SkillsEditController extends Controller
{
    //
    public function execute(Skills $skills, Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        |  Здесь обрабатывается запрос типа DELETE
        |--------------------------------------------------------------------------
       */
        if (!$skills) {
            return redirect('admin');
        }

        if ($request->isMethod('delete')) {
            $skills->delete();
            return redirect('admin')->with('status', 'Skill removed');
        }

        /*
        |--------------------------------------------------------------------------
        |  Здесь обрабатывается запрос типа POST
        |--------------------------------------------------------------------------
       */
        if ($request->isMethod('post')) {
            $input = $request->except('_token');
            $validator = Validator::make($input, [
                'name' => 'required|max:255',
                'text' => 'required|max:255'
            ]);

            if ($validator->fails()) {
                return redirect()->route('servicesEdit', ['service' => $input['id']])
                    ->withErrors($validator);
            }

            $skills->fill($input);
            if ($skills->update()) {
                return redirect('admin')->with('status', 'Skill successfully updated');
            }
        }

        /*
        |--------------------------------------------------------------------------
        |  Здесь обрабатывается запрос типа GET
        |--------------------------------------------------------------------------
       */
        $old_data = $skills->toArray();
        if (view()->exists('admin.skills_edit')) {
            $data = [
                'title' => 'Editing page - ' . $old_data['name'],
                'data' => $old_data
            ];
            return view('admin.skills_edit', $data);
        }
        abort(404);
    }
}
