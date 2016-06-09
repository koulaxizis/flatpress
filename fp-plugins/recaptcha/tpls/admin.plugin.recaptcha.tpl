<h2>{$plang.head}</h2>
<p>{$plang.description}</p>

{include file=shared:errorlist.tpl}

<div style="margin: 0 auto; width: 20em;">

	{html_form}

	<p>
		<label for="recaptcha-privatekey">{$plang.privatekey}</label>
		<input id="recaptcha-privatekey" type="text" name="recaptcha-privatekey" value="{$recaptchaconf.privatekey}" />
	</p>
	<p>
		<label for="recaptcha-publickey">{$plang.publickey}</label>
		<input id="recaptcha-publickey" type="text" name="recaptcha-publickey" value="{$recaptchaconf.publicekey}" />
	</p>
	<p>
		<br />
    <label for="recaptcha-theme">{$plang.theme}</label>
		<table>
			<tr>
				<td valign="top">
					<input type="radio" name="recaptcha-theme" value="red" {if $recaptchaconf.tred != "" }checked=checked{/if} />
					<img src="{$recaptchaconf.imgspath}sample_red.png" />
				</td>
				<td valign="top">
					<input type="radio" name="recaptcha-theme" value="white" {if $recaptchaconf.twhite != "" }checked=checked{/if} />
					<img src="{$recaptchaconf.imgspath}sample_white.png" />
				</td>
			</tr>
			<tr>
				<td valign="top">
					<input type="radio" name="recaptcha-theme" value="blackglass" {if $recaptchaconf.tblack != "" }checked=checked{/if} />
					<img src="{$recaptchaconf.imgspath}sample_black.png" />
				</td>
				<td valign="top">
					<input type="radio" name="recaptcha-theme" value="clean" {if $recaptchaconf.tclean != "" }checked=checked{/if} />
					<img src="{$recaptchaconf.imgspath}sample_clean.png" />
				</td>
			</tr>
		</table>

	</p>
	<p>
		<input type="submit" name="recaptcha-conf" value="{$plang.submit}"/>
	</p>
</div>
			
{/html_form}

</div>