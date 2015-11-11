$(document).ready(function() {
    var dataforgraph;
    var data2 = [],data3 = [];

    $.getScript("/assets/lib/js/socket.io.js", function(){
        var socket = io.connect('http://61.43.139.16:8888');
        socket.emit('dashboard', {});
        socket.on("dashboard res", function(data) {
            if(data.code == 200)
            {
                var dataforgraph = data;
            }
        });
    });

    $("#yesterday").click(function(){
        data2 = [];
        $(this).addClass("active");
        $("#today").removeClass("active");
        $("#month").removeClass("active");
        for(var i=0;i<dataforgraph.yesterdayTcp.length;i++)
            data2[i] = [datadataforgraph.yesterdayTcp[i][0],datadataforgraph.yesterdayTcp[i][1]];

        for(var i=0;i<dataforgraph.yesterdayUdp.length;i++)
            data2[i] = [datadataforgraph.yesterdayUdp[i][0],datadataforgraph.yesterdayUdp[i][1]];

        $.plot($("#flot-dashboard-chart"), dataset, options);
    });
    $("#today").click(function(){
        data2 = [];
        $(this).addClass("active");
        $("#yesterday").removeClass("active");
        $("#month").removeClass("active");
        for(var i=0;i<dataforgraph.todayTcp.length;i++)
            data2[i] = [datadataforgraph.todayTcp[i][0],datadataforgraph.todayTcp[i][1]];

        for(var i=0;i<dataforgraph.todayUdp.length;i++)
            data2[i] = [datadataforgraph.todayUdp[i][0],datadataforgraph.todayUdp[i][1]];

        $.plot($("#flot-dashboard-chart"), dataset, options);
    });
    $("#month").click(function(){
        data2 = [];
        $(this).addClass("active");
        $("#today").removeClass("active");
        $("#yesterday").removeClass("active");
        for(var i=0;i<dataforgraph.monthTcp.length;i++)
            data2[i] = [datadataforgraph.monthTcp[i][0],datadataforgraph.monthTcp[i][1]];

        for(var i=0;i<dataforgraph.monthUdp.length;i++)
            data2[i] = [datadataforgraph.monthUdp[i][0],datadataforgraph.monthUdp[i][1]];

        $.plot($("#flot-dashboard-chart"), dataset, options);
    });
    $('.chart').easyPieChart({
        barColor: '#f8ac59',
        scaleLength: 5,
        lineWidth: 4,
        size: 80
    });

    $('.chart2').easyPieChart({
        barColor: '#1c84c6',
        scaleLength: 5,
        lineWidth: 4,
        size: 80
    });

    var dataset = [
        {
            label: "TCP",
            data: data3,
            color: "#1ab394",
            bars: {
                show: true,
                align: "center",
                barWidth: 24 * 60 * 60 * 600,
                lineWidth:0
            }

        }, {
            label: "UDP",
            data: data2,
            yaxis: 2,
            color: "#1C84C6",
            lines: {
                lineWidth:1,
                    show: true,
                    fill: true,
                fillColor: {
                    colors: [{
                        opacity: 0.2
                    }, {
                        opacity: 0.4
                    }]
                }
            },
            splines: {
                show: false,
                tension: 0.6,
                lineWidth: 1,
                fill: 0.1
            },
        }
    ];


    var options = {
        xaxis: {
            mode: "time",
            tickSize: [3, "day"],
            tickLength: 0,
            axisLabel: "Date",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Arial',
            axisLabelPadding: 10,
            color: "#d5d5d5"
        },
        yaxes: [{
            position: "left",
            max: 1070,
            color: "#d5d5d5",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Arial',
            axisLabelPadding: 3
        }, {
            position: "right",
            clolor: "#d5d5d5",
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: ' Arial',
            axisLabelPadding: 67
        }
        ],
        legend: {
            noColumns: 1,
            labelBoxBorderColor: "#000000",
            position: "nw"
        },
        grid: {
            hoverable: false,
            borderWidth: 0
        }
    };

    var previousPoint = null, previousLabel = null;

});