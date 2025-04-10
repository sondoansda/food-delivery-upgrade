// resources/js/dashboard.js
import Chart from 'chart.js/auto';

window.initCharts = function(charts) {
    new Chart(charts.orderStatus, {
        type: 'bar',
        data: {
            labels: Object.keys(charts.data.orderStatuses),
            datasets: [{
                label: 'Number of Orders',
                data: Object.values(charts.data.orderStatuses),
                backgroundColor: ['#3B82F6', '#10B981', '#EF4444'],
                borderColor: ['#2563EB', '#059669', '#DC2626'],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true, title: { display: true, text: 'Number of Orders' } },
                x: { title: { display: true, text: 'Status' } }
            }
        }
    });

    new Chart(charts.userRoles, {
        type: 'pie',
        data: {
            labels: Object.keys(charts.data.userRoles),
            datasets: [{
                label: 'User Roles',
                data: Object.values(charts.data.userRoles),
                backgroundColor: ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6'],
                borderWidth: 1
            }]
        },
        options: {
            plugins: { legend: { position: 'bottom' } }
        }
    });

    new Chart(charts.ordersByDate, {
        type: 'line',
        data: {
            labels: Object.keys(charts.data.ordersByDate),
            datasets: [{
                label: 'Orders',
                data: Object.values(charts.data.ordersByDate),
                fill: false,
                borderColor: '#3B82F6',
                tension: 0.1
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true, title: { display: true, text: 'Number of Orders' } },
                x: { title: { display: true, text: 'Date' } }
            }
        }
    });
};