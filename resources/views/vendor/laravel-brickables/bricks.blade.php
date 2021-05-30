@foreach($model->getBricks($brickableClasses) as $brick)
    {{ $brick }}
@endforeach
