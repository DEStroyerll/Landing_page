<!--Данный макет должен отобразить список существующих страниц проекта-->
<div style="margin:0px 50px 0px 50px;">

    <!--Здесь мы проверяем содержимое переменной $pages-->
    @if($pages)
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>№</th>
                <th>Name</th>
                <th>Alias</th>
                <th>Text</th>
                <th>Date of creation</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <!--Здесь мы отображаем содержимое таблички pages из database landing-->
            @foreach($pages as $key => $page)
                <tr>
                    <td>{{ $page->id }}</td>
                    <!--Указываем ссылку на маршрут 'pagesEdit' для изменения контента-->
                    <td>{!! Html::link(route('pagesEdit', ['page'=>$page->id]), $page->name, ['alt'=>$page->name]) !!}</td>
                    <!--Указываем псевдоним конкретной страницы-->
                    <td>{{ $page->alias }}</td>
                    <!--Указываем текст конкретной страницы-->
                    <td>{{ $page->text }}</td>
                    <!--Указываем дату создания конкретной записи-->
                    <td>{{ $page->created_at }}</td>

                    <td>
                        <!--Обращаясь к фасаду Form мы вызываем метод open() который создает форму,
                        в которой мы будем отправлять запросы на сервер типа delete-->
                        {!! Form::open(['url' => route('pagesEdit', ['page'=>$page->id]), 'class'=>'form-horizontal', 'method'=>'POST']) !!}
                        <!--Функция method_field генерирует скрытое поле ввода HTML-->
                        {{ method_field('DELETE') }}
                        {!! Form::button('Delete', ['class'=>'btn btn-danger', 'type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
    <!--Здесь мы создаем ссылку на маршрут который создает новую страничку-->
    {!! Html::link(route('pagesAdd'), 'Create new page') !!}
</div>


