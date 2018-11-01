<div class="container portfolio_title">

    <!--Title-->
    <div class="section-title">
        <h2>{{$title}}</h2>
    </div>
    <!--/Title-->

</div>

<!--Header-->
<div class="portfolio">
    <div id="filters" class="sixteen columns">
        <ul style="padding:0px 0px 0px 0px">
            <li><a  href="{{route('pages')}}">
                    <h5>Pages</h5>
                </a>
            </li>
            <li><a  href="{{route('portfolio')}}">
                    <h5>Gallery</h5>
                </a>
            </li>
            <li><a href="{{route('skills')}}">
                    <h5>Skills</h5>
                </a>
            </li>
            <li><a href="{{ route('home') }}">
                    <h5>Back home</h5>
                </a>
            </li>
        </ul>
    </div>
</div>
<!--/Header-->

