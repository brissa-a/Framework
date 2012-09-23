jQuery(document).ready(function () {
	$("#listAccount").jqGrid({
	    url:'ajax.php?a=jqgridListAccount',
	    datatype: 'xml',
	    mtype: 'POST',
	    colNames:['nom', 'prenom','e-mail', 'inscription'],
	    colModel :[ 
	      {name:'familyName', index:'familyName', align:'center'}, 
	      {name:'fristName', index:'fristName', align:'center'}, 
	      {name:'email', index:'email', align:'center'}, 
	      {name:'insciption', index:'subscribeDate', align:'center'},
	    ],
	    pager: '#pager',
	    rowNum:10,
	    sortname: 'id',
	    sortorder: 'desc',
	    viewrecords: true,
	    gridview: true,
	    autowidth: true,
	    height: 'auto',
	    caption: 'Liste des membres inscrits',
	  }); 
});
