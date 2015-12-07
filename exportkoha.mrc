<!DOCTYPE html>
<html lang="en">
<head>

<title>Koha &rsaquo; Tools &rsaquo; MARC export</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="shortcut icon" href="/intranet-tmpl/prog/img/favicon.ico" type="image/x-icon" />
<link rel="stylesheet" type="text/css" href="/intranet-tmpl/lib/jquery/jquery-ui.css" />
<link rel="stylesheet" type="text/css" href="/intranet-tmpl/lib/bootstrap/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" media="print" href="/intranet-tmpl/prog/en/css/print.css" />


    <link rel="stylesheet" type="text/css" href="/intranet-tmpl/prog/en/css/staff-global.css" />


<!-- local colors -->




<script type="text/javascript" src="/intranet-tmpl/lib/jquery/jquery.js"></script>
<script type="text/javascript" src="/intranet-tmpl/lib/jquery/jquery-ui.js"></script>
<script type="text/javascript" src="/intranet-tmpl/lib/shortcut/shortcut.js"></script>
<script type="text/javascript" src="/intranet-tmpl/lib/jquery/plugins/jquery.cookie.min.js"></script>
<script type="text/javascript" src="/intranet-tmpl/lib/jquery/plugins/jquery.highlight-3.js"></script>
<script type="text/javascript" src="/intranet-tmpl/prog/en/lib/jquery/plugins/jquery.qtip.js"></script>
<script type="text/javascript" src="/intranet-tmpl/lib/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="/intranet-tmpl/lib/jquery/plugins/jquery.validate.min.js"></script>



<!-- koha core js -->
<script type="text/javascript" src="/intranet-tmpl/prog/en/js/staff-global.js"></script>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){
    jQuery.extend(jQuery.validator.messages, {
        required: _("This field is required."),
        remote: _("Please fix this field."),
        email: _("Please enter a valid email address."),
        url: _("Please enter a valid URL."),
        date: _("Please enter a valid date."),
        dateISO: _("Please enter a valid date (ISO)."),
        number: _("Please enter a valid number."),
        digits: _("Please enter only digits."),
        equalTo: _("Please enter the same value again."),
        maxlength: $.validator.format(_("Please enter no more than {0} characters.")),
        minlength: $.validator.format(_("Please enter at least {0} characters.")),
        rangelength: $.validator.format(_("Please enter a value between {0} and {1} characters long.")),
        range: $.validator.format(_("Please enter a value between {0} and {1}.")),
        max: $.validator.format(_("Please enter a value less than or equal to {0}.")),
        min: $.validator.format(_("Please enter a value greater than or equal to {0}."))
    });
});
//]]>
</script>



<script type="text/javascript">
    //<![CDATA[
        var MSG_BASKET_EMPTY = _("Your cart is currently empty");
        var MSG_RECORD_IN_BASKET = _("This item is already in your cart");
        var MSG_RECORD_ADDED = _("This item has been added to your cart");
        var MSG_NRECORDS_ADDED = _(" item(s) added to your cart");
        var MSG_NRECORDS_IN_BASKET = _("already in your cart");
        var MSG_NO_RECORD_SELECTED = _("No item was selected");
        var MSG_NO_RECORD_ADDED = _("No item was added to your cart");
        var MSG_CONFIRM_DEL_BASKET = _("Are you sure you want to empty your cart?");
        var MSG_CONFIRM_DEL_RECORDS = _("Are you sure you want to remove the selected items?");
        var MSG_IN_YOUR_CART = _("Items in your cart: ");
        var MSG_NON_RESERVES_SELECTED = _("One or more selected items cannot be reserved.");
    //]]>
    </script>
<script type="text/javascript" src="/intranet-tmpl/prog/en/js/basket.js"></script>


<script type="text/javascript" src="/intranet-tmpl/prog/en/js/localcovers.js"></script>
<script type="text/javascript">
//<![CDATA[
var NO_LOCAL_JACKET = _("No cover image available");
//]]>
</script>


<script type="text/javascript">
//<![CDATA[

var debug    = "";
var dformat  = "us";
var sentmsg = 0;
if (debug > 1) {alert("dateformat: " + dformat + "\ndebug is on (level " + debug + ")");}

