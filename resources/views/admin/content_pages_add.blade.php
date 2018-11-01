<!--Данный макет будет отображать форму добавления нового материала в database-->
<div class="wrapper container-fluid">

{!! Form::open(['url' => route('pagesAdd'),'class'=>'form-horizontal','method'=>'POST','enctype'=>'multipart/form-data']) !!}

    <!--В данном блоке будет отображаться конкретный элемент-строка формы-->
    <div class="form-group">
        {!! Form::label('name','Title:',['class' => 'col-xs-2 control-label'])   !!}
        <div class="col-xs-8">
            {!! Form::text('name',old('name'),['class' => 'form-control','placeholder'=>'Enter the page name'])!!}
        </div>
    </div>

    <!--Форма для создания псевдонима-->
    <div class="form-group">
        {!! Form::label('alias', 'Alias:',['class'=>'col-xs-2 control-label']) !!}
        <div class="col-xs-8">
            {!! Form::text('alias', old('alias'), ['class' => 'form-control','placeholder'=>'Enter page alias']) !!}
        </div>
    </div>

    <!--Форма для создания текста-->
    <div class="form-group">
        {!! Form::label('text', 'Text:',['class'=>'col-xs-2 control-label']) !!}
        <div class="col-xs-8">
            {!! Form::textarea('text', old('text'), ['id'=>'editor','class' => 'form-control','placeholder'=>'Enter text page']) !!}
        </div>
    </div>

    <!--Форма для добавления изображения-->
    <div class="form-group">
        {!! Form::label('images', 'Image:',['class'=>'col-xs-2 control-label']) !!}
        <div class="col-xs-8">
            {!! Form::file('images', ['class' => 'filestyle','data-buttonText'=>'Select image','data-buttonName'=>"btn-primary",'data-placeholder'=>"No file"]) !!}
        </div>
    </div>

    <!--Кнопка сохранить изменения-->
    <div class="form-group">
        <div class="col-xs-offset-2 col-xs-10">
            {!! Form::button('Save', ['class' => 'btn btn-primary','type'=>'submit']) !!}
        </div>
    </div>

    {!! Form::close() !!}

    <!--Здесь мы подключили библиотеку CKEDITOR-->
    <script>
        CKEDITOR.replace('editor');
    </script>
</div>