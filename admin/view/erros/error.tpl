<!DOCTYPE html>
<html lang="en">
<head>

	<title>System error</title>
	<meta charset="utf-8">
	<meta name="robots" content="none">
	{literal}
	<!-- Mobile metas -->
	<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
	
	<!-- Global stylesheets -->
	<link href="include/css/reset.css" rel="stylesheet" type="text/css">
	<link href="include/css/common.css" rel="stylesheet" type="text/css">
	<link href="include/css/form.css" rel="stylesheet" type="text/css">
	<link href="include/css/standard.css" rel="stylesheet" type="text/css">
	<link href="include/css/special-pages.css" rel="stylesheet" type="text/css">
	
	<!-- Custom styles -->
	<link href="include/css/simple-lists.css" rel="stylesheet" type="text/css">
	
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="include/favicon.ico">
	<link rel="icon" type="image/png" href="include/favicon-large.png">
	
	<!-- Generic libs -->
	<script type="text/javascript" src="include/js/html5.js"></script><!-- this has to be loaded before anything else -->
	<script type="text/javascript" src="include/js/jquery.js"></script>
	
	<!-- Template core functions -->
	<script type="text/javascript" src="include/js/common.js"></script>
	<script type="text/javascript" src="include/js/standard.js"></script>
	<!--[if lte IE 8]><script type="text/javascript" src="include/js/standard.ie.js"></script><![endif]-->
	<script type="text/javascript" src="include/js/jquery.tip.js"></script>
	
	<!-- Template custom styles libs -->
	<script type="text/javascript" src="include/js/list.js"></script>
	
	<!-- Ajax error report -->
	<script type="text/javascript">
	
		$(document).ready(function()
		{
			$('#send-report').submit(function(event)
			{
				// Stop full page load
				event.preventDefault();
				
				var submitBt = $(this).find('button[type=submit]');
				submitBt.disableBt();
					
				// Target url
				var target = $(this).attr('action');
				if (!target || target == '')
				{
					// Page url without hash
					target = document.location.href.match(/^([^#]+)/)[1];
				}
				
				// Request
				var data = {
					a: $('#a').val(),
					report: $('#report').val(),
					description: $('#description').val(),
					sender: $('#sender').val()
				};
				
				// Send
				$.ajax({
					url: target,
					dataType: 'json',
					type: 'POST',
					data: data,
					success: function(data, textStatus, XMLHttpRequest)
					{
						if (data.valid)
						{
							$('#send-report').removeBlockMessages().blockMessage('Report sent, thank you for your help!', {type: 'success'});
						}
						else
						{
							// Message
							$('#send-report').removeBlockMessages().blockMessage('An unexpected error occured, please try again', {type: 'error'});
							
							submitBt.enableBt();
						}
					},
					error: function(XMLHttpRequest, textStatus, errorThrown)
					{
						// Message
						$('#send-report').removeBlockMessages().blockMessage('Error while contacting server, please try again', {type: 'error'});
						
						submitBt.enableBt();
					}
				});
				
				// Message
				$('#send-report').removeBlockMessages().blockMessage('Please wait, sending report...', {type: 'loading'});
			});
		});
	
	</script>
	{/literal}
</head>

<!-- the 'special-page' class is only an identifier for scripts -->
<body class="special-page error-bg red dark">
<!-- The template uses conditional comments to add wrappers div for ie8 and ie7 - just add .ie or .ie7 prefix to your css selectors when needed -->
<!--[if lt IE 9]><div class="ie"><![endif]-->
<!--[if lt IE 8]><div class="ie7"><![endif]-->
	
	<section id="error-desc">
		
		<ul class="action-tabs with-children-tip children-tip-left">
			<li><a href="javascript:history.back()" title="Go back"><img src="include/images/icons/fugue/navigation-180.png" width="16" height="16"></a></li>
			<li><a href="javascript:window.location.reload()" title="Reload page"><img src="include/images/icons/fugue/arrow-circle.png" width="16" height="16"></a></li>
		</ul>
		
		<ul class="action-tabs right with-children-tip children-tip-right">
			<li><a href="#" title="Show/hide<br>error details" onClick="$(document.body).toggleClass('with-log'); return false;">
				<img src="include/images/icons/fugue/application-monitor.png" width="16" height="16">
			</a></li>
		</ul>
		
		<div class="block-border"><div class="block-content">
				
			<h1>Admin</h1>
			<div class="block-header">System error</div>
			
			<h2>Error description</h2>
			
			<h5>Message</h5>
			<p>{$mensagem}</p>
			
			<p><b>Event type:</b> error<br>
			<b>Page:</b> {$arquivo}</p>
			
			<form class="form" id="send-report" method="post" action="sendReport.html">
				<fieldset class="grey-bg no-margin collapse">
					<legend><a href="#">Report error</a></legend>
					
					<p>
						<label for="description" class="light float-left">To report this error, please explain how it happened and click below:</label>
						<textarea name="description" id="description" class="full-width" rows="4"></textarea>
					</p>
					
					<p>
						<label for="report-sender" class="grey">Your e-mail address (optional)</label>
						<span class="float-left"><button type="submit" class="full-width">Report</button></span>
						<input type="text" name="sender" id="sender" value="" class="full-width">
					</p>
				</fieldset>
			</form>
		</div></div>
	</section>
	
	<section id="error-log">
		<div class="block-border"><div class="block-content">
				
			<h1>Error in {$classe}</h1>
			
			<div class="fieldset grey-bg with-margin">
				<p><b>Message</b><br>
				Undefined variable: test</p>
			</div>
			
			<ul class="picto-list">
				<li class="icon-tag-small"><b>Php error level:</b> 256</li>
				<li class="icon-doc-small"><b>File:</b> {$arquivo}</li>
				<li class="icon-pin-small"><b>Line:</b> 51</li>
			</ul>
			
			<ul class="collapsible-list with-bg">
				<li class="close">
					<b class="toggle"></b>
					<span><b>Context:</b></span>
					<ul class="with-icon no-toggle-icon">
						<li class="close">
							<b class="toggle"></b>

							<span><b>$options:</b> array(5)</span>
							<ul>
								<li><span><b>'id_user':</b> 42</span></li>
								<li><span><b>'logged':</b> false</span></li>

								<li class="close">
									<b class="toggle"></b>
									<span><b>'groups':</b> array(3)</span>
									<ul>
										<li><span><b>0:</b> 4</span></li>
										<li><span><b>1:</b> 5</span></li>

										<li><span><b>2:</b> 12</span></li>
									</ul>
								</li>
								<li><span><b>'resetPassword':</b> false</span></li>
								<li><span><b>'mail':</b> 'name@domaine.com'</span></li>
							</ul>
						</li>
						<li><span><b>$i:</b> 12</span></li>
						<li><span><b>$id_user:</b> 42</span></li>
					</ul>
				</li>
			</ul>
			
			<h2>Stack backtrace</h2>
			<ul class="picto-list icon-top with-line-spacing">
				<li>{$pilha}</li>				
			</ul>
			
		</div></div>
	</section>

<!--[if lt IE 8]></div><![endif]-->
<!--[if lt IE 9]></div><![endif]-->
</body>
</html>