function Date_from_syspref(dstring) {
        var dateX = dstring.split(/[-/]/);
        if (debug > 1 && sentmsg < 1) {sentmsg++; alert("Date_from_syspref(" + dstring + ") splits to:\n" + dateX.join("\n"));}
        if (dformat === "iso") {
                return new Date(dateX[0], (dateX[1] - 1), dateX[2]);  // YYYY-MM-DD to (YYYY,m(0-11),d)
        } else if (dformat === "us") {
                return new Date(dateX[2], (dateX[0] - 1), dateX[1]);  // MM/DD/YYYY to (YYYY,m(0-11),d)
        } else if (dformat === "metric") {
                return new Date(dateX[2], (dateX[1] - 1), dateX[0]);  // DD/MM/YYYY to (YYYY,m(0-11),d)
        } else {
                if (debug > 0) {alert("KOHA ERROR - Unrecognized date format: " +dformat);}
                return 0;
        }
}

/* Instead of including multiple localization files as you would normally see with
   jQueryUI we expose the localization strings in the default configuration */
jQuery(function($){
    $.datepicker.regional[''] = {
        closeText: _("Done"),
        prevText: _("Prev"),
        nextText: _("Next"),
        currentText: _("Today"),
        monthNames: [_("January"),_("February"),_("March"),_("April"),_("May"),_("June"),
        _("July"),_("August"),_("September"),_("October"),_("November"),_("December")],
        monthNamesShort: [_("Jan"), _("Feb"), _("Mar"), _("Apr"), _("May"), _("Jun"),
        _("Jul"), _("Aug"), _("Sep"), _("Oct"), _("Nov"), _("Dec")],
        dayNames: [_("Sunday"), _("Monday"), _("Tuesday"), _("Wednesday"), _("Thursday"), _("Friday"), _("Saturday")],
        dayNamesShort: [_("Sun"), _("Mon"), _("Tue"), _("Wed"), _("Thu"), _("Fri"), _("Sat")],
        dayNamesMin: [_("Su"),_("Mo"),_("Tu"),_("We"),_("Th"),_("Fr"),_("Sa")],
        weekHeader: _("Wk"),
        dateFormat: "mm/dd/yy",
        firstDay: 0,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''};
    $.datepicker.setDefaults($.datepicker.regional['']);
});

$(document).ready(function(){

$.datepicker.setDefaults({
        showOn: "both",
        changeMonth: true,
        changeYear: true,
        buttonImage: '/intranet-tmpl/prog/img/famfamfam/silk/calendar.png',
        buttonImageOnly: true,
        showButtonPanel: true,
        showOtherMonths: true,
        selectOtherMonths: true
    });

    $( ".datepicker" ).datepicker();
    // http://jqueryui.com/demos/datepicker/#date-range
    var dates = $( ".datepickerfrom, .datepickerto" ).datepicker({
        changeMonth: true,
        numberOfMonths: 1,
        onSelect: function( selectedDate ) {
            var option = this.id == "from" ? "minDate" : "maxDate",
                instance = $( this ).data( "datepicker" );
                date = $.datepicker.parseDate(
                    instance.settings.dateFormat ||
                    $.datepicker._defaults.dateFormat,
                    selectedDate, instance.settings );
            dates.not( this ).datepicker( "option", option, date );
        }
    });
});
//]]>
</script>

<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
    $('#exporttype').tabs();
});
//]]>
</script>
</head>
<body id="tools_export" class="tools">
    <div id="header" class="navbar navbar-static-top">
        <div class="navbar-inner">
            <ul id="toplevelmenu" class="nav">
                <li><a href="/cgi-bin/koha/circ/circulation-home.pl">Circulation</a></li>
                <li><a href="/cgi-bin/koha/members/members-home.pl">Patrons</a></li>
                <li><a href="/cgi-bin/koha/catalogue/search.pl">Search</a></li>
                
                    <li><a href="#" id="cartmenulink">Cart<span id="basketcount"></span></a></li>
                
                
                <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">More <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                            <li><a href="/cgi-bin/koha/virtualshelves/shelves.pl">Lists</a></li>
                            
                            <li><a href="/cgi-bin/koha/cataloguing/addbooks.pl">Cataloging</a></li>
                            
                            
                            <li><a href="/cgi-bin/koha/acqui/acqui-home.pl">Acquisitions</a></li>
                            
                            <li><a href="/cgi-bin/koha/authorities/authorities-home.pl">Authorities</a></li>
                            
                            
                            
                            
                            <li><a href="/cgi-bin/koha/tools/tools-home.pl">Tools</a></li>
                            
                            
                            <li><a href="/cgi-bin/koha/admin/admin-home.pl">Administration</a></li>
                            
                            <li><a href="/cgi-bin/koha/about.pl">About Koha</a></li>
                            </ul>
                </li>
            </ul>
      <ul class="nav pull-right">
        <li class="dropdown">
          <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">
           
              <span class="loggedinusername">
                  bibhuti
              </span>
              <span class="separator">|</span>
              
                <strong>
                  
                     Ashoka University Library
                  
                </strong>
              
              <b class="caret"></b>
          </a>
          <ul class="dropdown-menu" role="menu" aria-labelledby="drop3">
           
                  <li>
                     <a class="toplinks" href="/cgi-bin/koha/circ/selectbranchprinter.pl">Set library</a>
                  </li>
           
              <li>
                  <a id="logout" class="toplinks" href="/cgi-bin/koha/mainpage.pl?logout.x=1">Log out</a>
              </li>
           
          </ul>
          <li>
         <a class="toplinks" href="/cgi-bin/koha/help.pl" id="helper">Help</a>
          </li>
        </li>
      </ul>
       </div>
   </div>
