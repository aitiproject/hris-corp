<?= $isAjax ? '' : $this->extend('layout/admin_layout') ?>

<?= $isAjax ? '' : $this->section('additional-css') ?>
<?= $isAjax ? '' : $this->endSection() ?>

<?= $isAjax ? '' : $this->section('content') ?>
<!-- begin page-header -->
<h1 class="page-header"><?= $meta->pageTitle ?> <small><?= @$meta->description ?></small></h1>
<!-- end page-header -->

<div class="action-container m-b-10">
    <button type="button" class="btn btn-primary btn-add"><i class="fa fa-plus"></i> Add</button>
    <button type="button" class="btn btn-warning btn-edit"><i class="fa fa-pencil"></i> Edit</button>
    <button type="button" class="btn btn-success btn-save" disabled><i class="fa fa-save"></i> Save</button>
</div>

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
                <!-- <div class="table-responsive"> -->
                <table id="data-table" class="table table-striped table-bordered">
                </table>
                <!-- </div> -->
            </div>
        </div>
    </div>
</div>
<?= $isAjax ? '' : $this->endSection() ?>

<?= $isAjax ? '' : $this->section('additional-js') ?>
<script>
    class tableEditor {
        //default options
        options = {
            primaryKey: 0, //index primary key
            editMode: 'cell', // row, cell, table
            url: 'batch_update',
            method: 'POST',
        }

        rowEdited = {};
        state = "read"; //edit. read

        constructor(options) {
            if (options != undefined) {
                this.options = options;
            }
        }

        init = (row) => {
            var _global = this
            let value = ""
            let fieldName = ""
            let id = ""

            $(row).on('click', 'td', function(e) {
                if (_global.editing) {
                    return false
                }

                if (_global.state != "edit") {
                    return false
                }

                value = $(this).text()
                let tr = $(this).closest('tr');
                let table = $(this).closest('table');
                id = $($(tr).find('td')[_global.options.primaryKey]).text()
                let th = $(table).find('thead>tr').find('th')
                let colIndex = $(this).index()
                fieldName = $(th[colIndex]).text().toLowerCase()

                $(this).html("<input type='text' value='" + value + "' class='form-control input-sm w-100'/>")
                let input = $(this).find('input')[0]
                $(input).focus()
                input.setSelectionRange(value.length, value.length)
                _global.editing = true
            })

            $(row).on('keypress', 'input', function(e) {
                if (e.which == 13) {
                    $(this).blur()
                }
            });

            $(row).on('blur', 'input', function() {
                _global.editing = false
                value = $(this).val()
                $(this).closest('td').html(value)

                _global.rowEdited[id] = {}
                _global.rowEdited[id][fieldName] = value
            });
        }

        getRowEdited = (options) => {
            return this.rowEdited
        }

        edit = () => {
            this.setState("edit")
        }

        save = (options) => {
            var _global = this
            if (this.rowEdited == undefined) {
                alert("nothing to save")
                return false
            }

            if (options != undefined) {
                this.options = options
            }
            var request = $.ajax({
                url: window.location.href + '/' + this.options.url,
                type: this.options.method,
                data: {
                    'data': this.rowEdited
                },
                dataType: "json",
                cache: false,
            }).done(function(data) {
                console.log(data)
                _global.setState("read")
                $("#data-table").DataTable().ajax.reload()
            }).fail(function(jqXHR, textStatus) {
                alert("Request failed: " + textStatus);
            })
        }

        setState = (state) => {
            if (state == "read") {
                $('.btn-edit').removeAttr('disabled', true);
                $('.btn-add').removeAttr('disabled', true);
                $('.btn-save').attr('disabled', true);
            } else if (state == "edit") {
                $('.btn-edit').attr('disabled', true);
                $('.btn-add').attr('disabled', true);
                $('.btn-save').removeAttr('disabled');
            }
            this.state = state
        }

        setOptions = (options) => {
            this.options = options
        }

        getOptions = () => {
            return this.options
        }
    }

    var editor
    if (editor == undefined) {
        editor = new tableEditor();
    }
</script>
<script>
    var fields = JSON.parse(`<?= json_encode((array) $fields) ?>`);

    $('.btn-edit').on('click', function() {
        editor.edit()
    })

    $('.btn-save').on('click', function() {
        editor.save()
    })

    $(document).ready(function() {
        table = $("#data-table").DataTable({
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
            ajax: {
                url: '',
            },
            columns: fields,
            deferRender: true,
            scrollX: true,
            // scrollY       : 500,
            scrollCollapse: true,
            // scroller      : true,
            searching: true,
            paging: true,
            pageLength: 30,
            columnDefs: [{
                "defaultContent": "-",
                "targets": "_all"
            }],
            "fnRowCallback": function(nRow, aData, iDisplayIndex) {
                $('td', nRow).attr('nowrap', 'nowrap');
                editor.init(nRow)
                return nRow;
            }
        });
        // table.ajax.reload();
    });
</script>
<?= $isAjax ? '' : $this->endSection() ?>