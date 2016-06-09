{include file=header.tpl}

		<div id="main">
		
		
		{static_block}
		{static}
			<div id="{$id}" class="entry page-{$id}">
				<h3>{$subject}</h3>
				<p class="date">Δημοσιεύθηκε από τον/την {$author} στις {$date|date_format_daily}</p>
				
				{$content|tag:the_content}
			</div>
		{/static}

		{/static_block}
		
				
		</div>
		
		{include file=widgets.tpl}
	
{include file=footer.tpl}
