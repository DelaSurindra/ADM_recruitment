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
    },
}