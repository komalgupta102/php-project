var width = 100,
    perfData = window.performance.timing, // The PerformanceTiming interface represents timing-related performance information for the given page.
    EstimatedTime = -(perfData.loadEventEnd - perfData.navigationStart),
    time = parseInt((EstimatedTime/1000)%60)*100;
    
// Percentage Increment Animation
var PercentageID = $("#percent1"),
		start = 0,
		end = 100,
		durataion = time;
		animateValue(PercentageID, start, end, durataion);
		
function animateValue(id, start, end, duration) {
  
	var range = end - start,
      current = start,
      increment = end > start? 1 : -1,
      stepTime = Math.abs(Math.floor(duration / range)),
      obj = $(id);
    
	var timer = setInterval(function() {
		current += increment;
		$(obj).text(current + "%");
		$("#bar1").css('width', current+"%");
      //obj.innerHTML = current;
		if (current == end) {
			clearInterval(timer);
		}
	}, stepTime);
}

// Fading Out Loadbar on Finised
setTimeout(function(){
  $('.pre-loader').fadeOut(300);
}, time);

//Delete blog
 $('.delete-blog').click(function(){
   var el = this;
  
   // Delete id
   var deleteid = $(this).data('id');
   var confirmalert = confirm("Are you sure?");
   if (confirmalert == true) {
      // AJAX Request
      $.ajax({
        url: 'process/blog-process.php',
        type: 'POST',
        data: { id:deleteid, action: 'delete' },
        success: function(response){
          if(response){
	    	// Remove row from HTML Table
	    	$(el).closest('tr').css('background','tomato');
	    	$(el).closest('tr').fadeOut(800,function(){
	       		$(this).remove();
	    	});
          }
        }
      });
   }
 });