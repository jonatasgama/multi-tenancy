@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
<img src="{{ tenant()->logo  }}" class="logo" alt="{{ tenant()->name }}">
</a>
</td>
</tr>
