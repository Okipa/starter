@php
$base64Logo = null;
$imagePath = settings()->getFirstMediaPath('logo_rounded', 'mail');
if ($imagePath) {
$type = pathinfo($imagePath, PATHINFO_EXTENSION);
$base64Image = base64_encode(file_get_contents($imagePath));
$base64Logo = 'data:image/' . $type . ';base64,' . $base64Image;
}
@endphp
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if ($base64Logo)
<img src="{{ $base64Logo }}" class="logo" alt="{{ config('app.name') }}" style="vertical-align: middle; margin-right: 10px;">
@endif
{{ $slot }}
</a>
</td>
</tr>
