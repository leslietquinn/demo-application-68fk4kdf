	@extends("layouts.app")
	@section("head")
	<title>Authors</title>
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
					<h2>Author (# Books)</h2>
					@foreach($authors as $author)
					<div class="card p-1 my-1">
						<div class="clear-fix p-1">
							<div class="float-start">
								<h2>{{ $author->name }}</h2>
								<h4>{{ $author->books_count }}</h4>
							</div>
							<div class="float-end">
								<a rel="noindex,nofollow" class="btn btn-primary edit_author_clicker" role="button" href="/{{ $author->id }}">Edit</a>&nbsp;<!--
							 --><a rel="noindex,nofollow" class="btn btn-primary delete_author_clicker" role="button" href="/{{ $author->id }}">Delete</a>
							</div>
						</div>
					</div>
					@endforeach
					<hr>
					{!! $authors->onEachSide(5)->links() !!}

				</div>
			</div>

			<div class="col-md-5">
				<a name="new_author" id="new_author"></a>
				<div id="author_anchor" class="card p-2">
					<h2>New Author</h2>
					<form id="submit_new_author_form" autocomplete="off" action="" method="post">
						@csrf		
						<div class="form-group">
							<input value="" type="text" class="form-control my-2 author-name" name="name" placeholder="Enter the name of an author" />
							<button id="toggle_author_button" type="submit" class="btn btn-block btn-primary w-100" disabled>Go</button>
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

			$(document).on("click", ".delete_author_clicker", function(e) 
			{
				e.preventDefault();
				var params = $(this).attr("href").split("/")[1]; 

				$.ajax({
					type: "POST"
	              , url: "/authors/delete/" + params
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
							window.location.replace('/authors');
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