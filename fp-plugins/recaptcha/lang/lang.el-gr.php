<?php
	$lang['admin']['plugin']['submenu']['recaptcha'] = 'reCaptcha';

	$lang['admin']['plugin']['recaptcha'] = array(
		'head'		=> 'Ρύθμιση της υπηρεσίας reCaptcha',
		'description'=>'Για τους περισσότερους, η υπηρεσία <a href="http://www.google.com/recaptcha">reCaptcha</a> θα μειώσει εντυπωσιακά '
					 .'ή ακόμα και θα εξαλείψει πλήρως τα ανεπιθύμητα σχόλια στην ιστοσελίδα τους. '
					 .'Για να λειτουργήσει αυτό το πρόσθετο, απαιτούνται το ιδιωτικό και το δημόσιο κλειδί που λαμβάνεις όταν '
					 .'κάνεις εγγραφή στην υπηρεσία <a href="http://www.google.com/recaptcha">reCaptcha</a>.',
		'privatekey' => 'Ιδιωτικό κλειδί',
		'publickey' => 'Δημόσιο κλειδί',
		'submit' => 'Αποθήκευση ρυθμίσεων',
		'theme' => 'Επιλογή θέματος'
	);

	$lang['admin']['plugin']['recaptcha']['msgs'] = array(
		1		=> 'Οι ρυθμίσεις αποθηκεύτηκαν.',
		-1		=> 'Οι ρυθμίσεις δεν αποθηκεύτηκαν.'
	);

	/*
	The 'customtranslations' allows elements of the reCaptcha UI to be overridden. For example to change how the text 
	displayed by the refresh and help buttons the following entry could be provided...
	{
		refresh_btn : “Refresh”,
		help_btn : “What do I do?”,
	}
	
	Note, if any override is provided then the enclosing curly braces must also be present.
	
	For further information see http://code.google.com/apis/recaptcha/docs/customization.html
	*/
	$lang['plugin']['recaptcha'] = array(
		'prefix' => 'Για να αποφευχθούν οι κακόβουλες επιθέσεις (spam), θα πρέπει να αποδείξεις ότι είσαι άνθρωπος:',
		'error' => 'Λυπάμαι, απάντησες λάθος. Προσπάθησε ξανά.',
		'customtranslations' => ''
	);

	$lang['plugin']['recaptcha']['errors'] = array (
		-1	=> 'Δεν έχουν οριστεί τα κλειδιά της υπηρεσίας reCaptcha. Έλεγξε τις ρυθμίσεις του πρόσθετου.'
	);

?>
