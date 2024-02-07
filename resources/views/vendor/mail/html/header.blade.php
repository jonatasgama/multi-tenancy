@props(['url'])
<tr>
<td class="header">
<a href="http://psicologamonicavieira.com.br" style="display: inline-block;">
@if (trim($slot) === 'Monica Vieira Psicologia')
<img src='{{ env('APP_URL') }}/img/logo.png' class="logo" alt="Monica Vieira">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
