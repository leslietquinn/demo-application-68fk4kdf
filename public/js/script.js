		
		/**
		 * @note	use $(document)... instead of $(".input-name")... when there is 
		 * 			dynamic HTML being inserted to replace existing HTML, to maintain 
		 * 			event bubbling
		 */

  		$(document).on("keyup change", ".author-name", function()
  		{ 
  			$(".author-name").css("background", "");

  			if($(".author-name").val() == "")
    		{
      			$("#toggle_author_button").prop("disabled", true);
    		} 
    		else 
    		{
      			$("#toggle_author_button").prop("disabled", false);
    		}
  		});
		
		$(document).on("submit", "#submit_edit_author_form", function(e)
		{
			e.preventDefault();
			var data = $(this).serialize();

			$.ajax({
				type: "POST"
              , url: "/authors/update/" + $(".author-id").val()
			  , headers: {
					"X-HTTP-Method-Override": "PUT" // POST, GET, PUT, DELETE
				  , "X-CSRF-TOKEN": jQuery('meta[name="csrf"]').attr("content")
				}
			  , data: data
			  , cache: false
			  , dataType: "json"
			  , contentType: "application/x-www-form-urlencoded"
			  	// , contentType: "application/json; charset=UTF-8"
			  , success: function(rs, status, xhr) 
			  	{
  					$(".author-name").css("background", "");
      				$("#toggle_author_button").prop("disabled", true);

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

					$.each(JSON.parse(xhr.responseText).errors, function(key, v)
					{
						$(".author-" + key).css("background", "#900");
					});
                }
            });
			
		});

		$(document).on("submit", "#submit_new_author_form", function(e)
		{
			e.preventDefault();
			var data = $(this).serialize();

			$.ajax({
				type: "POST"
              , url: "/authors/store"
			  , headers: {
					"X-HTTP-Method-Override": "POST" // POST, GET, PUT, DELETE
				  , "X-CSRF-TOKEN": jQuery('meta[name="csrf"]').attr("content")
				}
			  , data: data
			  , cache: false
			  , dataType: "json"
			  , contentType: "application/x-www-form-urlencoded"
			  	// , contentType: "application/json; charset=UTF-8"
			  , success: function(rs, status, xhr) 
			  	{
  					$(".author-name").css("background", "");
      				$("#toggle_author_button").prop("disabled", true);

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

					$.each(JSON.parse(xhr.responseText).errors, function(key, v)
					{
						$(".author-" + key).css("background", "#900");
					});
                }
            });
		});

		$(document).on("click", ".edit_author_clicker", function(e)
		{
			e.preventDefault();
			var params = $(this).attr("href").split("/")[1]; 
			
			$.ajax({
				type: "GET"
			  , url: "/authors/" + params + "/edit"
			  , data: ""
			  , cache: false
			  , dataType: "text"
			  , contentType: "text/plain"
			  	// , contentType: "application/x-www-form-urlencoded"
			  	// , contentType: "application/json; charset=UTF-8"
			  , success: function(rs, status, xhr) 
			  	{
			  		$("#author_anchor").html(rs);
			  		window.location.href = "#edit_author"
			  	}
			  , error: function(xhr, status, error) 
			  	{
			  		console.log(status + ", " + error);
			  	}
			});
		});
		
		$(document).on("keyup change", ".category-name", function()
  		{ 
  			$(".category-name").css("background", "");

  			if($(".category-name").val() == "")
    		{
      			$("#toggle_category_button").prop("disabled", true);
    		} 
    		else 
    		{
      			$("#toggle_category_button").prop("disabled", false);
    		}
  		});

		$(document).on("submit", "#submit_edit_category_form", function(e)
		{
			e.preventDefault();
			var data = $(this).serialize();

			$.ajax({
				type: "POST"
              , url: "/categories/update/" + $(".category-id").val()
			  , headers: {
					"X-HTTP-Method-Override": "PUT" // POST, GET, PUT, DELETE
				  , "X-CSRF-TOKEN": jQuery('meta[name="csrf"]').attr("content")
				}
			  , data: data
			  , cache: false
			  , dataType: "json"
			  , contentType: "application/x-www-form-urlencoded"
			  	// , contentType: "application/json; charset=UTF-8"
			  , success: function(rs, status, xhr) 
			  	{
  					$(".category-name").css("background", "");
      				$("#toggle_category_button").prop("disabled", true);

					$("#popup")
						.addClass("bg-success")
						.removeClass("bg-danger")
						.html(JSON.parse(xhr.responseText).message)
						.show()
						.delay(3000)
						.fadeOut("slow");

					sleep(1500).then(() => 
					{
						window.location.replace('/categories');
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

					$.each(JSON.parse(xhr.responseText).errors, function(key, v)
					{
						$(".category-" + key).css("background", "#900");
					});
                }
            });
			
		});

		$(document).on("submit", "#submit_new_category_form", function(e)
		{
			e.preventDefault();
			var data = $(this).serialize();

			$.ajax({
				type: "POST"
              , url: "/categories/store"
			  , headers: {
					"X-HTTP-Method-Override": "POST" // POST, GET, PUT, DELETE
				  , "X-CSRF-TOKEN": jQuery('meta[name="csrf"]').attr("content")
				}
			  , data: data
			  , cache: false
			  , dataType: "json"
			  , contentType: "application/x-www-form-urlencoded"
			  	// , contentType: "application/json; charset=UTF-8"
			  , success: function(rs, status, xhr) 
			  	{
  					$(".category-name").css("background", "");
      				$("#toggle_category_button").prop("disabled", true);

					$("#popup")
						.addClass("bg-success")
						.removeClass("bg-danger")
						.html(JSON.parse(xhr.responseText).message)
						.show()
						.delay(3000)
						.fadeOut("slow");

					sleep(1500).then(() => 
					{
						window.location.replace('/categories');
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

					$.each(JSON.parse(xhr.responseText).errors, function(key, v)
					{
						$(".category-" + key).css("background", "#900");
					});
                }
            });
		});

		$(document).on("click", ".edit_category_clicker", function(e)
		{
			e.preventDefault();
			var params = $(this).attr("href").split("/")[1]; 
			
			$.ajax({
				type: "GET"
			  , url: "/categories/" + params + "/edit"
			  , data: ""
			  , cache: false
			  , dataType: "text"
			  , contentType: "text/plain"
			  	// , contentType: "application/x-www-form-urlencoded"
			  	// , contentType: "application/json; charset=UTF-8"
			  , success: function(rs, status, xhr) 
			  	{
			  		$("#category_anchor").html(rs);
			  		window.location.href = "#edit_category"
			  	}
			  , error: function(xhr, status, error) 
			  	{
			  		console.log(status + ", " + error);
			  	}
			});
		});
		
		$(document).on("keyup change", ".book-name, .book-category, .book-author", function()
  		{ 	
  			$(".book-name").css("background", "");
			$(".book-category").css("background", "");
			$(".book-author").css("background", "");

  			if($(".book-name").val() == "" || $(".book-category").find(":selected").val() == "0" || $(".book-author").find(":selected").val() == "0")
    		{
      			$("#toggle_book_button").prop("disabled", true);
    		} 
    		else 
    		{
      			$("#toggle_book_button").prop("disabled", false);
    		}
  		});
		
		$(document).on("submit", "#submit_edit_book_form", function(e)
		{
			e.preventDefault();
			var data = $(this).serialize();

			$.ajax({
				type: "POST"
              , url: "/books/update/" + $(".book-id").val()
			  , headers: {
					"X-HTTP-Method-Override": "PUT" // POST, GET, PUT, DELETE
				  , "X-CSRF-TOKEN": jQuery('meta[name="csrf"]').attr("content")
				}
			  , data: data
			  , cache: false
			  , dataType: "json"
			  , contentType: "application/x-www-form-urlencoded"
			  	// , contentType: "application/json; charset=UTF-8"
			  , success: function(rs, status, xhr) 
			  	{
  					$(".book-name").css("background", "");
  					$(".book-category").css("background", "");
  					$(".book-author").css("background", "");
      				$("#toggle_book_button").prop("disabled", true);

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

					$.each(JSON.parse(xhr.responseText).errors, function(key, v)
					{
						$(".book-" + key).css("background", "#900");
					});
                }
            });
			
		});

		$(document).on("submit", "#submit_new_book_form", function(e)
		{
			e.preventDefault();
			var data = $(this).serialize();

			$.ajax({
				type: "POST"
              , url: "/books/store"
			  , headers: {
					"X-HTTP-Method-Override": "POST" // POST, GET, PUT, DELETE
				  , "X-CSRF-TOKEN": jQuery('meta[name="csrf"]').attr("content")
				}
			  , data: data
			  , cache: false
			  , dataType: "json"
			  , contentType: "application/x-www-form-urlencoded"
			  	// , contentType: "application/json; charset=UTF-8"
			  , success: function(rs, status, xhr) 
			  	{
  					$(".book-name").css("background", "");
  					$(".book-category").css("background", "");
  					$(".book-author").css("background", "");
      				$("#toggle_book_button").prop("disabled", true);

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

					$.each(JSON.parse(xhr.responseText).errors, function(key, v)
					{
						$(".book-" + key).css("background", "#900");
					});
                }
            });
		});

		$(document).on("click", ".edit_book_clicker", function(e)
		{
			e.preventDefault();
			var params = $(this).attr("href").split("/")[1]; 
			
			$.ajax({
				type: "GET"
			  , url: "/books/" + params + "/edit"
			  , data: ""
			  , cache: false
			  , dataType: "text"
			  , contentType: "text/plain"
			  	// , contentType: "application/x-www-form-urlencoded"
			  	// , contentType: "application/json; charset=UTF-8"
			  , success: function(rs, status, xhr) 
			  	{
			  		$("#book_anchor").html(rs);
			  		window.location.href = "#edit_book"
			  	}
			  , error: function(xhr, status, error) 
			  	{
			  		console.log(status + ", " + error);
			  	}
			});
		});

	function sleep(time) 
	{
  		return new Promise((resolve) => setTimeout(resolve, time));
	}