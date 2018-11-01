<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PagesAddController extends Controller
{
    public function execute(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        |  Здесь обрабатывается запрос типа POST
        |--------------------------------------------------------------------------
       */
        if ($request->isMethod('post')) {

            //Выбираем все интересующие нас поля за исключением token.
            $input = $request->except('_token');

            //Валидируем данные которые пользователь заполнит в форме.
            $validator = Validator::make($input, [

                //Валидируем заполненые поля.
                'name' => 'required|max:255',
                'alias' => 'required|unique:pages|max:255',
                'text' => 'required'
            ]);

            //Метод fails вернет true если одно из полей не прошло валидацию.
            //Затем осуществляем redirect на страничку заполнения формы.
            if ($validator->fails()) {
                return redirect()
                    ->route('pagesAdd')
                    ->withErrors($validator)
                    ->withInput();
            }

            //Метод hasFile проверяет наличие загруженного файла.
            if ($request->hasFile('images')) {
                //Для работы с картинками мы используем функцию file.
                $file = $request->file('images');

                //Здесь мы сохраняем оригинальное имя загруженной картинки.
                $input['images'] = $file->getClientOriginalName();

                //Здесь мы используя функцию-хелпер сохраняем картинку в определенную директорию,
                //указывая оригинальное имя картинки.
                $file->move(public_path() . '/assets/img', $input['images']);
            }

            //Здесь мы сохраняем информацию в database.
            $page = new Page();
            //Используя метод fill заполняем поля в данной табличке.
            $page->fill($input);

            if ($page->save()) {
                return redirect('admin')
                    ->with('status', 'Page successfully added to the database!');
            }
        }

        /*
        |--------------------------------------------------------------------------
        |  Здесь обрабатывается запрос типа GET
        |--------------------------------------------------------------------------
       */
        if (view()->exists('admin.pages_add')) {
            $data = [
                'title' => 'New page'
            ];
            return view('admin.pages_add', $data);
        }
        abort(404);
    }
}
