<?php

	$lang = array();

	$lang['main'] = array(
		
		'nextpage'		=> 'Επόμενη Σελίδα &raquo;',
		'prevpage'		=> '&laquo; Προηγούμενη Σελίδα',
		'entry'      	=> 'Καταχώρηση',
		'static'     	=> 'Σελίδα',
		'comment'    	=> 'Σχόλιο',
		'preview'    	=> 'Επεξεργασία/Προεπισκόπηση',
		
		'filed_under'	=> 'Καταχωρημένο υπό ',	
		
		'add_entry'  	=> 'Προσθήκη Καταχώρησης',
		'add_comment'  	=> 'Προσθήκη Σχολίου',
		'add_static'  	=> 'Προσθήκη Σελίδας',
		
		'btn_edit'     	=> 'Επεξεργασία',
		'btn_delete'   	=> 'Διαγραφή',
		
		'nocomments'	=> 'Κάνε ένα σχόλιο',
		'comment'	=> '1 σχόλιο',
		'comments'	=> 'σχόλια',
		
	);
	
	$lang['search'] = array(
		
		'head'	=> 'Αναζήτηση',
		'fset1'	=> 'Επέλεξε φίλτρα αναζήτησης',
		'keywords'	=> 'Φράση',
		'onlytitles'	=> 'Μόνο τίτλοι',
		'fulltext'	=> 'Πλήρες κείμενο',
		
		'fset2'	=> 'Ημερομηνία',
		'datedescr'	=> 'Μπορείς να περιορίσεις την αναζήτηση σου σε μια συγκεκριμένη ημερομηνία. Μπορείς να επιλέξεις ένα έτος, ένα μήνα ή μία μέρα, ή ακόμη και πλήρη ημερομηνία. '.
					'Άφησέ το κενό, για αναζήτηση σε ολόκληρη τη βάση δεδομένων.',
		
		'fset3' 	=> 'Αναζήτηση σε κατηγορίες',
		'catdescr'	=> 'Για να πραγματοποιηθεί αναζήτηση σε όλες τις κατηγορίες, μην επιλέξεις καμία στο παραπάνω πλαίσιο.',
		
		'fset4'	=> 'Έναρξη αναζήτησης',
		'submit'	=> 'Ψάξε',
		
		'headres'	=> 'Αποτελέσματα αναζήτησης',
		'descrres'	=> 'Βρέθηκαν τα ακόλουθα αποτελέσματα για το <strong>%s</strong>:',
		'descrnores'=> 'Δεν βρέθηκαν αποτελέσματα για το <strong>%s</strong>.',
		
		'moreopts'	=> 'Περισσότερες επιλογές',
		
		
		'searchag'	=> 'Επανάληψη αναζήτησης',
		
	);
	
	$lang['search']['error'] = array(
	
		'keywords'	=> 'Πρέπει να ορίσεις τουλάχιστον μία παράμετρο'
	
	);
	
	
	
	
	
	$lang['entry'] = array();
	$lang['entry']['flags'] = array();
	
	$lang['entry']['flags']['long'] = array(
		'draft' => '<strong>Πρόχειρη καταχώρηση</strong>: κρυμμένη, αναμένει δημοσίευση',
		//'static' => '<strong>Στατική καταχώρηση</strong>: κανονικά κρυμμένη, για να εμφανιστεί γράψε ?page=τίτλος-της-καταχώρησης στη διεύθυνση (url) [σε πειραματικό στάδιο]',
		'commslock' => '<strong>Κλείδωμα σχολίων</strong>: δεν επιτρέπονται σχόλια σε αυτή την καταχώρηση'
	);
	
	$lang['entry']['flags']['short'] = array(
		'draft' => 'Πρόχειρο',
		//'static' => 'Στατικό',
		'commslock' => 'Κλειδωμένα σχόλια'
	);

	$lang['404error'] = array(
		'subject'	=> 'Δεν βρέθηκε',
		'content'	=> '<p>Λυπάμαι, η σελίδα που ζήτησες, δεν βρέθηκε!</p>'
	);
		
	// Login
	$lang['login'] = array(
		
		'head'		=> 'Σύνδεση',
		'fieldset1'	=> 'Εισήγαγε το όνομα χρήστη και τον κωδικό σου',
		'user'		=> 'Όνομα χρήστη:',
		'pass'		=> 'Κωδικός:',
		'fieldset2'	=> 'Σύνδεση',
		'submit'	=> 'Σύνδεση',
		'forgot'	=> 'Ξέχασα τον κωδικό μου'
	);
		
	$lang['login']['success'] = array(
		'success'	=> 'Συνδέθηκες.',
		'logout'	=> 'Αποσυνδέθηκες.',
		'redirect'	=> 'Θα ανακατευθυνθείς σε 5 δευτερόλεπτα.',
		'opt1'		=> 'Αρχική σελίδα',
		'opt2'		=> 'Πίνακας ελέγχου',
		'opt3'		=> 'Νέα καταχώρηση'
	);
	
	$lang['login']['error'] = array(
		'user'		=> 'Πρεπει να εισάγεις ένα όνομα χρήστη.',
		'pass'		=> 'Πρέπει να εισάγεις έναν κωδικό.',
		'match'		=> 'Λάθος κωδικός.'
	);
	
	
	$lang['comments'] = array(
		'head'		=> 'Προσθήκη σχολίου',
		'descr'		=> 'Συμπλήρωσε την παρακάτω φόρμα για να προσθέσεις το σχόλιο σου. Τα πεδία με αστερίσκο <b>(*)</b> είναι υποχρεωτικά.',
		'fieldset1'	=> 'Στοιχεία χρήστη',
		'name'		=> 'Όνομα (*)',
		'email'		=> 'Ηλ. ταχυδρομείο:',
		'www'		=> 'Ιστοσελίδα:',
		'cookie'	=> 'Απομνημόνευση στοιχείων',
		'fieldset2'	=> 'Γράψε το σχόλιο σου',
		'comment'	=> 'Σχόλιο (*):',
		'fieldset3'	=> 'Αποστολή',
		'submit'	=> 'Προσθήκη',
		'reset'		=> 'Επαναφορά',
		'success'	=> 'Το σχόλιο σου καταχωρήθηκε επιτυχώς',
		'nocomments'	=> 'Αυτή η δημοσίευση δεν έχει σχόλια ακόμη',
		'commslock'	=> 'Έχουν απενεργοποιηθεί τα σχόλια σε αυτή τη δημοσίευση',
	);
	
	$lang['comments']['error'] = array(
		'name'		=> 'Πρέπει να εισάγεις ένα όνομα',
		'email'		=> 'Πρέπει να εισάγεις ένα έγκυρο ηλ. ταχυδρομείο',
		'www'		=> 'Πρέπει να εισάγεις μία έγκυρη διεύθυνση (URL)',
		'comment'	=> 'Πρέπει να εισάγεις ένα σχόλιο',
	);
	
	$lang['date']['month'] = array(
		
		'Ιανουαρίου',
		'Φεβρουαρίου',
		'Μαρτίου',
		'Απριλίου',
		'Μαΐου',
		'Ιουνίου',
		'Ιουλίου',
		'Αυγούστου',
		'Σεπτεμβρίου',
		'Οκτωβρίου',
		'Νοεμβίου',
		'Δεκεμβρίου'
		
	);

	$lang['date']['month_abbr'] = array(
		
		'Ιαν',
		'Φεβ',
		'Μαρ',
		'Απρ',
		'Μαι',
		'Ιουν',
		'Ιουλ',
		'Αυγ',
		'Σεπ',
		'Οκτ',
		'Νοε',
		'Δεκ'
		
	);

	$lang['date']['weekday'] = array(
		
		'Κυριακή',
		'Δευτέρα',
		'Τρίτη',
		'Τετάρτη',
		'Πέμπτη',
		'Παρασκευή',
		'Σάββατο',
		
	);

	$lang['date']['weekday_abbr'] = array(
		
		'Κυρ',
		'Δευ',
		'Τρι',
		'Τετ',
		'Πεμ',
		'Παρ',
		'Σαβ',
		
	);



?>
