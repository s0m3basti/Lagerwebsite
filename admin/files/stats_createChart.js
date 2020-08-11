function createChart(labels, data, type, colors, title, legend){
    let myChart = document.getElementById('myChart').getContext('2d');

    Chart.defaults.global.defaultFontFamily = 'Arail';
    Chart.defaults.global.defaultFontSize = 18;
    Chart.defaults.global.defaultFontColor = '#777';

    let chart = new Chart(myChart, {
        type: type, // bar, horizontalBar, pie, line, doughnut, radar, polarArea
        data:{
            labels: labels,
            datasets:[{
            label:'',
            data: data,
            backgroundColor: colors,
            borderWidth:1,
            borderColor:'white',
            hoverBorderWidth:3,
            hoverBorderColor:'#000'
            }]
        },
        options:{
            scales: {
                fontFamily: 'Arial',
                yAxes: [{
                    ticks: {
                        min: 0,
                        stepSize: 1
                    }
                }],
                xAxes:[{
                    ticks: {
                        max: 5,
                        min: 0,
                        stepSize: 0.5
                    }
                }]
            },
            title:{
                display:true,
                text: title,
                fontSize:30,
                fontColor: "white",
                fontFamily: 'Arial'
            },
            legend:{
                display: legend,
                position:'bottom',
            labels:{
                fontColor:'#000',
                fontFamily: 'Arial'
            }
            },
            layout:{
            padding:{
                left:0,
                right:0,
                bottom:0,
                top:0
            }
            },
            tooltips:{
                enabled:true,
                titleFontFamily: 'Arial',
                fontFamily: 'Arial',
                fontColor:'black',
            }
        }
    });
}