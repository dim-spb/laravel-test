@include('parts.header')

<p class="back_link">
	<a href="/">назад</a>
</p>

<div class="book_edit_form">
	<form method="post" action="/save/@if ($book['id']) {{ $book['id'] }} @else -1 @endif" enctype="multipart/form-data">
		@csrf

		@if (Session::has('posted_fields'))
			@php($posted_fields = Session::get('posted_fields'))
		@endif 

		<label>
			<span class="label">Наименование: </span>
			<input type="text" name="name" value="@isset($posted_fields['name']){{ $posted_fields['name'] }}@else{{ $book['name'] }}@endisset" class="@error('name') error @enderror" required maxlength="255">
		</label>
	
		@error('name')
		    <p class="error">{{ $message }}</p>
		@enderror

		<label>
			<span class="label">Автор: </span>
			<input type="text" name="author" value="@isset($posted_fields['author']){{ $posted_fields['author'] }}@else{{ $book['author'] }}@endisset" class="@error('') error @enderror" required maxlength="255">
		</label>

		@error('author')
		    <p class="error">{{ $message }}</p>
		@enderror

		<label>
			<span class="label">Год: </span>
			<input type="text" name="y" value="@isset($posted_fields['y']){{ $posted_fields['y'] }}@else{{ $book['y'] }}@endisset" class="@error('y') error @enderror" required minlength="4" maxlength="4">
		</label>

		@error('y')
		    <p class="error">{{ $message }}</p>
		@enderror

		<label>
			@if ($book['cover'])
				<img src="{{ route('show_cover',$book['id']) }}" alt="-" style="max-width: 200px; max-height: 200px;">
				<br><br>
			@endif

			<span class="label">Новая обложка: </span>
			<input type="file" name="cover" value="" accept="image/*">
		</label>
		<br><br><br>
		<button>Сохранить</button>
	</form>
</div>
	
@include('parts.footer')