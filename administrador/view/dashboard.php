<main class="flex flex-col lg:flex-row h-screen bg-gray-100">
    <?php include 'template/navbar.php' ?>

    <!-- Contenido -->
    <section class="w-full px-0 lg:px-3 mt-1">
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex justify-between">
                <h3 class="font-bold text-xl mb-3">Dashboard</h3>
            </div>
            <p class="text-gray-700">Bienvenido al panel de administración. Desde aquí podrás gestionar tu aplicación.</p>
            <canvas id="myChart"></canvas>
        </div>
    </section>
</main>

<?php
$numero_estudiantes = $dataToView[0];
$numero_empresas = $dataToView[1];
$numero_centros = $dataToView[2];
$numero_ofertas = $dataToView[3];
?>


<!-- Js para mostrar el grafico -->
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Centros', 'Empresas', 'Estudiantes', 'Ofertas de trabajo'],
            datasets: [{
                label: 'Registros',
                data: [<?php echo $numero_centros ?>, <?php echo $numero_empresas ?>, <?php echo $numero_estudiantes ?>, <?php echo $numero_ofertas ?>],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 1, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 1, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>