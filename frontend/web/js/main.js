$.mask.definitions['9'] = false;
$.mask.definitions['5'] = "[0-9]";
$("#phoneNumber1").mask("+998(55) 555-55-55");
$("#phoneNumber2").mask("+998(55) 555-55-55");
$("#phoneNumber3").mask("+998(55) 555-55-55");


function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
$( "#datepicker1" ).datepicker({

});
$( "#datepicker1" ).datepicker({

});
