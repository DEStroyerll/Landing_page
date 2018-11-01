<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    //В функцию execute мы передаем параметр-псевдоним интересующего нас материала.
    public function execute($alias)
    {
        //Если перехода на страничку не было, срабатывает функция хелпер abort
        //которая останавливает работу данного контроллера.
        if (!$alias) {
            abort(404);
        }

        //Здесь мы проверяем существование шаблона на который осуществляется переход.
        if (view()->exists('site.page')) {

            //В переменную page мы присвоили значение которое взяли из database
            //где поле 'alias' равно значению в переменной $alias.
            $page = Page::where('alias', strip_tags($alias))->first();

            $data = [
                'title' => $page->name,
                'page' => $page
            ];
            return view('site.page', $data);
        }
        else {
            abort(404);
        }
    }
}
