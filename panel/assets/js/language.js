$('#genel').on('click', function() {
    if($(".language_select").val() === "2")
    {
        $(".language_select").val("1");
    }
});
$(".EN_container").removeClass("in active")  
if($(".language_select").val() === "2")
{
    $(".EN_container").addClass("in active");
    $(".TR_container").removeClass("in active")
}

   $(".language_select").change(function(){
        if($(this).val() === "1")
        {
            $(".TR_container").addClass("in active");
            $(".EN_container").removeClass("in active")
            
        }
        else if($(this).val() === "2")
        {
            $(".EN_container").addClass("in active");
            $(".TR_container").removeClass("in active")
        }
    })
 
