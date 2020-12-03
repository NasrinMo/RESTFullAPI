<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Client Side</title>
	<link href="../assets/font/css/all.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="../assets/js/allLibraries_client.js"></script>
	<link rel="stylesheet" type="text/css" href="../assets/css/_allLibraries_client.css?v=<?php echo date("h:mi:s") ?>">
</head>
<body>
	<header>
		<div class="content-top">
			
			<?php if (isset($_SESSION["token"])) { ?>
				<h3 class="welcome">Welcome <?= $_SESSION["firstName"]." ".$_SESSION["lastName"]   ?></h3>
			<?php }else{ ?>
				<i class="fas fa-user-circle fa-3x"></i>
			<?php } ?>
		</div>
		
		<div class="link">
			<a class="librariesLink">Libraries</a>
			<a class="booksLink">Books</a>
		</div>
	</header>

	<?php if (isset($_SESSION["token"])) { ?>

	<div class="content">
		<form class="appointment-form" >
			<input type="hidden" class="token" name="token" value="<?php echo $_SESSION["token"] ?>">
			<input type="hidden" class="id-user" name="id-user" value="<?php echo $_SESSION["id"] ?>">
			<input type="hidden" name="id" id="id-appointment">
			<input type="hidden" name="id_library_book" id="id-libraryBook">
			<fieldset class="appointment-container">
				<legend><b>Get New Appointment</b></legend>
					<label class="labelblock" >
						Book :
						<select name="id_book" id="title-book" class="labelblock">
							
						</select>
					</label>
					<label class="labelblock" >
						Library :
						<select name="id_library" id="name-library" class="labelblock" data-library="">
		
						</select>
					</label>
					<label class="labelblock" >
						Appointment :
						<input type="datetime-local" name="appointmentDate" id="appointmentDate">
					</label>
					<button type="button" class="submit appointement-submit">Submit</button>
					<button type="reset" class="cancel">Cancel</button>				
			</fieldset>

			<fieldset class="tableContainer">
				<legend><b><?php echo $_SESSION["firstName"] ?>'s Appointments</b></legend>
				<div class="tableContainerScrollBar">
					<table class="appointment-table">
						<tr>
							<th>Book</th>
							<th>Library</th>
							<th>Appointment Date</th>
							<th>Action</th>
						</tr>
					</table>
				</div>
			</fieldset>
		</form>
	</div>

	<?php }?>

	<div class="loginForm">
		<i class="fas fa-times fa-3x"></i>
		<form action="controller.class.php?action=login" method="POST" >
			<fieldset>
				<h4>Welcome - Login</h4>
				<input type="text" name="email" value placeholder="Email">
				<input type="password" name="password" value placeholder ="Password">
				<button>Login</button>

			</fieldset>
		</form>
	</div>

	<div class="signoutContainer">
		<div class="signoutFram">
			<form action="controller.class.php?action=signout" method="POST">
				<span>Do you want to sign out?</span>
				<button>Yes</button>
				<button type="button">Cancel</button>
			</form>
		</div>
		
	</div>

	<div class="librariesForm">
		<i class="fas fa-times fa-3x"></i>
		<form >
			<fieldset>
				<form>
					<fieldset class="library-container">
						<legend><b>Search</b></legend>
							<label class="labelblock" >
								Name :
								<input type="text" name="name">
							</label>
							<label class="labelblock" >
								Address :
								<input type="text" name="address">
							</label>
							<button type="button" class="submit">Search</button>
							<button type="reset" class="cancel">Cancel</button>	
					</fieldset>

					<fieldset class="tableContainer">
						<legend><b>List of Libraries</b></legend>
						<table class="library-table">
							<tr>
								<th>Name</th>
								<th>Address</th>
								<th>Books</th>
							</tr>
						</table>
						
					</fieldset>
				</form>

			</fieldset>
		</form>
	</div>

	<div class="libraryBooksForm">
		<i class="fas fa-times fa-3x second"></i>
		<form >
			<fieldset>
				<form>
					<fieldset class="library-book-container">
						<legend><b>Search</b></legend>
							<label class="labelblock" >
								Title :
								<input type="text" name="title">
							</label>
							<label class="labelblock" >
								Writer :
								<input type="text" name="writer">
							</label>
							<button type="button" class="submit">Search</button>
							<button type="reset" class="cancel">Cancel</button>	
					</fieldset>

					<fieldset class="tableContainer">
						<legend><b>books of <span class="nameLib"></span> library</b></legend>
						<table class="library-book-table">
							<tr>
								<th>Title</th>
								<th>Writer</th>
							</tr>
							<tr class="bookRow">
								
							</tr>
						</table>
						
					</fieldset>
				</form>

			</fieldset>
		</form>
	</div>

	<div class="booksForm">
		<i class="fas fa-times fa-3x"></i>
		<form >
			<fieldset>
				<form>
					<fieldset class="book-container">
						<legend><b>Search</b></legend>
							<label class="labelblock">
								Library :
								<select name="id_library">
									<option>All</option>
								</select>
							</label>
							<label class="labelblock" >
								Title :
								<input type="text" name="title">
							</label>
							<label class="labelblock" >
								Writer :
								<input type="text" name="writer">
							</label>
							<button type="button" class="submit">Search</button>
							<button type="reset" class="cancel">Cancel</button>	
					</fieldset>

					<fieldset class="tableContainer">
						<legend><b>List of books</b></legend>
						<table class="book-table">
							<tr>
								<th>Title</th>
								<th>Writer</th>
								<th>Library</th>
							</tr>
						</table>
						
					</fieldset>
				</form>

			</fieldset>
		</form>
	</div>

	<div class="messageContainer">
		<div class="messageFram">
			<span id="message"></span>
			<button type="button" class="messageButton">OK</button>
		</div>
		
	</div>

	<div class="yesNoContainer">
		<div class="yesNoFram">
			<span id="yesNomessage"></span>
			<div class="justButton">
				<button type="button" class="yesButton">Yes</button>
				<button type="button" class="noButton">No</button>
			</div>
		</div>
		
	</div>


</body>
</html>