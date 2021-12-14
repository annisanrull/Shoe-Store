<div class="page-header">
	<h3>Dashboard</h3>
</div>
<div class="row">
	<div class="col-lg-3 col-md-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="glyphicon glyphiconfolder-open"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">
							<font size="18"><b><?php echo $this->m_perpus->get_data('sepatu')->num_rows(); ?></b></font>
						</div>
						<div><b>Jumlah Sepatu yang Terdaftar</b></div>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url().'sepatu' ?>">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="glyphicon glyphicon-arrow-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>

	<div class="col-lg-3 col-md-6">
		<div class="panel panel-success">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="glyphicon glyphiconuser"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">
							<font size="18"><b><?php echo $this->m_perpus->get_data('anggota')->num_rows(); ?></b></font>
						</div>
						<div><b>Jumlah Anggota yang Terdaftar</b></div>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url().'anggota' ?>">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="glyphicon glyphicon-arrow-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>

	<div class="col-lg-3 col-md-6">
		<div class="panel panel-warning">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="glyphicon glyphiconsort"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">
							<font size="18"><b><?php echo $this->m_perpus->edit_data(array('status_pinjam'=>'Belum Selesai'),'peminjaman')->num_rows(); ?></b></font>
						</div>
						<div><b>Pembelian Belum Selesai</b></div>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url().'pembelian'; ?>">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="glyphicon glyphicon-arrow-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
		</div>
	</div>

	<div class="col-lg-3 col-md-6">
		<div class="panel panel-danger">
			<div class="panel-heading">
				<div class="row">
					<div class="col-xs-3">
						<i class="glyphicon glyphiconok"></i>
					</div>
					<div class="col-xs-9 text-right">
						<div class="huge">
							<font size="18"><b><?php echo $this->m_perpus->edit_data(array('status_beli'=>'Sudah Selesai'),'pembeliann')->num_rows(); ?></b></font>
						</div>
						<div><b>Pembelian Sudah Selesai</b></div>
					</div>
				</div>
			</div>
			<a href="<?php echo base_url().'admin/pembelian'; ?>">
				<div class="panel-footer">
					<span class="pull-left">View Details</span>
					<span class="pull-right"><i class="glyphicon glyphicon-arrow-right"></i></span>
					<div class="clearfix"></div>
				</div>
			</a>
			</div>
		</div>
	</div>
		
	<hr>
		
	<div class="row">
		<div class="col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title" style="font-size: 18px; font-weight: bold;"><i class="glyphicon glyphicon-random arrow-right"></i> Sepatu</h3>
				</div>
				<div class="panel-body">
					<div class="list-group">
						<?php foreach($sepatu as $b){ ?>
							<a href="#" class="list-group-item">
								<span class="badge"><?php if($b->status_sepatu == 1){echo "Tersedia";}else{echo "Dibeli";}?></span>
								<i class="glyphicon glyphiconuser"></i> <?php echo $b->nama_sepatu; ?>
							</a>
						<?php } ?>
					</div>
					<div class="text-right">
						<a href="<?php echo base_url().'admin/sepatu' ?>">Lihat Semua Sepatu <i class="glyphicon glyphicon-arrow-right"></i></a>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title" style="font-size: 18px; font-weight: bold;"><i class="glyphicon glyphicon-user o"></i> Anggota Terbaru</h3>
				</div>
				<div class="panel-body">
					<div class="list-group">
						<?php foreach($anggota as $a){ ?>
							<a href="#" class="list-group-item">
								<span class="badge"><?php echo $a->gender; ?></span>
								<i class="glyphicon glyphiconuser"></i> <?php echo $a->nama_anggota; ?>
							</a>
							<?php } ?>
					</div>
					<div class="text-right">
						<a href="<?php echo base_url().'admin/anggota' ?>">Lihat Semua Anggota <i class="glyphicon glyphicon-arrow-right"></i></a>
					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-5">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title" style="font-size: 18px; font-weight: bold;"><i class="glyphicon glyphicon-sort"></i> Peminjaman Terakhir</h3>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table class="table table-bordered tablehover table-striped">
							<thead>
								<tr>
									<th>Tgl. Transaksi</th>
									<th>Tgl. membeli</th>
									<th>Tgl. Kembali</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach($pembelian as $p){
								?>
								<tr>
									<td><?php echo date('d/m/Y',strtotime($p->tgl_input)); ?></td>
									<td><?php echo date('d/m/Y',strtotime($p->tgl_beli)); ?></td>
									<td><?php echo date('d/m/Y',strtotime($p->tgl_kembali)); ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<div class="text-right">
						<a href="<?php echo base_url().'admin/pembelian' ?>">Lihat Semua Transaksi <i class="glyphicon glyphicon-arrow-right"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.row -->