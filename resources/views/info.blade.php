@extends('layout.app')

@section('title-block')Task 1
@endsection

@section('content')
<div class="company-header">Погода и курс валют</div>
<div class="company-text">
	<p><b>Краткое описание:</b> HTML страница отображающая курс валют и погоду в Москве, на текущий момент.</p>
	<p><b>Пример внешнего вида:</b> <a href="https://www.figma.com/file/pdnZndaO3ZlKn3rvBhHFdy/Untitled?node-id=0%3A1">Макет</a></p>
	<p><b>Список валют:</b> Доллар США, Евро, Шведских крон, Японских иен, Канадский доллар</p>
    <p><b>Для получение курса использовать -</b> http://www.cbr.ru/development/sxml/</p>
    <p><b>Для получения погоды можно использовать любое API</b> (Например: https://openweathermap.org/api или https://www.weatherapi.com/ )</p>
    <p>Так же на странице должна присутствовать кнопка, для обновления информации по AJAX</p><br>
    <hr class="hr-horizontal-gradient">
</div>
<!-- <div class="company-text"> -->
    <div class="show_container">
        <div class="weather-control">
        <div class="weather-item">
                <table>
                    <tbody>
                        <tr class="weather_name">
                            <td>Москва</td>
                            <td>{{ $data['weather']['date'] }}</td>
                        </tr>
                        <tr>
                            <td>Температура</td>
                            <td class="weather_temp">{{ $data['weather']['temperature'] }}°</td>
                        </tr>
                        <tr>
                            <td>Ощущается как</td>
                            <td class="weather_apparent">{{ $data['weather']['apparent_temperature'] }}°</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <a href="#" class="btn-update" id="update"></a>
        </div>
        <div class="currency-list">
        @foreach($data['currency'] as $item)
            <div class="currency-item">
                <div class="currency_info">1 {{ $item['charCode'] }} = {{ $item['value'] }} RUB</div>
                <div class="currency_name">{{ $item['name'] }}</div>
            </div>    
        @endforeach
        </div>
    </div>

<script type="module">
    // $('body').html('<h1>jQuery Laravel Vite JS</h1>');
    $(".btn-update").on('click', function(e) {
        e.preventDefault();
        $.ajax({
			url: '/get',
			method: 'get',
			dataType: 'json',
			// data: {id: id},     /* Параметры передаваемые в запросе. */
            success: function(response){
                var data = JSON.parse(JSON.stringify(response));
                console.log(data);
                $(".weather_temp").html(data['weather']['temperature']+'°');
                $(".weather_apparent").html(data['weather']['apparent_temperature']+'°');
                $(".currency-item").each(function (index, element) {
                    $(element).children('.currency_info').html('1 '+data['currency'][index]['charCode'][0]+' = '+data['currency'][index]['value']+' RUB');
                    $(element).children('.currency_name').html(data['currency'][index]['name'][0]);
                });
	        }
		});
	});
</script>
@endsection