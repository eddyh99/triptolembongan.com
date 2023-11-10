		</div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="<?= base_url()?>assets/js/sidebarmenu.js"></script>
    <script src="<?= base_url()?>assets/js/app.min.js"></script>
    <script src="<?= base_url()?>assets/js/dashboard.js"></script>
    <script src="<?= base_url()?>assets/libs/apexcharts/dist/apexcharts.min.js"></script>
    <script src="<?= base_url()?>assets/libs/simplebar/dist/simplebar.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="<?= base_url()?>assets/js/script.js"></script>
	<?php
		if (isset($extra)) {
			$this->load->view($extra);
		}
	?>
</body>

</html>