<?php
	$lang['plugin']['prettyurls']['errors'] = array (
		-2	=> 'Αδυναμία εύρεσης ή δημιουργίας ενός <code>.htaccess</code> αρχείου στον διακομιστή '.
				'Το πρόσθετο PrettyURLs ίσως να μη δουλέψει σωστά.'
	);
	
	$lang['admin']['plugin']['submenu']['prettyurls'] = 'Ρύθμιση του PrettyURLs';
	$lang['admin']['plugin']['prettyurls'] = array(
		'head'		=> 'Ρύθμιση του PrettyURLs',
		'htaccess'	=> '.htaccess',
		'description'=>'Αυτός ο επεξεργαστής σου επιτρέπει να διαχειριστείς το αρχείο '.
						'<code><a class="hint" href="http://wiki.flatpress.org/doc:plugins:prettyurls#htaccess">.htaccess</a></code>.',
		'cantsave'	=> 'Δεν μπορείς να επεξεργαστείς αυτό το αρχείο, επειδή δεν είναι <strong>εγγράψιμο</strong>. Μπορείς να του δώσεις δικαιώματα εγγραφής ή να κάνεις αντιγραφή-επικόλληση σε ένα αρχείο και έπειτα να το ανεβάσεις όπως περιγράφεται <a class="hint" href="http://wiki.flatpress.org/doc:plugins:prettyurls#manual_upload">εδώ</a>',
		'mode'		=> 'Λειτουργία',
		'auto'		=> 'Αυτόματο',
			'autodescr'	=> 'Προσπαθεί να μαντέψει την καλύτερη επιλογή',
		'pathinfo'	=> 'Πληροφορίες μονοπατιού',
			'pathinfodescr' => 'π.χ. /index.php/2011/01/01/hello-world/',
		'httpget'	=> 'Λήψη HTTP',
			'httpgetdescr'=> 'π.χ. /?u=/2011/01/01/hello-world/',
		'pretty'	=> 'Ωραιοποιημένο',
			'prettydescr'=> 'π.χ. /2011/01/01/hello-world/',

		'saveopt' 	=> 'Αποθήκευση αλλαγών',

		'submit'	=> 'Αποθήκευση .htaccess'
	);
	$lang['admin']['plugin']['prettyurls']['msgs'] = array(
		1		=> 'Το .htaccess αποθηκεύτηκε επιτυχώς',
		-1		=> 'Το .htaccess δεν μπόρεσε να αποθηκευτεί (έχεις δικαιώματα εγγραφής στο <code>'. BLOG_ROOT .'</code>);',

		2		=> 'Οι επιλογές αποθηκεύτηκαν επιτυχώς',
		-2		=> 'Προέκυψε κάποιο σφάλμα κατά την αποθήκευση των ρυθμίσεων',
	);
	
?>
