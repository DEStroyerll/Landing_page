<div style="margin:0px 50px 0px 50px;">
    @if($skills)
        <table class="table table-hover table-striped">
            <thead>
            <tr>
                <th>№</th>
                <th>Name</th>
                <th>Text</th>
                {{--<th>Icon</th>--}}
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($skills as $key => $skill)
                <tr>
                    <td>{{$skill->id}}</td>
                    <td>  {!! Html::link(route('skillsEdit',['skills'=>$skill->id]),$skill->name,['alt'=>$skill->name]) !!}  </td>
                    <td>{{$skill->text}}</td>
                    {{--<td>{!! Html::image('assets/css/font-awesome.css/'.$skill->icon,'', array('style' => 'width:150px' )) !!}</td>--}}
                    <td>
                        {!! Form::open(['url' => route('skillsEdit',['skills'=>$skill->id]),'class'=>'form-horizontal','method'=>'POST']) !!}
                        {{ method_field('DELETE') }}
                        {!! Form::button('Delete', ['class' => 'btn btn-danger','type'=>'submit']) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @endif
    {{--{!! Html::link(route('skillsAdd'),'New skills') !!}--}}
</div>