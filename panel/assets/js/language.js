$('#genel').on('click', function() {
    if($(".language_select").val() === "2")
    {
        $(".language_select").val("1");
    }
});
   
if($(".language_select").val() === "2")
{
    $(".en_container").addClass("in active");
    $(".tr_container").removeClass("in active")
}

   $(".language_select").change(function(){
        if($(this).val() === "1")
        {
            $(".tr_container").addClass("in active");
            $(".en_container").removeClass("in active")
            
        }
        else if($(this).val() === "2")
        {
            $(".en_container").addClass("in active");
            $(".tr_container").removeClass("in active")
        }
    })
 
