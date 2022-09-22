	
	<h2>Edit Category</h2>
	<a name="edit_category" id="edit_category"></a>
	<form id="submit_edit_category_form" autocomplete="off" action="" method="post">
		@csrf
		<div class="form-group">
			<input value="{{ $category->id }}" type="hidden" class="category-id" name="id" />
			<input value="{{ $category->name }}" type="text" class="form-control my-2 category-name" name="name" placeholder="Enter the name of a category" />
			<button id="toggle_category_button" type="submit" class="btn btn-block btn-primary w-100" disabled>Go</button>
		</div>
	</form>
	<a rel="noindex,nofollow" href="/categories/#new_category">New Category</a>