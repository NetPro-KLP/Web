$.getScript("/assets/lib/js/socket.io.js", function(){
    var socket = io.connect('http://172.16.100.61:8888');

    /*
        위험도 그래프
        바그래프
    */
    socket.emit('barStatistics dangerWarn', {});
    socket.on("barStatistics dangerWarn res", function(data) {
        var bardatafix = [];
        for(i=0;i<data.dangerWarn.length;i++){
            var temp = [new Date(data.dangerWarn[i][0] * 1000),data.dangerWarn[i][1]];
            bardatafix.push(temp);
        }
    	var barOptions = {
            series: {
                bars: {
                    show: true,
                    barWidth: 60000000,
                    fill: true,
                    fillColor: {
                        colors: [{
                            opacity: 0.8
                        }, {
                            opacity: 0.8
                        }]
                    }
                }
            },
            xaxis: {
                mode: 'time'
            },
            colors: ["#1ab394"],
            grid: {
                color: "#999999",
                hoverable: true,
                clickable: true,
                tickColor: "#D4D4D4",
                borderWidth:0
            },
            legend: {
                show: false
            },
            tooltip: true,
            tooltipOpts: {
                content: "날짜 : %x, 위험도: %y",
                xDateFormat: "%Y-%m-%d %h:%M:%S",
            }
        };

        var barData = {
            label: "bar",
            data: bardatafix
        };
        $.plot($("#flot-bar-chart"), [barData], barOptions);
    });

    /*
        In/OutBound 그래프
        선그래프
  프 */
    socket.emit('inoutbound week', {});
    socket.on("inoutbound week res", function(data) {
    	if(data.code == 200)
    	{
        	var label = [];
        	var inbound = [];
        	var outbound = [];
        	for(i=0;i<7;i++)
        	{
            	var temp = data.weekDate[0][i];
            	label.push(temp);
            	var temp = data.inbound[0][i];
            	inbound.push(temp);
            	var temp = data.outbound[0][i];
            	outbound.push(temp);
        	}
        	new Chartist.Line('#ct-chart1', {
                labels: label,
                series: [
                    inbound,
                    outbound
                ]
            }, {
                fullWidth: true,
                chartPadding: {
                    right: 30
                }
            });
    	}
    });

    /*
        프로토컬 그래프
        파이 그래프
    */

    socket.emit('protocol statistics', {});
    socket.on("protocol statistics res", function(data) {
        $(function() {
            var colors = ["#d3d3d3","#bababa","#79d2c0","#1ab394"];

            var dataa = [];

            var n = 0;
            for(i in data)
            {
                if(i == "code")
                    continue;
                var temp = new Object();
                temp.label = i;
                temp.data = data[i];
                temp.color = colors[n];
                n++;
                dataa.push(temp);
            }

            var plotObj = $.plot($("#flot-pie-chart"), dataa, {
                series: {
                    pie: {
                        show: true
                    }
                },
                grid: {
                    hoverable: true
                },
                tooltip: true,
                tooltipOpts: {
                    content: "%p.0%, %s", // show percentages, rounding to 2 decimal places
                    shifts: {
                        x: 20,
                        y: 0
                    },
                    defaultTheme: false
                }
            });

        });
    });

    /*
        실시간 트래픽
        실시간 선 그래프
    */

    var container = $("#flot-line-chart-moving");

    var maximum = container.outerWidth() / 2 || 250;

    var data = [];
    setInterval(function(){
        socket.emit('realtimeOn', {});
        socket.on("realtimeOn res", function(td) {
            if(td.code == 200)
          	{
              	for(var i =0;i<td.statistics.length;i++)
              	{
                    data.push(td.statistics[i][1]);
              	}
          	}
        });
    },500);
    function getTraffic() {
        var n = 0;
        if (data.length) {
            data = data.slice(1);
        }

        while (data.length < maximum) {
            var previous = data.length ? data[data.length - 1] : 50;
            var y = data[n];
            data.push(y < 0 ? 0 : y > 100 ? 100 : y);
            n++;
        }

        var res = [];
        for (var i = 0; i < data.length; ++i) {
            res.push([i, data[i]]);
        }

        return res;
    }

    series = [{
        data: getTraffic(),
        lines: {
            fill: true
        }
    }];


    var plot = $.plot(container, series, {
        grid: {
            color: "#999999",
            tickColor: "#D4D4D4",
            borderWidth:0,
            minBorderMargin: 20,
            labelMargin: 10,
            backgroundColor: {
                colors: ["#ffffff", "#ffffff"]
            },
            margin: {
                top: 8,
                bottom: 20,
                left: 20
            },
            markings: function(axes) {
                var markings = [];
                var xaxis = axes.xaxis;
                for (var x = Math.floor(xaxis.min); x < xaxis.max; x += xaxis.tickSize * 2) {
                    markings.push({
                        xaxis: {
                            from: x,
                            to: x + xaxis.tickSize
                        },
                        color: "#fff"
                    });
                }
                return markings;
            }
        },
        colors: ["#1ab394"],
        xaxis: {
            tickFormatter: function() {
                return "";
            }
        },
        yaxis: {
            min: 0,
            max: 110
        },
        legend: {
            show: true
        }
    });

    setInterval(function updateRandom() {
        series[0].data = getTraffic();
        plot.setData(series);
        plot.draw();
    }, 40);

    /*
        TCP/UDP 그래프
        선그래프
    */

    socket.emit('tcpudp hour', {});
    socket.on("tcpudp hour res", function(data) {
        if(data.code == 200)
        {
            $(function() {
                var TCP = [];
                var UDP = [];

                for(var i in data.tcpTraffic)
                {
                    var jstime = new Date(i*1000);
                    var temp = [];
                    temp = [jstime,data.tcpTraffic[i][0].totalbytes/1024];
                    TCP.push(temp);
                }
                for(var i in data.udpTraffic)
                {
                    var jstime = new Date(i*1000);
                    var temp = [];
                    temp = [jstime,data.udpTraffic[i][0].totalbytes/1024];
                    UDP.push(temp);
                }
                function doPlot(position) {
                    $.plot($("#flot-line-chart-multi"), [{
                        data: TCP,
                        label: "TCP"
                    }, {
                        data: UDP,
                        label: "UDP"
                    }], {
                        xaxes: [{
                            mode: 'time',
                            timeformat: "%Y-%m-%d %H:%M:%S"
                        }],
                        yaxes: [{
                            min: 0
                        }, {
                            // align if we are to the right
                            alignTicksWithAxis: position == "right" ? 1 : null,
                            position: position
                        }],
                        legend: {
                            position: 'sw'
                        },
                         colors: ["#FF0000", "#0022FF"],
                        grid: {
                            color: "#999999",
                            hoverable: true,
                            clickable: true,
                            tickColor: "#D4D4D4",
                            borderWidth:0,
                            hoverable: true
                        },
                        tooltip: true,
                        tooltipOpts: {
                            content: "%s패킷 데이터가 %x 에 %y/MB",
                            timeformat: "%Y-%m-%d %H:%M:%S",
                        }
                    });
                }

                doPlot("right");

                $("button").click(function() {
                    doPlot($(this).text());
                });
            });
        }
        else
            alert("커넥션이 종료 되었습니다. 페이지를 새로고침을 해주시기 바랍니다.");
    });

});