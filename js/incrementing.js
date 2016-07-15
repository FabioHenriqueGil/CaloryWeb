$(function () {
//var produto = $(".numbers-row").getOwnPropertyNames();
   
    $(".numbers-row").append('<div class="dec button">-</div>');

    $(".button").on("click", function () {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();

        if ($button.text() === "-") {
            var newVal = 0;
        } else {
            var newVal = parseFloat(oldValue) + 1;
        }

        $button.parent().find("input").val(newVal);

    });

});