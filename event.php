<?php
if(isset($_POST['submit'])) {

	if(trim($_POST['nomevent']) == '') {
		$hasError = true;
	} else {
		$name = trim($_POST['nomevent']);
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
			<form role="form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="contactform" class="form-horizontal well" enctype="multipart/form-data">
				<?php if(isset($hasError)) { ?>
				<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>Certains champs ne sont pas remplis avec des informations valides.</div>
				<?php echo $erreur; ?></p>
				<?php } ?>

				<?php if(isset($emailSent) && $emailSent == true) { ?>
				<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert">×</button>
					<h3>Message bien reçu !</h3>
					<iframe width="853" height="480" src="//www.youtube.com/embed/UPAuS3bfOzU?autoplay=1" frameborder="0" allowfullscreen></iframe>
				</div>
				<br />
				<br />
				<?php } ?>

				<div class="form-group">
					<label for="nomevent" class="col-lg-2 control-label">Nom de l'évenement</label>
					<div class="col-lg-3"><input type="text" name="nomevent" id="nomevent" class="form-control" id="nomevent" placeholder="Nom de l'&eacute;venement" aria-required="true" ></div>
				</div>
				<br />
				<div class="form-group">
					<label for="bio" class="col-lg-1 control-label">Pr&eacute;sentation</label>
					<div class="col-lg-9"><textarea maxlength="500" rows="5" name="bio" id="bio" rows="6" class="form-control" role="textbox" aria-required="true" placeholder="Ecrivez quelques lignes &agrave; propos de vous (500 caract&eacute;res max)"></textarea></div>
				</div>
				<br />
				<div class="form-group">
					<div class="col-lg-4"></div>
					<div class="col-lg-4">
					<input type="submit" value="BROHOOF /)" name="submit" id="submitButton" class="btn btn-info btn-large" title="Envoyer !" />
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







