var grafik = {
    init:function(){
        // js grafik
        if ($("#grafikResult").length) {
            var id = $("#idParticipant").val();
            ajax.getData('/HR/test/inventory-result', 'post', {id:id}, function(inventory){
                
                var data = {
                    labels: inventory.label,
                    datasets: [
                        {
                            label: "Inventory Result",
                            backgroundColor: "#DF0E2C",
                            borderColor: "#DF0E2C",
                            pointBackgroundColor: "#DF0E2C",
                            pointBorderColor: "#fff",
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: "rgba(179,181,198,1)",
                            data: inventory.result
                        }
                    ]
                };
                
                var ctx = document.getElementById("grafikResult");
                
                var myRadarChart = new Chart(ctx, {
                    type: 'radar',
                    data: data,
                    options: {
                        scale: {
                            ticks: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        }

        if ($("#chartRecruitment").length) {

            ajax.getData('/HR/chart-total-application', 'post', null, function(data){
                var data = {
                    labels: ['Processed', 'Declined', 'Hired'],
                    datasets: [
                        {
                            backgroundColor: ["#DF0E2C", "#2E61AF", "#FFBC42"],
                            pointBackgroundColor: "#DF0E2C",
                            data: [data.proses, data.decline, data.hired]
                        }
                    ]
                };
                
                var ctx = document.getElementById("chartRecruitment");
                
                var myRadarChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: data,
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom',
                            },
                            title: {
                                display: false
                            }
                        }
                    }
                });
            
            })

        }

        if ($("#chartApplication").length) {
            ajax.getData('/HR/chart-application-source', 'post', null, function(data){
            
                var data = {
                    labels: data.label,
                    datasets: [
                        {
                            backgroundColor: "#DF0E2C",
                            pointBackgroundColor: "#DF0E2C",
                            data: data.result,
                            barPercentage: 0.3
                        }
                    ]
                };
                
                var ctx = document.getElementById("chartApplication");
                
                var myRadarChart = new Chart(ctx, {
                    type: 'bar',
                    data: data,
                    options: {
                        indexAxis: 'y',
                        // Elements options apply to all of the options unless overridden in a dataset
                        // In this case, we are setting the border of each horizontal bar to be 2px wide
                        elements: {
                            bar: {
                                borderRadius: 10,
                            }
                        },
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false,
                            },
                            title: {
                                display: false,
                            }
                        },
                    },
                });
            })
        }
    },
}