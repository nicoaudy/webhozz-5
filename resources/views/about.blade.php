Hello From about page {{ $name }}

<br></br>

<h1>Nama Buah</h1>
<ul>
	@foreach($buah as $item)
	<li>{{ $item }}</li>
	@endforeach
</ul>

@if($cuaca == 'Hujan')
	Jakarta Hari Ini Hujan 🌧
@elseif($cuaca == 'Tidak Hujan')
	Jakarta Hari Ini Cerah ☀️
@elseif($cuaca == 'Salju')
	❄️
@else
	Jakarta Hari ini Berawan
@endif

<hr>

Nama saya: {{ $name }}
<br>
Umur saya: {{ $age }}