<div id="cartDetails">Your cart is empty.</div>
</div>

<div class="gradient">
<h1 id="logo"><a href="/cgi-bin/koha/mainpage.pl">Ashoka University Library</a></h1><!-- Begin Catalogue Resident Search Box -->
<div id="header_search">

<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){
    $( "#findborrower" ).autocomplete({
        source: "/cgi-bin/koha/circ/ysearch.pl",
        minLength: 3,
        select: function( event, ui ) {
            $( "#findborrower" ).val( ui.item.cardnumber );
            $("#patronsearch").submit();
            return false;
        }
    })
    .data( "autocomplete" )._renderItem = function( ul, item ) {
        return $( "<li></li>" )
        .data( "item.autocomplete", item )
        .append( "<a>" + item.surname + ", " + item.firstname + " (" + item.cardnumber + ") <small>" + item.address + " " + item.city + " " + item.zipcode + " " + item.country + "</small></a>" )
        .appendTo( ul );
    };

});
//]]>
</script>
    <div id="circ_search" class="residentsearch">
    <p class="tip">Enter patron card number or partial name:</p>
    <form action="/cgi-bin/koha/circ/circulation.pl" id="patronsearch" method="post">
    
    <div class="autocomplete">
                <input autocomplete="off" id="findborrower" name="findborrower" size="40" class="focus" type="text" /> <input id="autocsubmit" type="submit" class="submit" value="Submit" />
                <input name="branch" value="" type="hidden" />
                <input name="printer" value="" type="hidden" />
            
        </div>
	
    </form>
	</div>
	



<div id="checkin_search" class="residentsearch">
    <p class="tip">Scan a barcode to check in:</p>
    <form method="post" action="/cgi-bin/koha/circ/returns.pl" autocomplete="off">
        <input name="barcode" id="ret_barcode" size="40" />
        <input value="Submit" class="submit" type="submit" />
    </form>
</div>
	
	
	<div id="catalog_search" class="residentsearch">
	<p class="tip">Enter search keywords:</p>
		<form action="/cgi-bin/koha/catalogue/search.pl"  method="get" id="cat-search-block">
			 <input type="text" name="q" id="search-form" size="40" value="" title="Enter the terms you wish to search for." class="form-text" />
				<input type="submit" class="submit" value="Submit" />
		</form>
	</div>
	
	
			<ul>
            <li><a href="#circ_search">Check out</a></li>
    <li><a href="#checkin_search">Check in</a></li>
            <li class="ui-tabs-selected"><a href="#catalog_search">Search the catalog</a></li>
			</ul>	
</div><!-- /header_search -->
</div><!-- /gradient -->
<!-- End Catalogue Resident Search Box -->


<div id="breadcrumbs"><a href="/cgi-bin/koha/mainpage.pl">Home</a> &rsaquo; <a href="/cgi-bin/koha/tools/tools-home.pl">Tools</a> &rsaquo; MARC export</div>

<div id="doc3" class="yui-t2">
   
   <div id="bd">
	<div id="yui-main">
	<div class="yui-b">

<div id="exporttype" class="toptabs">
<ul>
<li><a href="#bibs">Export bibliographic records</a></li>
<li><a href="#auths">Export authority records</a></li>


</ul>
<div id="bibs">
<p>
    <b>Note : The items are exported by this tool unless specified.</b>
</p>

