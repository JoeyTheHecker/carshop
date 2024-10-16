$(document).ready(function(){

    var statisticsMonthly = function(data = false) {
        $.ajax({
            url: "/web/inquiry/monthly/statistics",
            type: "GET",
            data: "year="+$("select#statYearBar").val(),
            success: function(data){
                Highcharts.chart('containerBarGraph', {
                    credits: {
                        enabled: false
                    },
                    chart: {
                        type: 'column'
                    },
                    title: {
                        text: 'Total Inquiry in '+$("select#statYearBar").val()
                    },
                    subtitle: {
                        text: ''
                    },
                    xAxis: {
                        categories: [
                            'Jan',
                            'Feb',
                            'Mar',
                            'Apr',
                            'May',
                            'Jun',
                            'Jul',
                            'Aug',
                            'Sep',
                            'Oct',
                            'Nov',
                            'Dec'
                        ],
                        crosshair: true
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: ''
                        }
                    },
                    tooltip: {
                        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                            '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
                        footerFormat: '</table>',
                        shared: true,
                        useHTML: true
                    },
                    plotOptions: {
                        column: {
                            pointPadding: 0.2,
                            borderWidth: 0
                        }
                    },
                    series: [{
                        name: 'Inquiry',
                        data: data.totalInquiry,
                        color: "#f0ad4e"

                    }]
                });
            }
        });
    };

    $("select#statYearBar").change(function() {
        statisticsMonthly();
    });
    
    statisticsMonthly();
});