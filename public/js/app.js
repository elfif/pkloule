/* 
 * PMichel
 * PokerPlayers
 * v1
 */

function handlePlayerFormCalculs() {

    $('input[id^=cave').off().change(function () {
        var id = $(this).attr('id');
        var nb = id.replace('cave', '');
        recalcule(nb);
    });

    $('input[id^=resultat').off().change(function () {
        var id = $(this).attr('id');
        var nb = id.replace('resultat', '');
        recalcule(nb);
    });
}

function recalcule(nb) {
    var cave = $('#cave' + nb).val() * 1;
    var resultat = $('#resultat' + nb).val() * 1;
    var diff = resultat - cave;

    if (diff <= -100) {
        $('#diff' + nb).html('<span  class="label label-danger">' + diff + '</span>');
    }

    if (diff >= -100 && diff < 0) {
        $('#diff' + nb).html('<span  class="label label-warning">' + diff + '</span>');
    }

    if (diff === 0) {
        $('#diff' + nb).html('<span  class="label label-default">' + diff + '</span>');
    }

    if (diff > 0) {
        $('#diff' + nb).html('<span  class="label label-success">' + diff + '</span>');
    }
}

function drawHighCharts() {
    $('.hcContainer').each(function () {
        var url = $(this).data('url');
        var targetContainer = this;
        if (url) {
            $.getJSON(url, function (data) {
                console.log(data);
                $(targetContainer).highcharts(data);
            });
        }
    });
}

$(document).ready(function () {
    handlePlayerFormCalculs();
    drawHighCharts();
});