<form method="post" action="/cgi-bin/koha/tools/export.pl">
    <fieldset class="rows">
    <legend> Select records to export </legend>
        <ol><li>
            <label for="start">From biblio number: </label>
            <input id="start" type="text" name="StartingBiblionumber" size="5" />
        </li>
        <li>
            <label for="end">To biblio number: </label>
            <input id="end" type="text" name="EndingBiblionumber" size="5" />
        </li>
        
        <li>
            <label for="itemtype">Item type: </label>
            <select name="itemtype" id="itemtype">
                <option value="">-- All --</option>
                
				
                <option value="BK">Books</option>

                
				
                <option value="CD">CD/DVD</option>

                
				
                <option value="MP">Maps</option>

                
				
                <option value="MU">Music</option>

                
				
                <option value="REF">Reference</option>

                
            </select>
        </li>
        
        <li>
            <label for="branch">Library: </label>
            <select id="branch" name="branch">
            <option value="">-- All --</option>
                
                    
				<option value="ASHOKA">Ashoka University Library</option>
				
                    
                    
				<option value="ASHOKA-YIF">Ashoka University Library - YIF </option>
				
                    
                    
				<option value="01">National library</option>
				
                    
                    
				<option value="TEST">test1</option>
				
                    
                </select>
        </li>
        <li>
            <label for="startcn">From item call number: </label>
            <input id="startcn" type="text" name="start_callnumber" size="5" />
        </li>
        <li>
            <label for="endcn">To item call number: </label>
            <input id="endcn" type="text" name="end_callnumber" size="5" />
        </li>
	<li>Accession date (inclusive):
		<ul><li>
        <label for="from">Start date:</label>
        <input type="text" size="10" id="from" name="start_accession" value="" class="datepickerfrom" />
</li>
<li><label for="to">
    End date:
</label>
<input size="10" id="to" name="end_accession" value="" type="text" class="datepickerto" />
</li>
</ul></li></ol>
    </fieldset>
    <fieldset class="rows">
    <legend> Options</legend>
<ol>        <li>
        <label for="dont_export_item">Don't export items</label>
        <input id="dont_export_item" type="checkbox" name="dont_export_item" />
        </li>
        <li>
        <label for="strip_nonlocal_items">Remove non-local items</label>
        <input id="strip_nonlocal_items" type="checkbox" name="strip_nonlocal_items" />
        </li>
        <li>
        <label for="export_remove_fields">Don't export fields</label>
        <input id="export_remove_fields" type="text" name="export_remove_fields" value="" />
        separate by a blank. (e.g., 100a 200 606)
        </li></ol>
    </fieldset>
    <fieldset class="rows">
    <legend>
        Output format
    </legend>
        <ol><li>
            <label for="output_format">File format: </label>
            <select id="output_format" name="output_format">
                <option value="marc">marc</option>
                <option value="xml">xml</option>
            </select>
            
        </li>
        <li>
        <label for="filename">File name:</label><input id="filename" type="text" name="filename" value="koha.mrc" />
        </li></ol>
    </fieldset>
    <input type="hidden" name="op" value="export" />
    <input type="hidden" name="record_type" value="bibs" />

    <fieldset class="action"><input type="submit" value="Export bibliographic records" class="button" /></fieldset>
</form>
</div>

<div id="auths">
<form method="post" action="/cgi-bin/koha/tools/export.pl">
    <fieldset class="rows">
    <legend> Select records to export </legend>
        <ol><li>
            <label for="start">From authid: </label>
            <input id="start" type="text" name="starting_authid" size="6" />
        </li>
        <li>
            <label for="end">To authid: </label>
            <input id="end" type="text" name="ending_authid" size="6" />
        </li>
        <li>
            <label for="authtype">Authority type: </label>
            <select name="authtype" id="authtype">
                <option value="">-- All --</option>
                
                
                <option value="CHRON_TERM">Chronological Term</option>

                
                
                <option value="CORPO_NAME">Corporate Name</option>

                
                
                <option value="GENRE/FORM">Genre/Form Term</option>

                
                
                <option value="GEOGR_NAME">Geographic Name</option>

                
                
                <option value="MEETI_NAME">Meeting Name</option>

                
                
                <option value="PERSO_NAME">Personal Name</option>

                
                
                <option value="TOPIC_TERM">Topical Term</option>

                
                
                <option value="UNIF_TITLE">Uniform Title</option>

                
            </select>
        </li>
        </ol>
    </fieldset>
    <fieldset class="rows">
    <legend>Options</legend>
        <ol>
        <li>
            <label for="export_remove_fields">Don't export fields</label>
            <input id="export_remove_fields" type="text" name="export_remove_fields" />
            separate by a blank. (e.g., 100a 200 606)
        </li></ol>
    </fieldset>
    <fieldset class="rows">
    <legend>Output format</legend>
        <ol><li>
            <label for="output_format">File format: </label>
            <select id="output_format" name="output_format">
                <option value="marc">marc</option>
                <option value="xml">xml</option>
            </select>
        </li>
        <li>
        <label for="filename">File name:</label><input id="filename" type="text" name="filename" value="koha.mrc" />
        </li></ol>
    </fieldset>
    <input type="hidden" name="op" value="export" />
    <input type="hidden" name="record_type" value="auths" />

    <fieldset class="action"><input type="submit" value="Export authority records" class="button" /></fieldset>
