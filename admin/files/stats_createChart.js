function createChart(labels, data, type, colors, title){
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
            borderColor:'#777',
            hoverBorderWidth:3,
            hoverBorderColor:'#000'
            }]
        },
        options:{
            title:{
                display:true,
                text: title,
                fontSize:30,
                fontFamily: 'Arial'
            },
            legend:{
                display:false,
                position:'right',
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
                fontFamily: 'Arial',
                fontColor:'black',
            }
        }
    });
}