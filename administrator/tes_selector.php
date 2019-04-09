<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<table id="myTable">
  <thead>
    <tr>
      <th>Id</th>
      <th>DB update</th>
      <th>Checker</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>gdt</td>
      <td>Hilmi</td>
	  <td>banget</td>
      <td><input type="checkbox" id="foo1" /><label for="foo1">Foo1</label></td>
    </tr>
    <tr>
      <td>krs</td>
      <td>Agi</td>
	  <td>pas</td>
      <td><input type="checkbox" id="foo2" /><label for="foo2">Foo2</label></td>
    </tr>
    <tr>
      <td>sdg</td>
      <td>dayat</td>
	  <td>orkes</td>
      <td><input type="checkbox" id="foo3" /><label for="foo3">Foo3</label></td>
    </tr>
    <tr>
      <td>cwe</td>
      <td>Aning</td>
	  <td>tes</td>
      <td><input type="checkbox" id="foo4" /><label for="foo4">Foo4</label></td>
    </tr>
  </tbody>
</table>

<br /><br /><br />
<input type="text" id="lbltes" value="" />

<button id="test">Get checked IDs</button>


<script type="text/javascript">
	$('#test').on('click', function() {
	  var updates = [];
	  var selector = '#myTable tr input:checked'; 
	  $.each($(selector), function(idx, val) {
		var id = $(this).parent().siblings(":first").text();
		var update = $(this).parent().siblings(":first").next().text();
		var update2 = $(this).parent().siblings(":first").next().next().text();
		updates.push({id: id, update: update, update2: update2});
		
		$("#lbltes").val(update);
	  });
	  
	  // test values
	  console.log(JSON.stringify(updates));
	  
	  
	  
	  // post to DB - fill in your details
	  //$.ajax({
	  //  url: 'your_script.php',
	  //  type: 'post',
	  //  data: updates,
	  //  success: function() {
	  //    alert('done');
	  //  }
	  //});
	});
</script>