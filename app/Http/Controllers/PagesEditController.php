<?php

namespace App\Http\Controllers;

use App\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PagesEditController extends Controller
{
    //Используя внедрение зависимости мы обращаемся к модели Page
    //и щем нужную нам страничку при помощи переменной идентификатора $id_page.
    public function execute(Page $page, Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        |  Здесь обрабатывается запрос типа DELETE
        |--------------------------------------------------------------------------
       */
        if ($request->isMethod('delete')) {
            //Удаляем выбраную модель.
            $page->delete();
            return redirect('admin')->with('status', 'Page successfully deleted.');
        }

        /*
        |--------------------------------------------------------------------------
        |  Здесь обрабатывается запрос типа POST
        |--------------------------------------------------------------------------
       */
        if ($request->isMethod('post')) {

            //Используя метод except мы выбираем данные которые хранятся в объекте $request.
            $input = $request->except('_token');

            //Создаем объект класса Validator для проверки введенных данных.
            $validator = Validator::make($input, [

                //Валидируем заполненые поля.
                'name' => 'required|max:255',
                'alias' => 'required|max:255|unique:pages',
                'text' => 'required'
            ]);

            //Метод fails вернет true если одно из полей не прошло валидацию.
            if ($validator->fails()) {
                return redirect()
                    ->route('pagesEdit', ['page' => $input['id']])
                    ->withErrors($validator);
            }

            //Здесь мы проверим загружается ли файл при отправке формы на сервер.
            if ($request->hasFile('images')) {
                //В переменную $file сохраним объект UpLoadedFile.
                $file = $request->file('images');
                //Перемещаем загруженный файл в нужную нам директорию указывая оригинальное имя.
                $file->move(public_path() . '/assets/img', $file->getClientOriginalName());
                //В ячейку 'images' записываем имя файла.
                $input['images'] = $file->getClientOriginalName();
            } else {
                //Иначе оставляем старую картинку.
                $input['images'] = $input['old_images'];
            }

            unset($input['old_images']);

            //Заполняем модель новыми значениями.
            $page->fill($input);
            //Обновляем модель.
            if ($page->update()) {
                return redirect('admin')
                    ->with('status', 'Page updated');
            }
        }

        /*
        |--------------------------------------------------------------------------
        |  Здесь обрабатывается запрос типа GET
        |--------------------------------------------------------------------------
       */
        //Используя метод find мы ищем нужную нам модель-страничку.
//        $old_date = Page::find($id_page);
        $old_date = $page->toArray();

        //Затем проверяем существование макета для редактирования.
        if (view()->exists('admin.pages_edit')) {
            //Формируем массив для странички редактирования.
            $data = [
                'title' => 'Editing page - ' . $old_date['name'],
                'data' => $old_date
            ];
            return view('admin.pages_edit', $data);
        }

    }
}
