@if($image)
    {{ image()->src($image->getUrl('thumb'))
        ->linkUrl($image->getUrl())
        ->linkTitle($image->file_name)
        ->componentClasses(['rounded-circle']) }}
@endif
