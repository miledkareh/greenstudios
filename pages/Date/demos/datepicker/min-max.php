<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>jQuery UI Datepicker - Restrict date range</title>
	<link rel="stylesheet" href="../../themes/base/jquery.ui.all.css">
	<script src="../../jquery-1.9.1.js"></script>
	<script src="../../ui/jquery.ui.core.js"></script>
	<script src="../../ui/jquery.ui.widget.js"></script>
	<script src="../../ui/jquery.ui.datepicker.js"></script>
	<link rel="stylesheet" href="../demos.css">
	<script>
	$(function() {
		$( "#datepicker" ).datepicker();
	});
	</script>
</head>
<body>

<p>Date: <input type="text" id="datepicker"></p>

<div class="demo-description">
<p>Restrict the range of selectable dates with the <code>minDate</code> and <code>maxDate</code> options.  Set the beginning and end dates as actual dates (new Date(2009, 1 - 1, 26)), as a numeric offset from today (-20), or as a string of periods and units ('+1M +10D').  For the last, use 'D' for days, 'W' for weeks, 'M' for months, or 'Y' for years.</p>
</div>
</body>
</html>
