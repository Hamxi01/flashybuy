    $(function () {
        $("#firstname").keypress(function (e) {
            var keyCode = e.keyCode || e.which;
 
            $("#lblError").html("");
 
            //Regex for Valid Characters i.e. Alphabets.
            var regex = /^[A-Za-z]+$/;
 
            //Validate TextBox value against the Regex.
            var isValid = regex.test(String.fromCharCode(keyCode));
            if (!isValid) {
                $("#lblError").html("Only Alphabets allowed.");
            }
 
            return isValid;
        });
    });



        $(function () {
        $("#lastname").keypress(function (e) {
            var keyCode = e.keyCode || e.which;
 
            $("#lastname").html("");
 
            //Regex for Valid Characters i.e. Alphabets.
            var regex = /^[A-Za-z]+$/;
 
            //Validate TextBox value against the Regex.
            var isValid = regex.test(String.fromCharCode(keyCode));
            if (!isValid) {
                $("#lastname").html("Only Alphabets allowed.");
            }
 
            return isValid;
        });
    });







$('#phone').mask('(999) 999-9999');


