<?= $isAjax ? '' : $this->extend('layout/admin_layout') ?>

<?= $isAjax ? '' : $this->section('additional-css') ?>
<?= $isAjax ? '' : $this->endSection() ?>

<?= $isAjax ? '' : $this->section('content') ?>
<!-- begin page-header -->
<h1 class="page-header"><?= $meta->pageTitle ?> <small><?= @$meta->description ?></small></h1>
<!-- end page-header -->

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-default" data-click="panel-expand"><i class="fa fa-expand"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-success" data-click="panel-reload"><i class="fa fa-repeat"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-danger" data-click="panel-remove"><i class="fa fa-times"></i></a>
                </div>
                <h4 class="panel-title"><?= $meta->pageTitle ?> List</h4>
            </div>
            <div class="panel-body">
                <table id="data-table" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th width="100px" nowrap>ID</th>
                            <th width="200px" nowrap>First name</th>
                            <th width="200px" nowrap>Last name</th>
                            <th width="200px" nowrap>ZIP / Post code</th>
                            <th>Country</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $isAjax ? '' : $this->endSection() ?>

<?= $isAjax ? '' : $this->section('additional-js') ?>
<script>

    // Activate an inline edit on click of a table cell
    $('#data-table').on('click', 'tbody td:not(:first-child)', function(e) {
        editor.inline(this);
    });

    var handleDataTable = function() {
            "use strict";
            0 !== $("#data-table").length && $("#data-table").DataTable({
                dom: '<"row"<"col-sm-5"B><"col-sm-7"fr>>t<"row"<"col-sm-5"i><"col-sm-7"p>>',
                buttons: [{
                        extend: 'copy',
                        className: 'btn-sm'
                    },
                    {
                        extend: 'csv',
                        className: 'btn-sm'
                    },
                    {
                        extend: 'excel',
                        className: 'btn-sm'
                    },
                    {
                        extend: 'pdf',
                        className: 'btn-sm'
                    },
                    {
                        extend: 'print',
                        className: 'btn-sm'
                    }
                ],
                ajax: "../assets/js/demo/json/scroller_demo.json",
                deferRender: true,
                scrollY: 500,
                scrollCollapse: true,
                scroller: true,
                responsive: true,
            })
        },
        Table = function() {
            "use strict";
            return {
                init: function() {
                    handleDataTable()
                }
            }
        }();

    $(document).ready(function() {
        Table.init();
    });
</script>
<?= $isAjax ? '' : $this->endSection() ?>