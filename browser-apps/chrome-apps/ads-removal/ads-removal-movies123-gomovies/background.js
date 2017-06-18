// content.js
/*
chrome.runtime.onMessage.addListener(
  function(request, sender, sendResponse) {
    if( request.message === "clicked_browser_action" ) {
      var firstHref = $("a[href^='http']").eq(0).attr("href");

      console.log(firstHref);

      // This line is new!
      chrome.runtime.sendMessage({"message": "open_new_tab", "url": firstHref});
    }
  }
);
*/
	/*
$(function() {

	setTimeout(function() {
			var objPerson = {
				webflow_count: 0,
				hubspot_count: 2,
				test: function(){
					$(".layout-editor .row-fluid:nth-child(" + ++this.hubspot_count + ") .layout-cell-inner a.settings-icon").click();
					var od_webflow = $('.w-section[od-data-id="' + ++this.webflow_count +'"]').find('.w-container').html();
					$('ul.hs-button-items li[data-subview-key="edit_options"] a').click(); 
					setTimeout(function() { 
					   $('iframe').contents().find("body#tinymce").html(od_webflow); 
					   setTimeout(function() { $(".vex-overlay .actions a.hs-button:first-child").click(); }, 1500);
					 }, 1000);
					}
			};
			setInterval($.proxy(objPerson, "test"), 5000);
		
	}, 10000);
});
*/