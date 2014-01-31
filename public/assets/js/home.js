$(document).ready(function () {
	$("#business-list").dataTable({
		"aaSorting": [[ 5, "desc" ]],
		"fnRowCallback": function( nRow, aData, iDisplayIndex ) {
            /* Append the grade to the default row class name */
			var str = aData[0];
			$('td:eq(0)', nRow).html( '<a href="' + str + '">edit</a>' );
        },
        "aoColumnDefs": [ 
			{
                "sClass": "center",
                "aTargets": [ -1, -2 ]
			}, 
			{
                "bSortable": false,
                "aTargets": [ 0 ]
			}
		]
	});
});