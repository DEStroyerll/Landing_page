<?php

namespace App\Http\Controllers;

use App\Portfolio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PortfoliosAddController extends Controller
{
    //
    public function execute(Request $request)
    {
        if ($request->isMethod('post')) {
            $input = $request->except('_token');
            $validator = Validator::make($input, [
                'name' => 'required|max:255',
                'filter' => 'required|unique:portfolios|max:255'
            ]);

            if ($validator->fails()) {
                return redirect()->route('portfoliosAdd')
                    ->withErrors($validator)
                    ->withInput();
            }

            $file = $request->file('images');
            $request->file('images')->move(public_path() . '/assets/img', $file->getClientOriginalName());
            $input['images'] = $file->getClientOriginalName();

            $portfolio = new Portfolio();
            $portfolio->fill($input);
            if ($portfolio->save()) {
                return redirect('admin')->with('status', 'Page added');
            }
        }

        if (view()->exists('admin.portfolios_add')) {
            $data = [
                'title' => 'New page'
            ];
            return view('admin.portfolios_add', $data);
        }
    }
}
