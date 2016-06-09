			{static content=$entry}
			<div class="entry">
				<h3>{$subject}</h3>
				<p class="date">Δημοσιεύθηκε από τον/την {$author} στις {$date|date_format:$fp_config.locale.dateformat} </p>
				{$content}
			</div>
			{/static}

