<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{url('../../../imagem/rhwebTop2.png')}}" class="logo" alt="rhweb Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
