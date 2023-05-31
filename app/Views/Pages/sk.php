			<?php $this->extend('template'); ?>
			
			<?php $this->section('css'); ?>
			<?php $this->endSection(); ?>
			
			<?php $this->section('content'); ?>
			<div class="clearfix pt-5"></div>
			<div class="pt-5 pb-5" style="min-height: 500px;">
			    <div class="container">
			        <div class="row justify-content-center">
			            <div class="col-lg-10">
			                <div class="pt-3 pb-4">
			                    <h5 class="btn btn-primary">Syarat & Ketentuan</h5>
			                    <!--<span class="strip-primary"></span>-->
			                </div>
			                <div class="pb-3">
			                    <div class="section">
			                        <div class="card-body"><?= $page_sk; ?></div>
			                    </div>
			                </div>
			            </div>
			        </div>
			    </div>
			</div>
			<?php $this->endSection(); ?>
			
			<?php $this->section('js'); ?>
			<?php $this->endSection(); ?>