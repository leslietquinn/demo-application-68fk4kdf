	@extends("layouts.app")
	@section("head")
	<title>Books</title>
	@endsection

	@section("body")
	<!-- begins: root container -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-4">
				<div class="card p-2 text-center">
					<a rel="index,follow" href="/authors">Authors</a>
				</div>
			</div>

			<div class="col-md-4">
				<div class="card p-2 text-center">
					<a rel="index,follow" href="/books">Books</a>
				</div>
			</div>

			<div class="col-md-4">
				<div class="card p-2 text-center">
					<a rel="index,follow" href="/categories">Categories</a>
				</div>
			</div>
		</div>
		<br>

		<div class="row">
			<div class="col-md-1">
				&nbsp;
			</div>

			<div class="col-md-5">
				<div class="card p-2">
					<h2>Book (Author)</h2>
					@foreach($books as $book)
					<div class="card p-1 my-1">
						<div class="clear-fix p-1">
							<div class="float-start">
								<!-- @note for some reason ellipsis doesn't work inside here -->
								<h2>{{ $book->name }}</h2>
								<h4>{{ $book->author->name }}</h4>
							</div>
							<div class="float-end">
								<a rel="noindex,nofollow" class="btn btn-primary edit_book_clicker" role="button" href="/{{ $book->id }}">Edit</a>&nbsp;<!--
							 --><a rel="noindex,nofollow" class="btn btn-primary delete_book_clicker" role="button" href="/{{ $book->id }}">Delete</a>
							</div>
						</div>
					</div>
					@endforeach
					<hr>
					{!! $books->onEachSide(5)->links() !!}

				</div>
			</div>

			<div class="col-md-5">
				<a name="new_book" id="new_book"></a>
				<div id="book_anchor" class="card p-2">
					<h2>New Book</h2>
					<form id="submit_new_book_form" autocomplete="off" action="" method="post">
						@csrf		
						<div class="form-group">
							<div class="my-2">
								<input value="" type="text" class="form-control book-name" name="name" placeholder="Enter the name of a book" />
							</div>
							<div class="my-2">
								<select class="form-control book-category" name="category_id" size="1">
									<option value="0" selected="selected" disabled>Select a Category</option>
									@foreach($categories as $option)
									<option value="{{$option->id}}" @if($option->id == old("category")){{'selected="selected"'}}@endif>{{$option->name}}</option>
									@endforeach
								</select>
							</div>
							<div class="my-2">
								<select class="form-control book-author" name="author_id" size="1">
									<option value="0" selected="selected" disabled>Select an Author</option>
									@foreach($authors as $option)
									<option value="{{$option->id}}" @if($option->id == old("author")){{'selected="selected"'}}@endif>{{$option->name}}</option>
									@endforeach
								</select>
							</div>
							<button id="toggle_book_button" type="submit" class="btn btn-block btn-primary w-100" disabled>Go</button>
						</div>
					</form>
				</div>
			</div>

			<div class="col-md-1">
				&nbsp;
			</div>
		</div>
	</div>
	<div class="clear-fix"></div>
	<!-- ends: root container -->
	@endsection
	@section("scripts")
	<script>

			$(document).on("click", ".delete_book_clicker", function(e) 
			{
				e.preventDefault();
				var params = $(this).attr("href").split("/")[1]; 

				$.ajax({
					type: "POST"
	              , url: "/books/delete/" + params
				  , headers: {
						"X-HTTP-Method-Override": "DELETE" // POST, GET, PUT, DELETE
					  , "X-CSRF-TOKEN": jQuery('meta[name="csrf"]').attr("content")
					}
				  , data: null
				  , cache: false
				  , dataType: "json"
				  , contentType: "text/plain"
				  	// , contentType: "application/x-www-form-urlencoded"
				  	// , contentType: "application/json; charset=UTF-8"
				  , success: function(rs, status, xhr) 
				  	{
				  		$("#popup")
							.addClass("bg-success")
							.removeClass("bg-danger")
							.html(JSON.parse(xhr.responseText).message)
							.show()
							.delay(3000)
							.fadeOut("slow");

						sleep(1500).then(() => 
						{
							window.location.replace('/books');
						});
				  	}
				  , error: function(xhr, status, error) 
				  	{
				  		$("#popup")
							.addClass("bg-danger")
							.removeClass("bg-success")
							.html(JSON.parse(xhr.responseText).message)
							.show()
							.delay(3000)
							.fadeOut("slow");
				  	}
				});
			});

	</script>
	@endsection