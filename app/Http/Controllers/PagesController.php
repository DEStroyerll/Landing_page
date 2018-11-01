<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    //Задача данного контроллера отобразить список страниц
    //добавленных в проект.
    public function execute()
    {
        //Проверяем наличие данного вида.
        if (view()->exists('admin.pages')) {
            //Отображаем данные из таблички pages.
            $pages = Page::all();

            $data = [
                'title' => 'Admin panel',
                'pages' => $pages
            ];

        return view('admin.pages', $data);
        }

    abort(404);
    }
}
