import './bootstrap';

import Alpine from 'alpinejs';
import ApexCharts from 'apexcharts';
import { Chart, registerables } from 'chart.js';

Chart.register(...registerables);

window.Alpine = Alpine;
window.ApexCharts = ApexCharts;
window.Chart = Chart;

Alpine.start();
