$(function () {

    $field = $('input.datepicker');
    $field.datetimepicker({"formatter": "js", "format": "dd-mm-yyyy", "startView": "month", "minView": "month", "todayBtn": "true", "todayHighlight": "true", "autoclose": "true", "language": "en"});

    $field = $('input.datetimepicker');
    $field.datetimepicker({"formatter": "js", "format": "yyyy-mm-dd HH:ii:ss", "startView": "month", "minView": "hour", "todayBtn": "true", "todayHighlight": "true", "autoclose": "true", "language": "en"});

    $(".iconselector").change(function () {
        $iconHolder = $(this).next('#iconholder');
        console.log($iconHolder);
        if ($iconHolder.length === 0) {
            $(this).parent().append("<i id='iconholder'></i>");
        }
        $("#iconholder").attr("class", "fa fa-" + $(this).val());
    });
    $(".mask").inputmask();
    $(".phonemask").inputmask("phone", {
        url: "/bundles/app/thirdparty/phone-codes/phone-codes.json",
        onKeyValidation: function () { //show some metadata in the console
            //console.log($(this).inputmask("getmetadata")["name_en"]);
        }
    });
    $(".capitalize").on('keyup', function () {
        $v = $(this).val();
        $v = $v.charAt(0).replace(/^ı/g, 'I') + $v.slice(1);
        $(this).val($v.replace(/^(.)|\s(.)/g, function ($1) {
            return $1.toUpperCase();
        }));

    });
});