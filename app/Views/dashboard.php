<?= $this->extend('template/admin_template'); ?>

<?= $this->section('content'); ?>
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<section class="content">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-3 col-3">
                <!-- small box -->
                <div class="small-box bg-danger color-palette">
                    <div class="inner">
                        <h3><?= $severityCounts[4]; ?></h3>
                        <p>Critical</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-3">
                <!-- small box -->
                <div class="small-box bg-orange color-palette">
                    <div class="inner">
                        <h3><?= $severityCounts[3]; ?></h3>
                        <p>High</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-list"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-3">
                <!-- small box -->
                <div class="small-box bg-warning color-palette">
                    <div class="inner">
                        <h3><?= $severityCounts[2]; ?></h3>
                        <p>Medium</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-list"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-3">
                <!-- small box -->
                <div class="small-box bg-info color-palette">
                    <div class="inner">
                        <h3><?= $severityCounts[1]; ?></h3>
                        <p>Low</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-list"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3 col-3">
                <!-- small box -->
                <div class="small-box bg-lime color-palette">
                    <div class="inner">
                        <h3><?= $statusCounts[4]; ?></h3>
                        <p>Resolved</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person"></i>
                    </div>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-3">
                <!-- small box -->
                <div class="small-box bg-teal color-palette">
                    <div class="inner">
                        <h3><?= $statusCounts[3]; ?></h3>
                        <p>Processing</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-list"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-3">
                <!-- small box -->
                <div class="small-box bg-olive color-palette">
                    <div class="inner">
                        <h3><?= $statusCounts[2]; ?></h3>
                        <p>Pending</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-list"></i>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-3">
                <!-- small box -->
                <div class="small-box bg-maroon color-palette">
                    <div class="inner">
                        <h3><?= $statusCounts[1]; ?></h3>
                        <p>Open</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-ios-list"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-6">

                <div class="card card-danger">
                    <div class="card-header">
                        <h3 class="card-title">Severity Counts</h3>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="severityChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 572px;" width="715" height="312" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Status Count</h3>
                    </div>
                    <div class="card-body">
                        <div class="chart">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="statusChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 572px;" width="715" height="312" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>
</section>

<?= $this->endSection(); ?>

<?= $this->section('pagescripts'); ?>

<script>

    // for severity counts bar chart
    document.addEventListener('DOMContentLoaded', function() {
        var severityCounts = <?php echo json_encode($severityCounts); ?>;
        var labels = Object.keys(severityCounts);
        var data = Object.values(severityCounts);

        var severityLabels = {
            4: 'Critical',
            3: 'High',
            2: 'Medium',
            1: 'Low'
        };

        var labelsForChart = labels.map(function(severity) {
            return severityLabels[parseInt(severity)];
        });

        var ctx = document.getElementById('severityChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labelsForChart,
                datasets: [{
                    label: 'Severity Counts',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(75, 192, 192, 1)',
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
    });
    // end...

    /// for status count bar chart
    document.addEventListener('DOMContentLoaded', function() {
        var statusCounts = <?php echo json_encode($statusCounts); ?>;
        var labels = Object.keys(statusCounts);
        var data = Object.values(statusCounts);

        var statusLabels = {
            4: 'Resolved',
            3: 'Processing',
            2: 'Pending',
            1: 'Open'
        };

        var labelsForChart = labels.map(function(status) {
            return statusLabels[parseInt(status)];
        });

        var ctx = document.getElementById('statusChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labelsForChart,
                datasets: [{
                    label: 'Status Counts',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(255, 205, 86, 1)',
                        'rgba(75, 192, 192, 1)',
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
    });

</script>


<?= $this->endSection(); ?>