jQuery(document).ready(function() {

    /*  smartbanner App Store alert 
        -------------------------------------------------- */
    setInterval(function(){
        jQuery.smartbanner({
            title: 'Bank Midwest Mobile App',
            speedIn: 500,
            speedOut: 500
        });
    }, 2000 );
    
    /*
    $.smartbanner({
      title: null, // What the title of the app should be in the banner (defaults to <title>)
      author: null, // What the author of the app should be in the banner (defaults to <meta name="author"> or hostname)
      price: 'FREE', // Price of the app
      appStoreLanguage: 'us', // Language code for App Store
      inAppStore: 'On the App Store', // Text of price for iOS
      inGooglePlay: 'In Google Play', // Text of price for Android
      inAmazonAppStore: 'In the Amazon Appstore',
      inWindowsStore: 'In the Windows Store', // Text of price for Windows
      GooglePlayParams: null, // Aditional parameters for the market
      icon: null, // The URL of the icon (defaults to <meta name="apple-touch-icon">)
      iconGloss: null, // Force gloss effect for iOS even for precomposed
      url: null, // The URL for the button. Keep null if you want the button to link to the app store.
      button: 'VIEW', // Text for the install button
      scale: 'auto', // Scale based on viewport size (set to 1 to disable)
      speedIn: 300, // Show animation speed of the banner
      speedOut: 400, // Close animation speed of the banner
      daysHidden: 15, // Duration to hide the banner after being closed (0 = always show banner)
      daysReminder: 90, // Duration to hide the banner after "VIEW" is clicked *separate from when the close button is clicked* (0 = always show banner)
      force: null, // Choose 'ios', 'android' or 'windows'. Don't do a browser check, just always show this banner
      hideOnInstall: true, // Hide the banner after "VIEW" is clicked.
      layer: false, // Display as overlay layer or slide down the page
      iOSUniversalApp: true // If the iOS App is a universal app for both iPad and iPhone, display Smart Banner to iPad users, too.      
      appendToSelector: 'body' //Append the banner to a specific selector
    })
*/

    
    /*  mobile ancillary menu drop down
    -------------------------------------------------- */
    
    function expand_ancillary_subMenu(e){
        e.preventDefault();
        var $this = $(this);
        
        if($this.hasClass('active')){
            $('.ancillary-menu-trigger').removeClass('active');
            $('.mobile-sub-menus .sub-menu').hide();
            
        } else { 
           // remove any 'active' classes floating around
           // hide any other ancillary menus that are open
           // open the menu
           $('.ancillary-menu-trigger').removeClass('active');
           $('.mobile-sub-menus .sub-menu').hide();
           if($this.is('#about')){
               $('.sub-menu.about').show();
               $this.addClass('active');
           }
           if($this.is('#help')){
               $('.sub-menu.help').show();
               $this.addClass('active');
            }
        }
    }
    
    jQuery('body').on( 'click', '.ancillary-menu-trigger', expand_ancillary_subMenu );
    //$(".ancillary-menu-trigger'").click(expand_ancillary_subMenu);
   
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
	});


	$('#nav > ul li a').click( function(event) {
		
		var id = $(this).attr('id');

		event.preventDefault(); 
		$(this).parents('li').siblings().find('a').removeClass('active');
		$(this).toggleClass('active');
		$('#nav .subpages ul.' + id).siblings().removeClass('active');
		$('#nav .subpages ul.' + id).toggleClass('active');
	});

	$('#nav ul li a.hidemenu').click( function(event){
		event.preventDefault(); 

		$('#nav .subpages ul, #nav > ul li a').removeClass('active');
	});

});


function tamingselect()
{
  if(!document.getElementById && !document.createTextNode){return;}
  
// Classes for the link and the visible dropdown
  var ts_selectclass='turnintodropdown';  // class to identify selects
  var ts_listclass='turnintoselect';    // class to identify ULs
  var ts_boxclass='dropcontainer';    // parent element
  var ts_triggeron='activetrigger';     // class for the active trigger link
  var ts_triggeroff='trigger';      // class for the inactive trigger link
  var ts_dropdownclosed='dropdownhidden'; // closed dropdown
  var ts_dropdownopen='dropdownvisible';  // open dropdown
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
        
        // $('html, body').animate({
        //       scrollTop: ($('#move-here').offset().top)
        //   },1000);
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
        //  this.elm.value=this.v;
        //  return false;
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
      //  window.location=this.options[this.selectedIndex].value;
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
