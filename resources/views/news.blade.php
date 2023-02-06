@extends('layout.app')

@section('title-block')Task 2
@endsection

@section('content')
<div class="company-header">Новости</div>
<div class="company-text">
	<p><b>Описание:</b> Написать простое приложение MVC «Новости». Результатом задания должны быть три файла: Model – News.php, Controller – NewsController.php и View – NewsTemplate.php</p>
    <hr class="hr-horizontal-gradient">
</div>
<a href="" class="create">Создать</a>
<div class="company-text">
    <div class="news-list">    
    @foreach($data['news'] as $item)
    
        @if($data['detail'] == 1)
        <div class="news-item" id="{{ $item['id'] }}">
            <a href="?id={{ $item['id'] }}"><h3>{{ $item['title'] }}</h3></a>
            <p>{{ $item['tags'] }}</p>
            <div class="announcement">
                {{ $item['text'] }}
            </div>
            <p>{{ $item['date'] }}</p>
            <br>
            <a href="/news" class="">← Назад</a>
        </div>
        @else
        <div class="news-item" id="{{ $item['id'] }}">
            <a href="?id={{ $item['id'] }}"><h3>{{ $item['title'] }}</h3></a>
            <div class="announcement">
                {{ $item['announcement'] }}
            </div>
            <p>{{ $item['tags'] }}</p>
            <a href="#" class="delete">Удалить</a>
        </div>
    @endif
    @endforeach

    </div>
</div>


<script type="module">
    $(".create").on('click', function(e){
        e.preventDefault();
		var item  = $(this).parent()
		var id = item.attr('id');

		console.log(id);
		$.ajax({
			url: '/api/create',
			method: 'post',
			dataType: 'json',
			data: {
                "title": "What is hidden in the maze"+getRandomInt(100),
                "announcement": "Lorem ipsum dolor",
                "text": "Lorem ipsum dolor sit amet consectetur adipisicing elit. Facilis adipisci, odit dolorem quas, cum inventore est dolorum praesentium itaque repellat aperiam,",
                "tags": "technology, science",
                "date": "2022-02-04 20:54:22"
            },     /* Параметры передаваемые в запросе. */
			success: function(response){
			var a = JSON.parse(JSON.stringify(response));
				console.log(a);
                $('.news-list').prepend(
                    '<div class="news-item" id="'+a.id+'"><a href=""><h3>'+a.title+
                    '</h3></a><div class="announcement">'
                +a.announcement+'</div><p>'+a.tags+'</p><a href="#" class="delete">Удалить</a></div>'
                );
			}
		});
	});

    function getRandomInt(max) {
        return Math.floor(Math.random() * max);
    }
    

    $(".delete").on('click', function(e){
        e.preventDefault();
		var item  = $(this).parent()
		var id = item.attr('id');
		console.log(id);
		$.ajax({
			url: '/api/delete?id='+id,
			method: 'delete',
			dataType: 'json',
			success: function(response){
			var a = JSON.parse(JSON.stringify(response));
				console.log(a);
                item.remove();
			}
		});
	});
</script>

@endsection