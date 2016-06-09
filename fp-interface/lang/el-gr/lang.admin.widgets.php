<?php

	$lang['admin']['widgets']['submenu']['default'] = 'Διαχείριση Μικροεφαρμογών';
	$lang['admin']['widgets']['submenu']['raw'] 	= 'Διαχείριση Μικροεφαρμογών (απλή επεξεργασία)';

	/* default action */
	
	$lang['admin']['widgets']['default'] = array(
		'head'		=> 'Διαχείριση Μικροεφαρμογών (<em>σε πειραματικό στάδιο</em>)',
		
		'descr'		=> 	'Μία <a class="hint" '.
						'href="http://wiki.flatpress.org/doc:widgets" title="Τι είναι μία Μικροεφαρμογή;">'.
						'Μικροεφαρμογή</a> είναι ένα δυναμικό στοιχείο που μπορεί να προβάλει δεδομένα και να διαδράσει με τον χρήστη.
						Ενώ τα <strong>Θέματα</strong> αλλάζουν τη γενική εμφάνιση του ιστολογίου, οι Μικροεφαρμογές 
						<strong>επεκτείνουν</strong> την εμφάνιση και τις λειτουργίες.</p>

						<p>Οι Μικροεφαρμογές μπορούν να συρθούν σε συγκεκριμένες περιοχές του θέματος που ονομάζονται 
						<strong>Περιοχές Μικροεφαρμογών</strong>. Το πλήθος και η ονομασία των Περιοχών Μικροεφαρμογών μπορεί να ποικίλει ανάλογα με το 
						θέμα που χρησιμοποιείς.</p>

						<p>Το FlatPress έρχεται με διάφορες Μικροεφαρμογές προεγκατεστημένες: υπάρχουν Μικροεφαρμοργές για να σε βοηθήσουν με τη σύνδεση, για 
						προβολή ενός πεδίου αναζήτησης, και άλλα.</p>
						
						<p>Κάθε Μικροεφαρμογή ορίζεται από ένα <a class="hint" '.
						'href="http://wiki.flatpress.org/doc:plugins" title="Τι είναι ένα Πρόσθετο;">Πρόσθετο</a>.',
						
		'availwdgs'	=> 'Διαθέσιμες Μικροεφαρμογές',
		'trashcan'	=> 'Σύρε εδώ για διαγραφή',
		
		'themewdgs' => 'Περιοχές Μικροεφαρμογών θέματος',
		'themewdgsdescr' => 'Το θέμα σου διαθέτει τις εξής Περιοχές Μικροεφαρμογών',
		'oldwdgs'	=> 'Άλλες Περιοχές Μικροεφαρμογών',
		'oldwdgsdescr' =>'Οι ακόλουθες Περιοχές Μικροεφαρμογών δεν φαίνεται να ανήκουν σε κάποιες από τις '.
						'Περιοχές Μικροεφαρμογών που αναφέρονται παραπάνω. Ίσως είναι απομεινάρια από κάποιο άλλο θέμα.',
		
		'submit'	=> 'Αποθήκευση αλλαγών',

	);
	
	$lang['admin']['widgets']['default']['stdsets'] = array(
		'top'		=> 'Πάνω περιοχή',
		'bottom'	=> 'Κάτω περιοχή',
		'left'		=> 'Αριστερή πριοχή',
		'right'		=> 'Δεξιά περιοχή',
	);
	
	$lang['admin']['widgets']['default']['msgs'] = array(
		1	=> 'Η ρύθμιση αποθηκεύτηκε',
		-1	=> 'Προέκυψε κάποιο σφάλμα κατά την αποθήκευση, παρακαλώ προσπάθησε ξανά',
	);


	
	/* "raw" panel */	
	
	$lang['admin']['widgets']['raw'] = array(
		'head'		=> 'Διαχείριση Μικροεφαρμογών (<em>raw editor</em>)',
		'descr'		=> 'Μια <a class="hint" '.
						'href="http://wiki.flatpress.org/doc:plugins" title="Τι είναι μια Μικροεφαρμογή;">'.
						'Μικροεφαρμογή</a> είναι το οπτικοποιημένο στοιχείο ενός <a class="hint" '.
						'href="http://wiki.flatpress.org/doc:plugins" title="Τι είναι ένα Πρόσθετο;">'.
						'Πρόσθετου</a> που μπορείς να τοποθετήσεις σε συγκεκριμένες περιοχές (τις <em>Περιοχές Μικροεφαρμογών</em>) στο ιστολόγιο σου. </p>'.
						'<p>Αυτός είναι ένας <strong>απλός</strong> επεξεργαστής; κάποιοι προχωρημένοι χρήστες οι άνθρωποι που '.
						'δεν χρησιμοποιούν JavaScript, μπορεί να τον προτιμούν.',
						
		'fset1'		=> 'Επεξεργαστής',
		'fset2'		=> 'Εφαρμογή αλλαγών',
		'submit'	=> 'Εφαρμογή',

	);
	
	
	$lang['admin']['widgets']['raw']['msgs'] = array(
		1	=> 'Η ρύθμοση αποθηκεύτηκε',
		-1	=> 'Προέκυψε κάποιο σφάλμα κατά την αποθήκευση. Αυτό μπορεί να συνέβη για διάφορους λόγους: ίσως το αρχείο σου να περιέχει συντακτικά λάθη.',
	);

		

	/* system errors */
		
	$lang['admin']['widgets']['errors'] = array(
		'generic'	=> 'Η Μικροεφαρμογή με την ονομασία <strong>%s</strong> δεν είναι καταχωρημένη και θα παρακαμφθεί. '.
 				'Είναι το σχετικό Πρόσθετο ενεργοποιημένο στον <a href="admin.php?p=plugin">Πίνακα Ελέγχου</a>;'

	);
	
?>
