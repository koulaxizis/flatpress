	<div itemscope itemtype="http://schema.org/BlogPosting" id="{$id}" class="entry {$date|date_format:"y-%Y m-%m d-%d"}">
				{* 	using the following way to print the date, if more 	*} 
				{*	than one entry have been written the same day,		*} 
				{*	 the date will be printed only once 				*}
				
		{$date|date_format_daily:"<h2 class=\"date\">`$fp_config.locale.dateformat`</h2>"}
		
				<h3 itemprop="name">
				<a href="{$id|link:post_link}">
				{$subject|tag:the_title}
				</a>
				</h3>
				{include file=shared:entryadminctrls.tpl}
				
				<span itemprop="articleBody">
				{$content|tag:the_content}
				</span>
				
				<ul class="entry-footer">
			
				<li class="entry-info">Δημοσιεύθηκε από τον/την <span itemprop="author">{$author}</span> στις
				{$date|date_format}

				<span itemprop="articleSection">
				{if ($categories)} στην κατηγορία {$categories|@filed}{/if}
				</span>
				</li> 
				
				{if !(in_array('commslock', $categories) && !$comments)}
				<li class="link-comments">
				<a href="{$id|link:comments_link}#comments">{$comments|tag:comments_number} 
					{if isset($views)}(<strong>{$views}</strong> προβολές){/if}
				</a>
				</li>
				{/if}
				
				</ul>
			
				
	</div>
	
