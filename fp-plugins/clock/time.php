<?php
$widget['content'] = '<ul id="widget_clock">
<p>Η ώρα πήγε...</p>
<li id="dati_ora">
<input type="text" id="clock" readonly="readonly" disabled="disabled" />

<script language=javascript>
var int=self.setInterval("clock()",1000);
function clock()
  {
  var d=new Date();
  var t=d.toLocaleTimeString();
  document.getElementById("clock").value=t;
  }
</script> 
</li>
<p>Σήμερα έχουμε...</p>
<li id="dati_data">'. date('d/m/Y', time()).'</li>
<p>Η IP σου είναι...</p>
<li id="dati_ip">'. $_SERVER['REMOTE_ADDR'].'</li>
</ul>';

