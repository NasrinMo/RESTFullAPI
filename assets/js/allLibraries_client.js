$(document).ready(function(){

	class Request{

		constructor(){

		}

		bookList() {

			var me = this;

			$("#title-book").empty();
			$("#title-book").prepend("<option>Select</option>");

			$.ajax({
				  type: "GET",
				  url: "http://127.0.0.1/php/allLibraries_server/book/list",
				  data: {},
				  cache: false,
				  success: function(data){
				  		var ObjectData = jQuery.parseJSON( data );//convert json to object
						
						for(var i=0; i<ObjectData.length; i++) {
							var optionText = ObjectData[i].title
											+" - "
											+ObjectData[i].writer ;
							var o = new Option(optionText, ObjectData[i].id);
							
							$("#title-book").append(o);	
						}			
				  }			  
			});
		}

		librarySelect(bookid){

			$("#name-library").empty();
			$("#name-library").prepend($("<option>---</option>"));
			$.ajax({
				  type: "GET",
				  url: "http://127.0.0.1/php/allLibraries_server/library/select/"+bookid,
				  data: {},
				  cache: false,
				  success: function(data){
				  		var ObjectData = jQuery.parseJSON( data );//convert json to object
						
						for(var i=0; i<ObjectData.length; i++) {
							var o = new Option(ObjectData[i].name, ObjectData[i].id_library);
							$("#name-library").append(o);

						}
						
						if ($('#name-library').data("library") != ""){

							var id = $('#name-library').data("library");

							$('#name-library').data("library","");
							$('#name-library').find("option[value='"+id+"']").prop('selected', true);

						}	
				  }
			});

		}

		libraryList() {
			var me = this;
			$.ajax({
				  type: "GET",
				  url: "http://127.0.0.1/php/allLibraries_server/library/list",
				  data: {},
				  cache: false,
				  success: function(data){
				  		var ObjectData = jQuery.parseJSON( data );//convert json to object
						
						for(var i=0; i<ObjectData.length; i++) {
								var tr = $("<tr></tr>");
								tr.append("<td>"+ObjectData[i].name+"</td>");
								tr.append("<td>"+ObjectData[i].address+"</td>");
								tr.append(  "<td>"
												+"<a class='detail' data-id="+ObjectData[i].id+">"
													+"<i class='fas fa-book'></i>"
												+"</a>"
										   +"</td>" );
								$(".library-table").append(tr);	
						}
						me.readyToDetail();			
				  }			  
			});
		}

		//SHOW BOOK BY LIBRARY ID
		readyToDetail(){
			var me = this;

			$(".detail").click(function(e){
							
				me.bookSelectByLibraryID(this);
				e.preventDefault();
			});
		}

		//APPOINTMENT EDIT
		readyToModify(){
			var me = this;

			$(".modify").click(function(e){
							
				me.appointmentModify(this);
				e.preventDefault();
			});
		}

		//APPOINTMENT REMOVE
		readyToDelete(){
			var me = this;

			$(".delete").click(function(e){
							
				me.appointmentDelete(this);
				e.preventDefault();
			});
		}

		bookSelectByLibraryID(element){

			var libraryId =$(element).data("id");
		
			$.ajax({
				  type: "GET",
				  url: "http://127.0.0.1/php/allLibraries_server/book/select/"+libraryId+"/library",
				  data: {},
				  cache: false,
				  success: function(data){
				  		var ObjectData = jQuery.parseJSON( data );//convert json to object
						$(".bookRow").remove();
						for(var i=0; i<ObjectData.length; i++) {
								var tr = $("<tr class='bookRow'></tr>");
								tr.append("<td>"+ObjectData[i].title+"</td>");
								tr.append("<td>"+ObjectData[i].writer+"</td>");
								$(".library-book-table").append(tr);	
						}

						$(".nameLib").text(ObjectData[0].name);
						$(".librariesForm").css("visibility" , "hidden");
						$(".libraryBooksForm").css("visibility" , "visible");	
				  }
			});

		}

		libraryBookList() {

			$.ajax({
				  type: "GET",
				  url: "http://127.0.0.1/php/allLibraries_server/library-book/list",
				  data: {},
				  cache: false,
				  success: function(data){

				  		var ObjectData = jQuery.parseJSON( data );//convert json to object
						
						for(var i=0; i<ObjectData.length; i++) {
								var tr = $("<tr></tr>");
								tr.append("<td>"+ObjectData[i].title+"</td>");
								tr.append("<td>"+ObjectData[i].writer+"</td>");
								tr.append("<td>"+ObjectData[i].name+"</td>");
								$(".book-table").append(tr);	
						}		
				  }			  
			});
		}

		appointmentList(userId) {

			var me =this;

			$.ajax({
				  type: "GET",
				  url: "http://127.0.0.1/php/allLibraries_server/appointment/list/"+userId,
				  data: {},
				  cache: false,
				  success: function(data){

				  		var ObjectData = jQuery.parseJSON( data );//convert json to object
						
						$(".appointment-table tr").remove();

						for(var i=0; i<ObjectData.length; i++) {
								var tr = $("<tr></tr>");
								tr.append("<td>"+ObjectData[i].title+"</td>");
								tr.append("<td>"+ObjectData[i].name+"</td>");
								tr.append("<td>"+ObjectData[i].appointmentDate+"</td>");
								tr.append(  "<td>"
												+'<a href="#" class="modify" data-id="'+ObjectData[i].id+'"><i class="fas fa-edit"></i></a> | '
												+'<a href="#" class="delete" data-id="'+ObjectData[i].id+'"><i class="fas fa-trash-alt"></i></a></td>'
										    +'</tr>' );
								$(".appointment-table").append(tr);	
						}
						
						me.readyToModify();	
						me.readyToDelete();			
				  }			  
			});
		}

		appointementAdd() {

			var me =this;
			var appointment_data =  $(".appointment-form").serializeArray() ;
			var obj = {};
			
			appointment_data.forEach(function(element){

				if (element.name == "appointmentDate") {

					var arrayDate = element.value.split("T");
					obj[element.name] = (arrayDate[0] + " " + arrayDate[1]);
	
				}else{
					obj[element.name] = element.value;
				}
			    
			});
			
			$.ajax({
				  type: "POST",
				  url: "http://127.0.0.1/php/allLibraries_server/appointment/insert",
				  data: {"postData" : JSON.stringify(obj)} ,
				  dataType: "json",
				  cache: false,
				  success: function(data){
				  	
				  		if (data.status) {

				  			$("#message").text("");
				  			$("#message").text(data["message"]);
				  			$(".messageContainer").css("visibility" , "visible");

				  			$("#name-library").empty();
				  			$(".appointment-form")[0].reset();
				  		}else{
				  			
					  		if(typeof(data.suggestion) != "undefined" && data.suggestion !== null) {

							    $("#yesNomessage").text("");
				  				$("#yesNomessage").html(data["message"]
				  										+"<br><br>"
				  										+"This appointment is available for other libraries. "
				  										+"<br><br>"
				  										+"Do you want to check?");
				  				$(".yesNoContainer").css("visibility" , "visible");

							}else{

								$("#message").text("");
						  		$("#message").text(data["message"]);
						  		$(".messageContainer").css("visibility" , "visible");
							}
							

							$(".yesButton").click(function(){
								$(".yesNoContainer").css("visibility" , "hidden");

								var text = "";
								var i=1;

								$.each(data.suggestion, function (index, value) {

							            text += i+") " + value.name + "<br>" ;
							            ++i;
							    });

								$("#message").text("");
						  		$("#message").html(text);
						  		$(".messageContainer").css("visibility" , "visible");
							});

							$(".noButton").click(function(){
						  		$(".yesNoContainer").css("visibility" , "hidden");
		
							});
				  		}

				  		me.appointmentList($(".id-user").val());
				  },
		          error: function(response) {
		          		$("#message").text("");
		          		$("#message").text(response["responseText"]);
				  		$(".messageContainer").css("visibility" , "visible");
		          }
			});
		}

		appointementEdit(){
			var me =this;
			var appointment_data =  $(".appointment-form").serializeArray() ;
			var obj = {};
			
			appointment_data.forEach(function(element){
				if (element.name == "appointmentDate") {

					var arrayDate = element.value.split("T");
					obj[element.name] = (arrayDate[0] + " " + arrayDate[1]);
	
				}else{
					obj[element.name] = element.value;
				}
			    
			});
			
			$.ajax({
				  type: "POST",
				  url: "http://127.0.0.1/php/allLibraries_server/appointment/modify",
				  data: {"postData" : JSON.stringify(obj)} ,
				  dataType: "json",
				  cache: false,
				  success: function(data){
				  	
				  		if (data.status) {

				  			$("#message").text("");
				  			$("#message").text(data["message"]);
				  			$(".messageContainer").css("visibility" , "visible");

				  			$("#name-library").empty();
				  			$("#id-appointment").val("");
				  			$(".appointment-form")[0].reset();
				  		}else{
				  			
					  		if(typeof(data.suggestion) != "undefined" && data.suggestion !== null) {

							    $("#yesNomessage").text("");
				  				$("#yesNomessage").html(data["message"]
				  										+"<br><br>"
				  										+"This appointment is available for other libraries. "
				  										+"<br><br>"
				  										+"Do you want to check?");
				  				$(".yesNoContainer").css("visibility" , "visible");

							}else{

								$("#message").text("");
						  		$("#message").text(data["message"]);
						  		$(".messageContainer").css("visibility" , "visible");
							}
							

							$(".yesButton").click(function(){
								$(".yesNoContainer").css("visibility" , "hidden");

								var text = "";
								var i=1;

								$.each(data.suggestion, function (index, value) {

							            text += i+") " + value.name + "<br>" ;
							            ++i;
							    });

								$("#message").text("");
						  		$("#message").html(text);
						  		$(".messageContainer").css("visibility" , "visible");
							});

							$(".noButton").click(function(){
						  		$(".yesNoContainer").css("visibility" , "hidden");
		
							});
				  		}

				  		me.appointmentList($(".id-user").val());
				  },
		          error: function(response) {
		          		$("#message").text("");
		          		$("#message").text(response["responseText"]);
				  		$(".messageContainer").css("visibility" , "visible");
		          }

			});
		}

		appointmentModify(element){
			var appointmentId =$(element).data("id");
			var me = this;

			$.ajax({
				type: "GET",
				  url: "http://127.0.0.1/php/allLibraries_server/appointment/select/"+appointmentId,
				  data: {},
				  cache: false,
				  success: function(data){

				  		var ObjectData = jQuery.parseJSON( data );//convert json to object
				  	
				  		$("#id-appointment").val(ObjectData.id_appointment);
				  		$("#id-libraryBook").val(ObjectData.id_library_book);

						$('#title-book').find("option[value='"+ObjectData.id_book+"']").prop('selected', true);
						$('#name-library').data("library",ObjectData.id_library );
					
						me.librarySelect(ObjectData.id_book);

						var arrayDate = ObjectData.appointmentDate.split(" ");
						var dateTime = (arrayDate[0] + "T" + arrayDate[1]).slice(0, -3);
						
						$("#appointmentDate").val(dateTime);
				  }  
			});
		}

		appointmentDelete(element){

			var appointmentId =$(element).data("id");
			var me = this;

			var obj = {token :  $(".token").val() };

			$.ajax({
				  type: "POST",
				  url: "http://127.0.0.1/php/allLibraries_server/appointment/remove/"+appointmentId,
				  data: {"postData" : JSON.stringify(obj)} ,
				  dataType: "json",
				  cache: false,
				  success: function(data){
				  		$("#message").text("");
				  		$("#message").text(data["message"]);
				  		$(".messageContainer").css("visibility" , "visible");

				  		me.appointmentList($(".id-user").val());
				  		
				  },
		          error: function(response) {
		          		$("#message").text("");
		          		$("#message").text(response["message"]);
				  		$(".messageContainer").css("visibility" , "visible");
		          }

			});
		}


	}

	var request = new Request() ;

	request.bookList(); // full select tag book
	request.libraryList(); //library link on header
	request.libraryBookList(); //book link on header

	if ( $(".id-user").val() ) {

		var userId = $(".id-user").val();
		request.appointmentList(userId); //table appointment
	}

	

//AllClickFunction
	$( "#title-book" ).change(function() {
		var bookid = $( "#title-book option:selected" ).val();
		request.librarySelect(bookid); // full select tag library
	});

	$(".fa-user-circle").click(function(){
  		$(".loginForm").css("visibility" , "visible");
	});

	$(".welcome").click(function(){
  		$(".signoutContainer").css("visibility" , "visible");
	});

	$(".librariesLink").click(function(){
  		$(".librariesForm").css("visibility" , "visible");
	});

	$(".booksLink").click(function(){
  		$(".booksForm").css("visibility" , "visible");
	});

	//close button
	$(".fa-times").click(function(){
  		$(".loginForm").css("visibility" , "hidden");
  		$(".librariesForm").css("visibility" , "hidden");
  		$(".booksForm").css("visibility" , "hidden");
  		$(".libraryBooksForm").css("visibility" , "hidden");
	});
	
	//second close button
	$(".second").click(function(){
  		$(".libraryBooksForm").css("visibility" , "hidden");
  		$(".librariesForm").css("visibility" , "visible");	
	});

	$(".messageButton").click(function(){
  		$(".messageContainer").css("visibility" , "hidden");	
	});

	$(".appointement-submit").click(function(){
		
		if ( $("#id-appointment").val() == "") {
			request.appointementAdd();
		}else{
			request.appointementEdit();
		}		
	});

	$(".cancel").click(function(){
		
		$("#name-library").empty();
		$("#id-appointment").val("");
		$(".appointment-form")[0].reset();		
	});
	

});

