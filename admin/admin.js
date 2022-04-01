     function deleteUser(user_id) 
     {
			let tabel = document.getElementById('users')
					    .getElementsByTagName('tbody')[0];
			for (let i = 0; i < tabel.rows.length; i++) {
				tabel.rows[i].onclick = function() {
					TableRowClick(this, user_id);
				};
			}
     }

    function TableRowClick(benutzer, y) 
    {
			let msg = benutzer.cells[0].innerHTML;
			if (y == 1) {
				var r = confirm("Do you want to delete the user " + msg + "?");
				if (r != true) {
					msg = "cancel";
				}
				document.getElementById('user_id').value = msg;
			} else {
				document.getElementById('user_id').value = msg;
			}
		};

		