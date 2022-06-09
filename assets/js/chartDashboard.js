
fetch(`http://localhost/penggajian/admin/dashboard/getchart`).then(response => response.json()).then(response => {



    var ctx = document.getElementById("myChart").getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July", "August","September","October","November","December"],
            datasets: [{
                label: 'Tahun Ini',
                data: response.tahunIni,
                borderWidth: 2,
                backgroundColor: 'rgba(63,82,227,.8)',
                borderWidth: 0,
                borderColor: 'transparent',
                pointBorderWidth: 0,
                pointRadius: 3.5,
                pointBackgroundColor: 'transparent',
                pointHoverBackgroundColor: 'rgba(63,82,227,.8)',
            },
            {
                label: 'Tahun Sebelumnya',
                data: response.tahunSebelum,
                borderWidth: 2,
                backgroundColor: 'rgba(254,86,83,.7)',
                borderWidth: 0,
                borderColor: 'transparent',
                pointBorderWidth: 0,
                pointRadius: 3.5,
                pointBackgroundColor: 'transparent',
                pointHoverBackgroundColor: 'rgba(254,86,83,.8)',
            }]
        },
        // options: {
        //     legend: {
        //         display: false
        //     },
        //     scales: {
        //         yAxes: [{
        //             gridLines: {
        //                 // display: false,
        //                 drawBorder: false,
        //                 color: '#f2f2f2',
        //             },
        //             ticks: {
        //                 beginAtZero: true,
        //                 stepSize: 1500,
        //                 callback: function (value, index, values) {
        //                     return '$' + value;
        //                 }
        //             }
        //         }],
        //         xAxes: [{
        //             gridLines: {
        //                 display: false,
        //                 tickMarkLength: 15,
        //             }
        //         }]
        //     },
        // }
    });

})



