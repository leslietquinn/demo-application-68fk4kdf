	
	<h2>Edit Book</h2>
	<a name="edit_book" id="edit_book"></a>
	<form id="submit_edit_book_form" autocomplete="off" action="" method="post">
		@csrf
		<div class="form-group">
			<input value="{{ $book->id }}" type="hidden" class="book-id" name="id" />
			<div class="my-2">
				<input value="{{ $book->name }}" type="text" class="form-control book-name" name="name" placeholder="Enter the name of a book" />
			</div>
			<div class="my-2">
				<select class="form-control book-category" name="category_id" size="1">
					<option value="0" disabled>Select a Category</option>
					@foreach($categories as $option)
					<option value="{{$option->id}}" @if($option->id == old("category_id", $book->category_id)){{'selected="selected"'}}@endif>{{$option->name}}</option>
					@endforeach
				</select>
			</div>
			<div class="my-2">
				<select class="form-control book-author" name="author_id" size="1">
					<option value="0" disabled>Select an Author</option>
					@foreach($authors as $option)
					<option value="{{$option->id}}" @if($option->id == old("author_id", $book->author_id)){{'selected="selected"'}}@endif>{{$option->name}}</option>
					@endforeach
				</select>
			</div>
			<button id="toggle_book_button" type="submit" class="btn btn-block btn-primary w-100" disabled>Go</button>
		</div>
	</form>
	<a rel="noindex,nofollow" href="/books/#new_book">New Book</a>