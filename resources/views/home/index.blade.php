	@extends("layouts.app")
	@section("head")
	<title>Dashboard</title>
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
	</div>
	<div class="clear-fix"></div>
	<!-- ends: root container -->
	@endsection
	@section("scripts")
	<script></script>
	@endsection