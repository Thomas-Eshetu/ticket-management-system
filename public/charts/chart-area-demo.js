var ctx = document.getElementById("myAreaChart");

new Chart(ctx, {
type: 'line',
data: {
labels: days,
datasets: [

{
label: "Tickets Created",
data: createdTickets,
borderColor: "#0d6efd",
backgroundColor: "rgba(13,110,253,0.1)",
tension:0.3
},

{
label: "Tickets Resolved",
data: resolvedTickets,
borderColor: "#198754",
backgroundColor: "rgba(25,135,84,0.1)",
tension:0.3
}

]
},
options:{
responsive:true,
scales:{
y:{beginAtZero:true}
}
}
});