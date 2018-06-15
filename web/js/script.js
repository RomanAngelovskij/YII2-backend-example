function fillBootstrapSelect(element, data, value, label) {
    var options = '';

    $.each(data, function (index, car) {
        options += '<option value="' + car[value] + '">' + car[label] + '</option>';
    });
    console.log(options);
    $(element).html(options);

    $(element).selectpicker('refresh');
}

$(".datepicker-birthday").datepicker({
    changeMonth: true,
    changeYear: true,
    yearRange: parseInt((new Date()).getFullYear() - 60) + ':' + parseInt((new Date()).getFullYear() - 18),
    dateFormat: 'dd.mm.yy'
});

$(".datepicker-range").datepicker({
    changeMonth: true,
    changeYear: true,
    yearRange: '2017:' + parseInt((new Date()).getFullYear()),
    dateFormat: 'dd.mm.yy'
});

//WYSWYG editor
var HtmlEditorOptions = typeof customHtmlEditorOptions != 'undefined' ? customHtmlEditorOptions : {height: 250}
$('.html-editor').summernote(HtmlEditorOptions);

// Switchery toggle
var elems = Array.prototype.slice.call(document.querySelectorAll('.switchery'));
elems.forEach(function (html) {
    var switchery = new Switchery(html);
});

function number_format(number, decimals, dec_point, thousands_sep) {	// Format a number with grouped thousands
    //
    // +   original by: Jonas Raoni Soares Silva (http://www.jsfromhell.com)
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +	 bugfix by: Michael White (http://crestidg.com)

    var i, j, kw, kd, km;

    // input sanitation & defaults
    if (isNaN(decimals = Math.abs(decimals))) {
        decimals = 2;
    }
    if (dec_point == undefined) {
        dec_point = ",";
    }
    if (thousands_sep == undefined) {
        thousands_sep = ".";
    }

    i = parseInt(number = (+number || 0).toFixed(decimals)) + "";

    if ((j = i.length) > 3) {
        j = j % 3;
    } else {
        j = 0;
    }

    km = (j ? i.substr(0, j) + thousands_sep : "");
    kw = i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousands_sep);
    //kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).slice(2) : "");
    kd = (decimals ? dec_point + Math.abs(number - i).toFixed(decimals).replace(/-/, 0).slice(2) : "");


    return km + kw + kd;
}

$('.tags-input').tagsinput();
$(".switch").bootstrapSwitch();

$(document).ready(function () {
    /*
         * Datepicker init
         */
    $('.daterange-user-reg').daterangepicker({
            applyClass: 'bg-slate-600',
            cancelClass: 'btn-default',
            locale: {
                format: 'DD.MM.YYYY'
            }
        },
        function (start, end) {
            $('.daterange-user-reg span').html(start.format('DD.MM.YYYY') + ' &nbsp; - &nbsp; ' + end.format('DD.MM.YYYY'));
            $('#userStartRegDate').val(start.format('DD.MM.YYYY'));
            $('#userEndRegDate').val(end.format('DD.MM.YYYY'));
        });

    $('.daterange-worksheets-reg').daterangepicker({
            applyClass: 'bg-slate-600',
            cancelClass: 'btn-default',
            locale: {
                format: 'DD.MM.YYYY'
            }
        },
        function (start, end) {
            $('.daterange-worksheets-reg span').html(start.format('DD.MM.YYYY') + ' &nbsp; - &nbsp; ' + end.format('DD.MM.YYYY'));
            $('#worksheetStartUpdatedAt').val(start.format('DD.MM.YYYY'));
            $('#worksheetEndUpdatedAt').val(end.format('DD.MM.YYYY'));
        });

    /*$('.pickadate').pickadate({
        format: 'dd.mm.yyyy',
        onSet: function (date, elem) {
            var selDate = Math.round(date.select/1000);
            $('#worksheet-updated').val(selDate);
        }
    })*/

    $('.daterange-ranges').daterangepicker(
        {
            startDate: moment().subtract(29, 'days'),
            endDate: moment(),
            minDate: '01/01/2017',
            maxDate: '12/31/2020',
            dateLimit: {days: 60},
            ranges: {
                'Сегодня': [moment(), moment()],
                'Вчера': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Последние 7 дней': [moment().subtract(6, 'days'), moment()],
                'Последние 30 дней': [moment().subtract(29, 'days'), moment()],
                'Текущий месяц': [moment().startOf('month'), moment().endOf('month')],
                'Предыдущий месяц': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            locale: {
                format: 'DD.MM.YYYY'
            },
            opens: 'left',
            applyClass: 'btn-small bg-slate-600',
            cancelClass: 'btn-small btn-default'
        },
        function (start, end) {
            $('.daterange-ranges span').html(start.format('DD.MM.YYYY') + ' &nbsp; - &nbsp; ' + end.format('DD.MM.YYYY'));
            $('input[name=startDate]').val(start.format('DD.MM.YYYY'));
            $('input[name=finishDate]').val(end.format('DD.MM.YYYY'));
        }
    );

    // Display date format
    $('.daterange-ranges span').html(moment().subtract(29, 'days').format('DD.MM.YYYY') + ' &nbsp; - &nbsp; ' + moment().format('DD.MM.YYYY'));
})
