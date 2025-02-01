@include('parts.header')

<div class="filter">
	<form method="get" action="/">
		<label>
			<span class="label">Поиск по названию: </span>
			<input type="text" name="f_name" value="{{ $f_name }}">
		</label>
		<label>
			<span class="label">Поиск по автору: </span>
			<input type="text" name="f_author" value="{{ $f_author }}">
		</label>
		<button>Найти</button>
	</form>
	<form method="get" action="/add/" style="margin-top: 60px;">
		<button>Добавить новую книгу</button>
	</form>
</div>

<div class="books">
	@if ($books)
		<div class="books_pagination">
			{{ $books->links('parts.pagination') }}
		</div>

		@foreach ($books as $book)
			<div class="book">
				<div class="book_cover">
					@if ($book->cover) 
						<img src="{{ route('show_cover',$book->id) }}" alt="-" style="max-width: 150px; max-height: 150px;">
					@else 
						<img src="/images/no_image.png" alt="-" style="max-width: 150px; max-height: 150px;">
					@endif 
				</div>
				<div class="book_descr">
					<span>ИД: <b>{{ $book->id }}</b></span>
					<span>Наименование: <b>{{ $book->name }}</b></span>
					<span>Автор: <b>{{ $book->author }}</b></span>
					<span>Год: <b>{{ $book->y }}</b></span>
					<span>
						<a href="/edit/{{ $book->id }}" class="edit" title="Нажмите, чтобы отредактировать"><i class="fa fa-edit"></i></a>
						<a href="/del/{{ $book->id }}" class="del" title="Нажмите, чтобы удалить"><i class="fa fa-trash"></i></a>
					</span>
				</div>
			</div>
		@endforeach
		
		<div class="books_pagination">
			{{ $books->links('parts.pagination') }}
		</div>
	@else 
		<div class="nothing_found">
			<p>Сожалеем, ничего не найдено =(</p>
		</div>
	@endif 
</div>
	
@include('parts.footer')