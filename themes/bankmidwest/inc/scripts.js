jQuery(document).ready(function(jQuery) {

	var $=jQuery;

	/* Home Slider */
	$('#homeSlider').anythingSlider({
		buildNavigation:   false, 
		buildStartStop:    false,
		hashTags:          false,
		autoPlay: true,     // If true, the slideshow will start running; replaces "startStopped" option
		delay:             6000,
		animationTime:     950
	});

	$('#directory li a').hover(
		function() {
			$(this).parent('li').find('div.outer').show();
		}
		,function() {
			$(this).parent('li').find('div.outer').hide();

	});

	// $('ul.sidenav .current_page_parent a').click(function(event) {
	// 	event.preventDefault();
	// 	$(this).parent('li').find('.children').toggleClass('active');
	// });

	//uniform select styling
	if (!$.browser.opera) {
		$('select.select').each(function(){
			var title = $(this).attr('title');
			if( $('option:selected', this).val() != ''  ) title = $('option:selected',this).text();
			$(this)
			.css({'z-index':10,'opacity':0,'-khtml-appearance':'none'})
				.after('<span class="select">' + title + '</span>')
				.change(function(){
				val = $('option:selected',this).text();
				$(this).next().text(val);
			})
		});

	};

	//show/hide divs based on form option selection
	$('#login-select').change(function() {
		$('#login-content div').removeClass('active');
		$('#login-content div.' + $(this).val()).addClass('active');
	});

		$('.accordionButton').click(function(event){
			event.preventDefault(); 
			$(this).parent('.expand').find('div.accordionContent').slideToggle(); 
	})


	// all external links get new window icon
	$("#content a[href^='https:'], #content a[href^='http:']").not('#content a.noicon').not("[href*='bankmidwest.com']").not("[href*='flyinghippo.com']").not("[href*='sharefile.com']").after('<img src="/wp-content/themes/bankmidwest/images/external-link.png" width="11" height="11" alt="external link" class="external"/>');

	// all pdf have a pdf icon 
	$("#content a[href$='.pdf']").not('#content a.noicon').not("#content a[href^='https:'], #content a[href^='http:']").after('<img src="/wp-content/themes/bankmidwest/images/pdf-icon.png" width="12" height="12" alt="pdf link" class="pdf"/>');

	$('#nav > li').hover(function() {
		$(this).toggleClass('active');

	});

});


function tamingselect()
{
	if(!document.getElementById && !document.createTextNode){return;}
	
// Classes for the link and the visible dropdown
	var ts_selectclass='turnintodropdown'; 	// class to identify selects
	var ts_listclass='turnintoselect';		// class to identify ULs
	var ts_boxclass='dropcontainer'; 		// parent element
	var ts_triggeron='activetrigger'; 		// class for the active trigger link
	var ts_triggeroff='trigger';			// class for the inactive trigger link
	var ts_dropdownclosed='dropdownhidden'; // closed dropdown
	var ts_dropdownopen='dropdownvisible';	// open dropdown
/*
	Turn all selects into DOM dropdowns
*/
	var count=0;
	var toreplace=new Array();
	var sels=document.getElementsByTagName('select');
	for(var i=0;i<sels.length;i++){
		if (ts_check(sels[i],ts_selectclass))
		{
			var hiddenfield=document.createElement('input');
			hiddenfield.name=sels[i].name;
			hiddenfield.type='hidden';
			hiddenfield.id=sels[i].id;
			hiddenfield.value=sels[i].options[0].value;
			sels[i].parentNode.insertBefore(hiddenfield,sels[i])
			var trigger=document.createElement('a');
			ts_addclass(trigger,ts_triggeroff);
			trigger.href='#';
			trigger.onclick=function(){
				ts_swapclass(this,ts_triggeroff,ts_triggeron)
				ts_swapclass(this.parentNode.getElementsByTagName('ul')[0],ts_dropdownclosed,ts_dropdownopen);
				return false;
			}
			trigger.appendChild(document.createTextNode(sels[i].options[0].text));
			sels[i].parentNode.insertBefore(trigger,sels[i]);
			var replaceUL=document.createElement('ul');
			for(var j=0;j<sels[i].getElementsByTagName('option').length;j++)
			{
				var newli=document.createElement('li');
				var newa=document.createElement('a');
				newa.href = sels[i].getElementsByTagName('option')[j].value;
				//alert ( sels[i].getElementsByTagName('option')[j].value );
				newli.v=sels[i].getElementsByTagName('option')[j].value;
				newli.elm=hiddenfield;
				newli.istrigger=trigger;
				//newa.href='#';
				newa.appendChild(document.createTextNode(
				sels[i].getElementsByTagName('option')[j].text));
				// newli.onclick=function(){ 
				// 	this.elm.value=this.v;
				// 	return false;
				// }
				newli.appendChild(newa);
				replaceUL.appendChild(newli);
			}
			ts_addclass(replaceUL,ts_dropdownclosed);
			var div=document.createElement('div');
			div.appendChild(replaceUL);
			ts_addclass(div,ts_boxclass);
			sels[i].parentNode.insertBefore(div,sels[i])
			toreplace[count]=sels[i];
			count++;
		}
	}
	
/*
	Turn all ULs with the class defined above into dropdown navigations
*/	

	var uls=document.getElementsByTagName('ul');
	for(var i=0;i<uls.length;i++)
	{
		if(ts_check(uls[i],ts_listclass))
		{
			var newform=document.createElement('form');
			var newselect=document.createElement('select');
			for(j=0;j<uls[i].getElementsByTagName('a').length;j++)
			{
				var newopt=document.createElement('option');
				newopt.value=uls[i].getElementsByTagName('a')[j].href;	
				newopt.appendChild(document.createTextNode(uls[i].getElementsByTagName('a')[j].innerHTML));	
				newselect.appendChild(newopt);
			}
			// newselect.onchange=function()
			// {
			// 	window.location=this.options[this.selectedIndex].value;
			// }
			newform.appendChild(newselect);
			uls[i].parentNode.insertBefore(newform,uls[i]);
			toreplace[count]=uls[i];
			count++;
		}
	}
	for(i=0;i<count;i++){
		toreplace[i].parentNode.removeChild(toreplace[i]);
	}
	function ts_check(o,c)
	{
	 	return new RegExp('\\b'+c+'\\b').test(o.className);
	}
	function ts_swapclass(o,c1,c2)
	{
		var cn=o.className
		o.className=!ts_check(o,c1)?cn.replace(c2,c1):cn.replace(c1,c2);
	}
	function ts_addclass(o,c)
	{
		if(!ts_check(o,c)){o.className+=o.className==''?c:' '+c;}
	}
}

window.onload=function()
{
	tamingselect();
	// add more functions if necessary
}
