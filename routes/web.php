<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

//Группа для работы пользовательской части проекта.
//При помощи метода group мы определяем список маршрутов,
//и функцию которая обрабатывает маршруты данной группы.
Route::group(['middleware' => 'web'], function () {

    //Формируем маршрут, для общего макета сайта.
    //Используем метод match() для запросов GET и POST,
    //а также создаем контроллер который будет обрабатывать данный маршрут. Имя роута 'home'.
    Route::match(['get', 'post'], '/', ['uses' => 'IndexController@execute'])->name('home');

    //Этот маршрут нужен для кнопки 'Press here', для перехода на шаблон experience_page. Имя роута 'page'.
    Route::get('/page/{alias}', ['uses' => 'PageController@execute'])->name('page');

});

//Группа маршрутов для закрытой части проекта.
//В данном роуте присутствует префикс шаблона пути
//для данной группы маршрутов префикс - admin.
//Все маршруты закрытой части проекта, обрабатываются посредником auth.
Route::group(['prefix'=>'admin','middleware'=>'auth'], function() {

    //Данный маршрут сработает когда мы будем обращаться к страничке admin.
    Route::get('/',function() {
        //В данном маршруте мы укажем три ссылки на разние страницы.
        if(view()->exists('admin.index')) {
            $data = ['title' => 'Admin panel'];
            return view('admin.index',$data);
        }
    })->name('admin');

    //Группа маршрутов для манипуляции над страницами в табличке pages.
    Route::group(['prefix'=>'pages'],function() {

        //Этот маршрут является главной страничкой раздела pages
        //по управлению контентом в табличке pages, в котрой мы отображаем список страниц.
        Route::get('/',['uses'=>'PagesController@execute','as'=>'pages']);

        //Этот маршрут по добавлению новых элементов в database/landing табличка pages.
        //Данный маршрут при помощи метода GET отображает содержимое, а метод POST сохраняет в database.
        //Example - admin/pages/add.
        Route::match(['get','post'],'/add',['uses'=>'PagesAddController@execute','as'=>'pagesAdd']);
        //Этот маршрут позволяет редактировать страницы. Изменение, удаление контента в табличке pages.
        //При редектировании мы указываем параметр {page} идентификатор страницы которую хотим отредактировать.
        //admin/edit/{параметр}
        Route::match(['get','post','delete'],'/edit/{page}',['uses'=>'PagesEditController@execute','as'=>'pagesEdit']);

    });

    //Группа маршрутов для работы с информацией таблицы portfolio.
    //Данный маршрут нужен для добавления, удаления информации в табличке portfolio.
    Route::group(['prefix'=>'portfolios'],function() {

        Route::get('/',['uses'=>'PortfoliosController@execute','as'=>'portfolio']);

        Route::match(['get','post'],'/add',['uses'=>'PortfoliosAddController@execute','as'=>'portfoliosAdd']);

        Route::match(['get','post','delete'],'/edit/{portfolio}',['uses'=>'PortfoliosEditController@execute','as'=>'portfoliosEdit']);

    });

    //Группа маршрутов для работы с информацией таблицы skills.
    //Данный маршрут нужен для добавления, удаления информации в табличке skills.
    Route::group(['prefix'=>'skills'],function() {

        Route::get('/',['uses'=>'SkillsController@execute','as'=>'skills']);

        Route::match(['get','post'],'/add',['uses'=>'SkillsAddController@execute','as'=>'skillsAdd']);

        Route::match(['get','post','delete'],'/edit/{skills}',['uses'=>'SkillsEditController@execute','as'=>'skillsEdit']);

    });
});

//Маршрут для закрытой части сайта с системой аутентификации.
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
