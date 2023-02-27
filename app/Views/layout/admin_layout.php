<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<?= $this->include('layout/head') ?>
<body>
	<!-- begin #page-loader -->
	<div id="page-loader" class="fade in"><span class="spinner"></span></div>
	<!-- end #page-loader -->
	
	<!-- begin #page-container -->
	<div id="page-container" class="page-container fade page-sidebar-fixed page-header-fixed">
        <?= $this->include('layout/header') ?>
        <?= $this->include('layout/sidebar') ?>
		
		<!-- begin #content -->
		<div id="content" class="content">
    		<?= $this->include('layout/breadcrumb') ?>
            <?= $this->renderSection('content') ?>
		</div>
		<!-- end #content -->
		
		<!-- begin scroll to top btn -->
		<a href="javascript:;" class="btn btn-icon btn-circle btn-success btn-scroll-to-top fade" data-click="scroll-top"><i class="fa fa-angle-up"></i></a>
		<!-- end scroll to top btn -->
	</div>
	<!-- end page container -->

    <?= $this->include('layout/footer') ?>
    <?= $this->include('layout/js') ?>
</body>
</html>
