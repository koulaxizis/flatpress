<fieldset id="plugin_tag">
	<legend>{$taglang.tag_pl}</legend>
	<script type="text/javascript">
		vdfnTagRemove='{$taglang.remove|addslashes}';
		vdfnTagUrl='{$smarty.const.BLOG_BASEURL|addslashes}admin.php?ajaxtag=list';
	</script>
	<script type="text/javascript" src="{'tag'|plugin_geturl}res/tag.js"></script>
	<p><input name="taginput" id="taginput" value="{$tags_simple}" /></p>
	<div id="tagplace"></div>
</fieldset>
