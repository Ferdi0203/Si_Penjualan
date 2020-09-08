            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1><?= $title; ?></h1>
                    </div>
                    <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Users</h4>
                  </div>
                  <div class="card-body">
                    <?php $jumlah = $this->db->get('tb_user')->num_rows(); echo $jumlah ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>total Barang</h4>
                  </div>
                  <div class="card-body">
                    <?php $jumlah = $this->db->get('tb_barang')->num_rows(); echo $jumlah ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Transaksi</h4>
                  </div>
                  <div class="card-body">
                    <?php $jumlah = $this->db->get('tb_transaksi')->num_rows(); echo $jumlah ?>
                  </div>
                </div>
              </div>
            </div>
          </div>


                    <div class="section-body">
                        <?php if ($this->session->userdata('role_id') == 2) { ?>
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Chart Penjualan Harian</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-bar">
                                        <div class="chartjs-size-monitor">
                                            <div class="chartjs-size-monitor-expand">
                                                <div class=""></div>
                                            </div>
                                            <div class="chartjs-size-monitor-shrink">
                                                <div class=""></div>
                                            </div>
                                        </div>
                                        <canvas id="myBarChart" width="668" height="320" class="chartjs-render-monitor" style="display: block; width: 668px; height: 320px;"></canvas>
                                    </div>
                                    <hr>
                                </div>
                            </div>

                        <?php } ?>
                    </div>
                </section>
            </div>