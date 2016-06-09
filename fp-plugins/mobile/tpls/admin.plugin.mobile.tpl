<h2>{$plang.head}</h2>
<p>{$plang.desc1}</p>

{include file=shared:errorlist.tpl}

{html_form class=option-set}

<dl class="option-list">

	<dt><label for="theme">
		{$plang.theme}
	</label></dt>
	<dd><p>
		<select name="theme">
{foreach from=$mobilethemes item=curr_theme}
			<option value="{$curr_theme}"{if $curr_theme==$mobileconf.theme} selected="selected"{/if}>{$curr_theme}</option>
{/foreach}
		</select>
	</p></dd>

	<dt><label for="removejs">
		{$plang.removejs}
	</label></dt>
	<dd> 
		<p><input type="checkbox" name="removejs" id="removejs"{if $mobileconf.removejs} checked="checked"{/if} /></p>
	</dd>

	<dt><label for="admin">
		{$plang.admin}
	</label></dt>
	<dd> 
		<p><input type="checkbox" name="admin" id="admin"{if $mobileconf.admin} checked="checked"{/if} /></p>
	</dd>

</dl>

<div class="buttonbar">
	{html_submit name="save" id="save" value=$panelstrings.submit}
</div>

{/html_form}
