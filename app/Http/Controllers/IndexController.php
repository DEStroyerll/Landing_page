<?php

namespace App\Http\Controllers;

use App\Page;
use App\People;
use App\Portfolio;
use App\Skills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

/**
 * Class IndexController
 * @package App\Http\Controllers
 * Контролер который обрабатывает вид общего шаблона сайта
 */
class IndexController extends Controller
{

    public function execute(Request $request)
    {
        //Создаем собственные сообщения для пользователя.
        $message = [
            'required' => "Поле :attribute обязательное к заполнению",
            'email' => "Поле :attribute должно соответствовать email адресу"
        ];

        //isMethod проверяет какой тип запроса использует пользователь.
        if ($request->isMethod('post')) {
            //Обращаясь к объекту класса IndexController мы вызываем метод validate.
            $this->validate($request, [
                //Поля required обязательные к заполнению.
                'name' => 'required|max:255',
                'email' => 'required|email',
                'text' => 'required'
            ], $message);
            //Сохраняем в переменную $data данные отправленные пользователем.
            $data = $request->all();

            //Используя фасад Mail мы отправляем сообщение на определенный почтовый ящик.
            //В методе send() первым параметром мы используем шаблон письма,
            //вторым параметром мы используем массив с данными который заполнил пользователь.
            $send_message = Mail::send('site.email', ['data' => $data], function ($message) use ($data) {

                //Для получения доступа к переменным которые хранятся в файле .env
                //мы используем одноименную функцию-хелпер env().
                $mail_admin = env('MAIL_ADMIN');

                //Здесь мы определяем от кого отправляем письмо.
                $message->from($data['email'], $data['name']);
                //Здесь мы определяем кому отправляем письмо и задаем тему.
                $message->to($mail_admin, 'Admin')->subject('I wrote a letter.');

            });
            //Здесь мы после отправки сообщения возвращаем пользователя на страничку 'home'.
            if ($send_message) {
                return redirect()
                    ->route('home')
                    ->with('status', 'Message sent successfully!');
            }
        }

        //Переменная для отображения информации меню в блоке header.
        $menu = array();

        //Используя конструткор запросов DB в переменную $filters
        //мы записываем информацию о фильтрах для секции Portfolio.
        $filters = DB::table('portfolios')
            ->distinct()
            ->pluck('filter');

        //Переменные для работы с моделями.
        $pages = Page::all();
        $portfolios = Portfolio::all();
        $skills = Skills::all();
        $peoples = People::all();

        //В цикле foreach мы проходим по всем страницам сайта.
        foreach ($pages as $page) {
            //В переменную $item мы присваиваем отдельный конкретный пункт меню.
            $item = array('title' => $page->name, 'alias' => $page->alias);
            //array_push — Добавляет один или несколько элементов в конец массива.
            array_push($menu, $item);
        }

        //Формируем массив $menu, который будет сожержать информацию о верхнем меню сайта.
        $item = array('title' => 'Skills', 'alias' => 'skills');
        array_push($menu, $item);

        $item = array('title' => 'Portfolio', 'alias' => 'Portfolio');
        array_push($menu, $item);

        $item = array('title' => 'Education', 'alias' => 'team');
        array_push($menu, $item);

        //Секция которая отправляет сообщение админу данного проекта.
        $item = array('title' => 'Contact', 'alias' => 'contact');
        array_push($menu, $item);

        //Вид который мы используем для отображения информации на экран.
        return view('site.index', array(
            //В макеты мы присвоили переменные модели.
            'menu' => $menu,
            'pages' => $pages,
            'skills' => $skills,
            'portfolios' => $portfolios,
            'peoples' => $peoples,
            'filters' => $filters
        ));
    }
}
