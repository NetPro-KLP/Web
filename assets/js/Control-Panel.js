var updatingChart = $(".updating-chart").peity("line", { fill: '#0e9aef',stroke:'#1c84c6', width: 128 })

setInterval(function() {
    var random = Math.round(Math.random() * 10)
    var values = updatingChart.text().split(",")
    values.shift()
    values.push(random)

    updatingChart
        .text(values.join(","))
        .change()
}, 1000);