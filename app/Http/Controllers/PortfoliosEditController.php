<?php

namespace App\Http\Controllers;

use App\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PortfoliosEditController extends Controller
{
    public function execute(Portfolio $portfolio, Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        |  Здесь обрабатывается запрос типа DELETE
        |--------------------------------------------------------------------------
       */
        if (!$portfolio) {
            return redirect('admin');
        }
        if ($request->isMethod('delete')) {
            $portfolio->delete();
            return redirect('admin')->with('status', 'Portfolio deleted');
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
                'filter' => 'required|max:255'
            ]);

            if ($validator->fails()) {
                return redirect()->route('portfoliosEdit', ['portfolio' => $input['id']])
                    ->withErrors($validator);
            }

            if ($request->hasFile('images')) {
                $file = $request->file('images');
                $request->file('images')->move(public_path() . '/assets/img', $file->getClientOriginalName());
                $input['images'] = $file->getClientOriginalName();
            } else {
                $input['images'] = $input['old_images'];
            }

            unset($input['old_images']);

            $portfolio->fill($input);
            if ($portfolio->update()) {
                return redirect('admin')->with('status', 'Page updated');
            }
        }

        /*
        |--------------------------------------------------------------------------
        |  Здесь обрабатывается запрос типа GET
        |--------------------------------------------------------------------------
       */
        $old_date = $portfolio->toArray();

        if (view()->exists('admin.portfolios_edit')) {
            $data = [
                'title' => 'Editing page - ' . $old_date['name'],
                'data' => $old_date
            ];
            return view('admin.portfolios_edit', $data);
        }
    }
}
