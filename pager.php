<nav class="pager">
  <ul>
    <li>
      <?php if ($prev = $pager->prev): ?>
        <a href="<?= eat($prev->link); ?>" rel="prev" title="<?= eat($prev->description); ?>">
          <?= i('Newer %s', 'Posts'); ?>
        </a>
      <?php endif; ?>
    </li>
    <li>
      <?php if ($parent = $page->parent): ?>
        <?php $children = $parent->children ?? false; ?>
        <a href="<?= eat($parent->url . ($children && $children->count ? '/1' : "")); ?>" title="<?= eat($parent->description); ?>">
          <?= $parent->title ?? i('Parent'); ?>
        </a>
      <?php else: ?>
        <?php if (!$site->is('home')): ?>
          <a href="<?= eat($url); ?>">
            <?= i('Home'); ?>
          </a>
        <?php endif; ?>
      <?php endif; ?>
    </li>
    <li>
      <?php if ($next = $pager->next): ?>
        <a href="<?= eat($next->link); ?>" rel="next" title="<?= eat($next->description); ?>">
          <?= i('Older %s', 'Posts'); ?>
        </a>
      <?php endif; ?>
    </li>
  </ul>
</nav>