</form>
</div>





</div>

</div>
</div>
<div class="yui-b noprint">
<script type="text/javascript">//<![CDATA[
    $(document).ready(function() {
        var path = location.pathname.substring(1);
        var url = window.location.toString();
        var params = '';
        if ( url.match(/\?(.+)$/) ) {
            params = "?" + RegExp.$1;
        }
        $('#navmenulist a[href$="/' + path + params + '"]').css('font-weight','bold');
    });
//]]>
</script>
<div id="navmenu">
<div id="navmenulist">
<ul>
    <li><a href="/cgi-bin/koha/tools/tools-home.pl">Tools home</a></li>
</ul>
<h5>Patrons and circulation</h5>
<ul>
    
	<li><a href="/cgi-bin/koha/patron_lists/lists.pl">Patron lists</a></li>
    
    
	<li><a href="/cgi-bin/koha/reviews/reviewswaiting.pl">Comments</a></li>
    
    
	<li><a href="/cgi-bin/koha/tools/import_borrowers.pl">Import patrons</a></li>
    
    
    <li><a href="/cgi-bin/koha/tools/letter.pl">Notices &amp; slips</a></li>
    
    
	<li><a href="/cgi-bin/koha/tools/overduerules.pl">Overdue notice/status triggers</a></li>
    
    
    <li><a href="/cgi-bin/koha/patroncards/home.pl">Patron card creator</a></li>
    
    
    <li><a href="/cgi-bin/koha/tools/cleanborrowers.pl">Batch patron deletion/anonymization</a></li>
    
    
    <li><a href="/cgi-bin/koha/tools/modborrowers.pl">Batch patron modification</a></li>
    
    
    <li><a href="/cgi-bin/koha/tags/review.pl">Tag moderation</a></li>
    
    
	<li><a href="/cgi-bin/koha/tools/picture-upload.pl">Upload patron images</a></li>
    
</ul>
<h5>Catalog</h5>
<ul>
    
	<li><a href="/cgi-bin/koha/tools/batchMod.pl?del=1">Batch item deletion</a></li>
    
    
	<li><a href="/cgi-bin/koha/tools/batchMod.pl">Batch item modification</a></li>
    
    
    <li><a href="/cgi-bin/koha/tools/export.pl">Export data</a></li>
    
    
	<li><a href="/cgi-bin/koha/tools/inventory.pl">Inventory/stocktaking</a></li>
    
    
	<li><a href="/cgi-bin/koha/labels/label-home.pl">Label creator</a></li>
	<li><a href="/cgi-bin/koha/labels/spinelabel-home.pl">Quick spine label creator</a></li>
    
<!--
    
    <li><a href="/cgi-bin/koha/rotating_collections/rotatingCollections.pl">Rotating collections</a></li>
    
-->
    
        <li><a href="/cgi-bin/koha/tools/marc_modification_templates.pl">Manage MARC modification templates</a></li>
    
    
	<li><a href="/cgi-bin/koha/tools/stage-marc-import.pl">Stage MARC for import</a></li>
    
    
	<li><a href="/cgi-bin/koha/tools/manage-marc-import.pl">Staged MARC management</a></li>
    
    
    <li><a href="/cgi-bin/koha/tools/upload-cover-image.pl">Upload local cover image</a></li>
    
</ul>
<h5>Additional tools</h5>
<ul>
    
	<li><a href="/cgi-bin/koha/tools/holidays.pl">Calendar</a></li>
    
    
	<li><a href="/cgi-bin/koha/tools/csv-profiles.pl">CSV profiles</a></li>
    
    
	<li><a href="/cgi-bin/koha/tools/viewlog.pl">Log viewer</a></li>
    
    
	<li><a href="/cgi-bin/koha/tools/koha-news.pl">News</a></li>
    
    
	<li><a href="/cgi-bin/koha/tools/scheduler.pl">Task scheduler</a></li>
    
    
       <li><a href="/cgi-bin/koha/tools/quotes.pl">Quote editor</a></li>
    
</ul></div></div>

</div>
</div>
        </div>


    </body>
</html>

