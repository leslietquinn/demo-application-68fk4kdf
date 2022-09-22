	
	<h2>Edit Author</h2>
	<a name="edit_author" id="edit_author"></a>
	<form id="submit_edit_author_form" autocomplete="off" action="" method="post">
		@csrf
		<div class="form-group">
			<input value="{{ $author->id }}" type="hidden" class="author-id" name="id" />
			<input value="{{ $author->name }}" type="text" class="form-control my-2 author-name" name="name" placeholder="Enter the name of an author" />
			<button id="toggle_author_button" type="submit" class="btn btn-block btn-primary w-100" disabled>Go</button>
		</div>
	</form>
	<a rel="noindex,nofollow" href="/authors/#new_author">New Author</a>