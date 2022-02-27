<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <?php 
    $total = count($breadcrumbs);
    $i = 1;
    foreach ($breadcrumbs as $key => $value) { 
      ?>
      <li class="breadcrumb-item <?= $total==$i?"active":"" ?>"><a href="<?= base_url($value) ?>"><?= $key ?></a></li>
    <?php $i++; } ?>
  </ol>
</nav>