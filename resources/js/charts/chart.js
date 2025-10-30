function createChart(ctx, labels, data, label, background, border){
  return new Chart(ctx, {
    type: 'bar',
    data: {
      labels,
      datasets: [{
        label,
        data,
        backgroundColor: background,
        borderRadius: 6,
        barThickness: 50,
        hoverBackgroundColor: border,
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          display: false
        },
        tooltip: {
          backgroundColor: palette.tooltipBg,
          titleColor: palette.tooltipText,
          bodyColor: palette.tooltipText,
          borderWidth: 1,
          borderColor: '#374151',
          cornerRadius: 6,
          padding: 10,
          displayColors: false,
          callbacks: {
            label: function(context) {
              return `${context.dataset.label}: ${context.formattedValue}`;
            }
          }
        }
      },
      scales: {
        x: {
          grid: { display: false },
          ticks: {
            color: palette.text,
            font: { size: 13 }
          }
        },
        y: {
          grid: { color: palette.grid },
          ticks: {
            color: palette.text,
            font: { size: 13 },
            stepSize: 2
          }
        }
      },
      animation: {
        duration: 800,
        easing: 'easeOutQuart'
      }
    }
  });
}