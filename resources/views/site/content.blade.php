<!--В этом макете будет отображаться контент Landing pag-->

<!--Проверяем существование переменной $pages-->
@if(isset($pages) && is_object($pages))

    <!--В переменную $key будет попадать ключ коллекции $pages,
     а в переменную $page попадет значение коллекции из database-->
    @foreach($pages as $key => $page)
        <!--Тут проверяем четная секция или нечетная-->
        @if($key % 2 == 0)
            <!--Home_Section-->
            <section id="{{ $page->alias }}" class="top_cont_outer">
                <div class="hero_wrapper">
                    <div class="container">
                        <div class="hero_section">
                            <div class="row">
                                <div class="col-lg-5 col-sm-7">
                                    <div class="top_left_cont zoomIn wow animated">
                                        <!--Выводим содержимое которое находится в database с экранированием html тегов '!!'-->
                                    {!! $page->text !!}
                                    </div>
                                </div>
                                <div class="col-lg-7 col-sm-5">
                                <!--Здесь мы используем библиотеку FONTS&HTML которая выбирает нужную картинку из database-->
                                    {{--{!! Html::image('assets/img/'.$page->images) !!}--}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/Home_Section-->
        @else
            <!--About me-->
            <section id="{{ $page->alias }}">
                <div class="inner_wrapper">
                    <div class="container">
                        <!--При помощи модели $page мы получаем заголовок из database-->
                        <h2>{{ $page->name }}</h2>
                        <div class="inner_section">
                            <div class="row">
                                <div class=" col-lg-5 col-md-5 col-sm-5 col-xs-12 pull-right">
                                    <!--Здесь мы используем библиотеку FONTS&HTML которая выбирает нужную картинку из database-->
                                    {!! Html::image('assets/img/'.$page->images, '',
                                    array('class'=>'img-circle delay-03s animated wow zoomIn')) !!}</div>
                                <div class=" col-lg-7 col-md-7 col-sm-7 col-xs-12 pull-left">
                                    <div class=" delay-01s animated fadeInDown wow animated">
                                        {!! $page->text !!}
                                    </div>
                                    <div class="work_bottom"><span>Want to know more...</span>
                                        <!--Изпользуя функцию хелпер route прикручиваем кнопку которая переходит на страничку Experience Page-->
                                        <a href="{{ route('page', array('alias'=>$page->alias)) }}" class="contact_btn">Press here</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--/About me-->
        @endif
    @endforeach
@endif

<!--Проверяем существование переменной $skills-->
@if(isset($skills) && is_object($skills))
    <!--Skills-->
    <section id="skills">
        <div class="container">
            <h2>Skills</h2>

            <!--В этом блоке формируются ряды сервиса-->
            <div class="skills_wrapper">

                <!--В переменную $skill попадает объект модели конкретной выбраной записи из таблички skills-->
            @foreach($skills as $key => $skill)
                <!--Логика которая формирует ряды-->
                @if($key == 0 || $key % 3 == 0)
                    <!--Здесь мы формируем рамку-->
                        <div class="row {{ ($key != 0 ) ? 'borderTop' : '' }} ">
                            @endif
                            <div class="col-lg-4 {{ ($key % 3 > 0) ? 'borderLeft' : '' }} {{ ($key > 2) ? 'mrgTop' : '' }}">
                                <div class="skills_block">
                                    <div class="skills_icon delay-03s animated wow zoomIn"><span><i class="fa {{ $skill->icon }}"></i></span></div>
                                    <!--Обращаясь к модели $skill мы выбираем заголовок и текст из таблички skills-->
                                    <h3 class="animated fadeInUp wow">{{ $skill->name }}</h3>
                                    <p class="animated fadeInDown wow">{{ $skill->text }}</p>
                                </div>
                            </div>

                            @if(($key + 1) % 3 == 0)
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </section>
    <!--/Skills-->
@endif

<!--Проверяем существование переменной $portfolios-->
@if(isset($portfolios) && is_object($portfolios))
    <!-- Portfolio -->
    <section id="Portfolio" class="content">

        <!-- Container -->
        <div class="container portfolio_title">

            <!-- Title -->
            <div class="section-title">
                <h2>Gallery</h2>
            </div>
            <!--/Title -->
        </div>
        <div align="middle">
            <h5>Beautiful places in Europe where I would like to go</h5>
        </div>

        <!-- /Container -->
        <div class="portfolio-top"></div>

        <!-- Portfolio Filters -->
        <div class="portfolio">
            <!--Проверяем существование переменной $filters-->
            @if(isset($filters) && is_object($filters))
                <div id="filters" class="sixteen columns">
                    <ul class="clearfix">
                        <li><a id="all" href="#" data-filter="*" class="active">
                                <h5>All</h5>
                                @foreach($filters as $filter)
                            <!--Здесь мы отображаем имя и заголовок конкретного фильтра-->
                            <li><a class="" href="#" data-filter=".{{ $filter }}">
                                    <h5>{{ $filter }}</h5>
                                </a></li>
                                @endforeach
                    </ul>
                </div>
                <!--/Portfolio Filters -->
            @endif

            <!-- Portfolio Wrapper -->
            <div class="isotope fadeInLeft animated wow" style="position: relative; overflow: hidden; height: 480px;" id="portfolio_wrapper">
                @foreach($portfolios as $item)
                    <!-- Portfolio Item -->
                        <div style="position: absolute; left: 0px; top: 0px; transform: translate3d(0px, 0px, 0px) scale3d(1, 1, 1); width: 337px; opacity: 1;"class="portfolio-item one-four {{ $item->filter }} isotope-item">
                            <!--Здесь мы отображаем картинки взятые из database для конкретного фильтра-->
                            <div class="portfolio_img">{{ Html::image('assets/img/'.$item->images, $item->name) }}</div>
                            <div class="item_overlay">
                                <div class="item_info">
                                    <!--Здесь мы отображаем имя картинки взятое из database-->
                                    <h4 class="project_name">{{ $item->name }}</h4>
                                </div>
                            </div>
                        </div>
                        <!--/Portfolio Item -->
                @endforeach
            </div>
            <!--/Portfolio Wrapper -->
        </div>

        <!--/Portfolio Filters -->
        <div class=portfolio_btm"></div>
        <div id="project_container">
            <div class="clear"></div>
            <div id="project_data"></div>
        </div>
    </section>
    <!--/Portfolio -->
@endif

<!--Проверяем существование переменной $peoples-->
@if(isset($peoples) && is_object($peoples))
    <!--Team-->
    <section class="page_section team" id="team"><!--main-section team-start-->
        <div class="container">
            <h2>Education</h2>
            <div class="team_section clearfix">

                <!--На каждой итерации цикла в переменную $people попадет модель сотрудника-->
                @foreach($peoples as $key => $people)
                    <div class="team_area">
                                                  <!--Динамическая загрузка сотрудников-->
                        <div class="team_box wow fadeInDown delay-0{{ ($key * 3 + 3) }}s">
                            <div class="team_box_shadow"><a href="javascript:void(0)"></a></div>
                            <!--Используя фасад HTML мы выбираем нужную нам картинку из database-->
                            {{ Html::image('assets/img/'.$people->images, $people->name) }}
                            <ul>
                                <li><a href="javascript:void(0)" class="fa fa-twitter"></a></li>
                                <li><a href="javascript:void(0)" class="fa fa-facebook"></a></li>
                            </ul>
                        </div>
                        <h3 class="wow fadeInDown delay-0{{ ($key * 3 + 3) }}s">{{ $people->name }}</h3>
                        <span class="wow fadeInDown delay-0{{ ($key * 3 + 3) }}s">{{ $people->position }}</span>
                        <p class="wow fadeInDown delay-0{{ ($key * 3 + 3) }}s">{{ $people->text }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!--/Team-->
@endif

<!--Footer and form-->
<footer class="footer_wrapper" id="contact">
    <div class="container">
        <section class="page_section contact" id="contact">
            <div class="contact_section">
                <h2>Write me</h2>
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 wow fadeInLeft">
                    <div class="contact_info">
                        <div class="detail">
                            <h4>Call me:</h4>
                            <p>+38 (099) 184-49-22</p>
                        </div>
                    </div>
                    <ul class="social_links">
                        <h4>Links to my social networks:</h4>
                        <li class="linkedin animated bounceIn wow delay-02s"><a href="https://www.linkedin.com/in/denis-gurov-0219a3163/"><i class="fa fa-linkedin"></i></a></li>
                        <li class="github animated bounceIn wow delay-03s"><a href="https://github.com/DEStroyerll"><i class="fa fa-github"></i></a></li>
                        <li class="facebook animated bounceIn wow delay-05s"><a href="https://www.facebook.com/DEStroyerll"><i class="fa fa-facebook"></i></a></li>
                    </ul>
                </div>
                <div class="col-lg-8 wow fadeInLeft delay-06s">
                    <div class="form">
                        <form action="{{ url('/') }}" method="post">
                            <div class="control-group">
                                <div class="controls">
                                    <input name="name" type="text" id="name" class="form-control input-text" placeholder="Enter your name *"/>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <input name="email" type="email" id="email" class="form-control input-text" placeholder="Enter your email *"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
		                <textarea name="text" rows="10" cols="100" id="text" class="form-control input-text" placeholder="Write your message *"
                              minlength="5" data-validation-minlength-message="Minimum text length 5 characters"
                              maxlength="1000" style="resize:none"></textarea>
                                </div>
                            </div>
                            <div id="success"></div> <!-- For success/fail messages -->
                            <button type="submit" class="btn btn-primary input-btn pull-right">Send message</button>
                            <br/>
                            <!--csrf_field() функция которая возвращает случайный сгенерированный токен-ключ-->
                            {{ csrf_field() }}
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="container">
        <div class="footer_bottom"><span>Copyright Denis Gurov © 31 October 2018, Template by <a href="http://webthemez.com">WebThemez.com</a></span></div>
    </div>
</footer>
<!--/Footer and form-->