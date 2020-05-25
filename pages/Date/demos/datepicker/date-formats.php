<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>jQuery UI Datepicker - Format date</title>
	<link rel="stylesheet" href="../../themes/base/jquery.ui.all.css">
	<script src="../../jquery-1.9.1.js"></script>
	<script src="../../ui/jquery.ui.core.js"></script>
	<script src="../../ui/jquery.ui.widget.js"></script>
	<script src="../../ui/jquery.ui.datepicker.js"></script>

	<script>
	$(function() {
		$( "#dat" ).datepicker();
		
	});
	</script>
</head>
<body>


<label>Date</label><input class="form-control" type="date"   name="dat"  id="dat" style="width:100%;" >
<p>Format options:<br />
	<select id="format">
		<option value="mm/dd/yy">Default - mm/dd/yy</option>
		<option value="yy-mm-dd">ISO 8601 - yy-mm-dd</option>
		<option value="d M, y">Short - d M, y</option>
		<option value="d MM, y">Medium - d MM, y</option>
		<option value="DD, d MM, yy">Full - DD, d MM, yy</option>
		<option value="'day' d 'of' MM 'in the year' yy">With text - 'day' d 'of' MM 'in the year' yy</option>
	</select>
</p>

<div class="demo-description">
<p>Display date feedback in a variety of ways.  Choose a date format from the dropdown, then click on the input and select a date to see it in that format.</p>
</div>
</body>
</html>
