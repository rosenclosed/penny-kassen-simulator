$(".penny-btn").click(function() { //This will attach the function to all the input elements
    alert($(this).attr('id')); //This will grab the id of the element and alert. Although $(this).id also work, I like this way.
 });