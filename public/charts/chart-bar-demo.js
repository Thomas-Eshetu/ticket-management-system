// Bar Chart Example
var ctx = document.getElementById("myBarChart");

var myBarChart = new Chart(ctx, {
type: 'bar',
data: {
labels: months,
datasets: [{
label: "Total Tickets",
backgroundColor: "rgba(2,117,216,1)",
borderColor: "rgba(2,117,216,1)",
data: monthlyTickets
}]
},
options: {
responsive:true,
scales:{
y:{
beginAtZero:true
}
}
}
});