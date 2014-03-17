<?php
if(isset($_POST['submit'])) {

	if(trim($_POST['nom_event']) == '') {
		$hasError = true;
	} else {
		$name = trim($_POST['nom_event']);
	}

	if(trim($_POST['prenom']) == '') {
		$hasError = true;
	} else {
		$prenom = trim($_POST['prenom']);
	}

	if(trim($_POST['pseudo']) == '') {
		$hasError = true;
	} else {
		$pseudo = trim($_POST['pseudo']);
	}

	if(trim($_POST['email']) == '') {
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}

	if(trim($_POST['phone']) == '') {
		$hasError = true;
	} else {
		$phone = trim($_POST['phone']);
	}

	if(trim($_POST['naissance']) == '') {
		$hasError = true;
	} else {
		$naissance = trim($_POST['naissance']);
	}

	if(trim($_POST['adresse']) == '') {
		$hasError = true;
	} else {
		$adresse = trim($_POST['adresse']);
	}

	if(trim($_POST['postal']) == '') {
		$hasError = true;
	} else {
		$postal = trim($_POST['postal']);
	}

	if(trim($_POST['ville']) == '') {
		$hasError = true;
	} else {
		$ville = trim($_POST['ville']);
	}

	if(trim($_POST['bio']) == '') {
		$hasError = true;
	} else {
		$bio = trim($_POST['bio']);
	}
	
	if(trim($_POST['url'])) {
		$url = trim($_POST['url']);
	}

	if(trim($_POST['pony']) == '') {
		$hasError = true;
	} else {
		$pony = trim($_POST['pony']);
	}

	//If there is no error, send the email
	if(!isset($hasError)) {
		$emailTo = 'jakmaster.heuzef@gmail.com'; // Put your own email address here
		$body = "
		Nom : $name $prenom ($pseudo) \n\n
		Email : $email \n\n
		Tel : $phone \n\n
		Date de naissance : $naissance \n\n
		Adresse : $adresse $postal $ville \n\n
		Bio : $bio \n\n
		URL : $url \n\n
		Pony : $pony \n\n
		";
		$headers = 'From: BronyCUB <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, "[BronyCUB] INSCRIPTION", $body, $headers);
		$emailSent = true;
	}
}
?>

<?php include 'header.php'; ?>
	<div class="container-fluid">
		<div class="row">
		 <div class="col-md-2">
		</div>
		 <div class="col-md-8">
		 <img src="./img/pinkie_pie_party.gif" style="float:right; margin-right:10px;" />
			<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="contactform" class="form-horizontal well" enctype="multipart/form-data">
				<?php if(isset($hasError)) { ?>
				<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>Certains champs ne sont pas remplis avec des informations valides.</div>
				<?php echo $erreur; ?></p>
				<?php } ?>

				<?php if(isset($emailSent) && $emailSent == true) { ?>
				<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert">×</button>
					<h3>Party !!</h3>
					<iframe width="853" height="480" src="//www.youtube.com/embed/UPAuS3bfOzU?autoplay=1" frameborder="0" allowfullscreen></iframe>
				</div>
				<br />
				<br />
				<?php } ?>

				<div class="form-group">
					<label for="nom_event" class="col-lg-1 control-label">Nom</label>
					<div class="col-lg-2"><input type="text" name="nom_event" id="nom_event" class="form-control" id="nom_event" placeholder="Nom de l'&eacute;venement" aria-required="true" ></div>
					<label for="date_event" class="col-lg-1 control-label">Date</label>
					<div class="col-lg-2"><input type="text" name="date_event" id="date_event" class="form-control" id="date_event" placeholder="Date de l'&eacute;venement" aria-required="true" ></div>
					<label for="date_event" class="col-lg-1 control-label">Lieu</label>
					<div class="col-lg-2"><input type="text" name="lieu_event" id="lieu_event" class="form-control" id="lieu_event" placeholder="Lieu de l'&eacute;venement" aria-required="true" ></div>
				</div>
				<br />
				<div class="form-group">
					<label for="bio" class="col-lg-1 control-label">D&eacute;scription</label>
					<div class="col-lg-9"><textarea maxlength="500" rows="15" name="bio" id="bio" rows="6" class="form-control" role="textbox" aria-required="true">Lorem ipsum dolor sit amet</textarea></div>
				</div>
				<br />
				<div class="form-group">
					<div class="col-lg-4"></div>
					<div class="col-lg-4">
					<input type="submit" value="PARTY !!" name="submit" id="submitButton" class="btn btn-info btn-large" title="Envoyer !" />
					</div>
					<div class="col-lg-4"></div>
				</div>
			</form>
		</div>

		 <div class="col-md-2">
		</div>
		</div>
	</div>

<?php include 'footer.php'; ?>
