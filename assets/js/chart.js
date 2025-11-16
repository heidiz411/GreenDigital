function createChart(chartData) {
    // ตรวจสอบว่ามีกราฟอยู่ก่อนแล้วหรือไม่ ถ้ามีให้ลบก่อน
    if (window.myChart) {
        window.myChart.destroy();
    }

    // สร้างกราฟใหม่
    const ctx = document.getElementById('myChart').getContext('2d');
    // ข้อมูลตัวอย่างสำหรับกราฟ
    const data = {
        labels: chartData.labels,
        datasets: chartData.datasets.map(function (dataset, index) {
            return {
                tension: 0,
                borderWidth: 0,
                pointRadius: 7, // กำหนดขนาดของจุด
                label: dataset.label,
                data: dataset.data,
                borderColor: dataset.color,
                backgroundColor: dataset.color,
                fill: false, // กำหนดให้เส้นกราฟไม่เติมพื้นที่ด้านล่าง
                maxBarThickness: 6
            };
        })
    }
    // การกำหนดแกน Y แบบ custom
    const options = {
        scales: {
            y: {
                beginAtZero: true, // เริ่มที่ศูนย์
                min: -3,          // กำหนดค่าต่ำสุดของแกน Y
                max: 3,          // กำหนดค่าสูงสุดของแกน Y
                ticks: {
                    stepSize: 1, // กำหนดความห่างของขั้นแกน Y
                    callback: function (value, index, values) {
                        // กำหนดรูปแบบการแสดงค่า เช่น เพิ่มหน่วย
                        return value + ' SD';
                    }
                },
                title: {
                    display: true,
                    text: 'Custom Y-Axis Label', // ชื่อแกน Y
                    color: '#666',
                    font: {
                        size: 14,
                        weight: 'bold'
                    }
                }
            }
        },
        plugins: {
            legend: {
                display: true,
                position: 'top'
            }
        }
    };
    // สร้างกราฟ
    window.myChart = new Chart(ctx, {
        type: 'line', // คุณสามารถเปลี่ยนเป็น 'bar', 'pie', ฯลฯ ได้ตามต้องการ
        data: data,
        options: options,
    });
}