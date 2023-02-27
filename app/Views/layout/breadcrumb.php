<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <?php foreach ($breadcrumb ?? [] as $key => $val) : ?>
    <?php if($key < count((array) $breadcrumb) -1) : ?>
        <li><a href="<?= $val['url'] ?>" ><?= $val['name'] ?></a></li>
    <?php else : ?>
        <li class="active"><?= $val['name'] ?></li>
    <?php endif ?>
    <?php endforeach ?>
</ol>
<!-- end breadcrumb -->